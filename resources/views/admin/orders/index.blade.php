@extends('layouts.admin')

@section('content')
<style>
    /* التنسيقات الأصلية لرسائل التواصل */
    .row-contact { 
        background-color: rgba(106, 44, 112, 0.05) !important; 
        border-right: 4px solid #6f42c1; 
    }
    /* التنسيق الجديد لتمييز طلبات انضمام السائقين */
    .row-driver-request { 
        background-color: rgba(25, 135, 84, 0.05) !important; 
        border-right: 4px solid #198754; 
    }
    .badge-contact { background-color: #6f42c1; color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; }
    .badge-booking { background-color: #0d6efd; color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; }
    .badge-driver { background-color: #198754; color: white; font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; }
    .service-tag { font-size: 0.85rem; padding: 4px 10px; border-radius: 5px; background: #f8f9fa; border: 1px solid #dee2e6; }
    
    .order-description {
        font-size: 0.85rem;
        color: #555;
        margin-top: 5px;
        padding: 5px 8px;
        background: #f1f3f5;
        border-radius: 6px;
        display: inline-block;
        max-width: 300px;
        line-height: 1.4;
    }
    .text-route { font-size: 0.9rem; }
</style>

<main class="main-content">
    <div class="container-fluid p-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold text-primary">طلبات ورسائل مكتب سهم (Orders & Messages)</h5>
                <button class="btn btn-primary btn-sm px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addorderModal">
                    <i class="fas fa-plus me-1"></i> Add order
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0" id="ordersTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم والتفاصيل (Client & Message)</th>
                            <th>الهاتف (Phone)</th>
                            <th>المسار (Route)</th>
                            <th>الخدمة (Service)</th>
                            <th>الحالة (Status)</th>
                            <th>العمليات (Actions)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        @php
                            $rowClass = '';
                            if($order->start_location == 'تواصل مباشر') $rowClass = 'row-contact';
                            elseif($order->service_type == 'تسجيل سائق جديد') $rowClass = 'row-driver-request';
                        @endphp
                        
                        <tr class="{{ $rowClass }}">
                            <td>{{ $order->id }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold text-dark" style="font-size: 1.05rem;">{{ $order->name }}</div>
                                    @if($order->description)
                                        <div class="order-description shadow-sm">
                                            <i class="fas fa-quote-right me-1 text-primary" style="font-size: 0.7rem;"></i> 
                                            {{ $order->description }}
                                        </div>
                                    @endif
                                    <div class="mt-2">
                                        @if($order->start_location == 'تواصل مباشر')
                                            <span class="badge badge-contact"><i class="fas fa-paper-plane me-1"></i> رسالة تواصل</span>
                                        @elseif($order->service_type == 'تسجيل سائق جديد')
                                            <span class="badge badge-driver"><i class="fas fa-id-card me-1"></i> طلب انضمام سائق</span>
                                        @else
                                            <span class="badge badge-booking"><i class="fas fa-taxi me-1"></i> طلب حجز</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td><a href="tel:{{ $order->phone }}" class="text-decoration-none">{{ $order->phone }}</a></td>
                            <td>
                                @if($order->start_location == 'تواصل مباشر' || $order->service_type == 'تسجيل سائق جديد')
                                    <small class="text-muted"><i class="fas fa-info-circle me-1"></i> بيانات تسجيل خارجية</small>
                                @else
                                    <div class="text-route">
                                        <span class="text-primary fw-600">{{ $order->start_location }}</span> 
                                        <i class="fas fa-long-arrow-alt-left mx-2 text-muted"></i> 
                                        <span class="text-success fw-600">{{ $order->end_location }}</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="service-tag">
                                    {{ $order->service_type == 'تسجيل سائق جديد' ? 'انضمام سواق' : ($order->service->title ?? 'N/A') }}
                                </span>
                            </td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">قيد الانتظار</span>
                                @elseif($order->status == 'accepted' || $order->status == 'completed' || $order->status == 'active')
                                    <span class="badge bg-success">مقبول/نشط</span>
                                @elseif($order->status == 'rejected')
                                    <span class="badge bg-danger">مرفوض</span>
                                @else
                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    @if($order->service_type == 'تسجيل سائق جديد')
                                        <form action="{{ route('admin.drivers.approve', $order->driver_id ?? 0) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success shadow-sm px-2">
                                                <i class="fas fa-user-check me-1"></i> تفعيل
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="btn btn-sm btn-outline-success border-0"><i class="fas fa-check"></i></button>
                                        </form>
                                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-outline-warning border-0"><i class="fas fa-ban"></i></button>
                                        </form>
                                    @endif

                                    <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="confirmDelete('{{ $order->id }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form id="delete-form-{{ $order->id }}" action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display: none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">لا توجد طلبات أو رسائل حالياً</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="addorderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">إضافة طلب جديد لـ "وصلني"</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                <div class="modal-body text-end" dir="rtl">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">اسم العميل</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">من (نقطة الانطلاق)</label>
                            <input type="text" name="start_location" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">إلى (جهة الوصول)</label>
                            <input type="text" name="end_location" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">نوع الخدمة</label>
                        <select name="service_id" class="form-select" required>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ملاحظات العميل</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="مثلاً: أريد سيارة سكودا أوكتافيا.."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary px-4">حفظ الطلب</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "سيتم حذف هذا الطلب نهائياً من سجلات سهم!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف!',
            cancelButtonText: 'تراجع'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush