@extends('layouts.admin')

@section('content')
<main class="main-content">
    <div id="dashboard-content">
        <div class="container-fluid p-4">
            {{-- تنبيهات النجاح --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">قائمة الأسعار الحالية</h5>
                    <button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addpriceModal">
                        <i class="fas fa-plus-circle me-1"></i> إضافة سعر جديد
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle" id="pricesTable">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>الخدمة المرتبطة</th>
                                <th>العنوان</th>
                                <th>القيمة</th>
                                <th>الوصف</th>
                                <th class="text-center">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prices as $price)
                            <tr id="row-{{ $price->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge bg-soft-info text-info border border-info px-2">{{ $price->service->title ?? 'غير مرتبط' }}</span></td>
                                <td class="fw-bold">{{ $price->title }}</td>
                                <td class="text-success fw-bold">{{ number_format($price->amount, 2) }}</td>
                                <td class="text-muted small">{{ Str::limit($price->description, 50) }}</td>
                                <td class="text-center">
                                    {{-- زر الحذف المعدل مع data-url --}}
                                    <button class="btn btn-sm btn-outline-danger border-0 delete-price-btn" 
                                            data-url="{{ route('admin.prices.destroy', $price->id) }}" title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </button> 
                                    <a href="{{ route('admin.prices.edit', $price->id) }}" class="btn btn-sm btn-outline-warning border-0" title="تعديل">
    <i class="fas fa-edit"></i>
</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">لا يوجد أسعار مضافة بعد.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- المودال المعدل لضمان توافق الحقول مع الكنترولر --}}
<div class="modal fade" id="addpriceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fs-6">إضافة سعر جديد</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addPriceForm">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">اختر الخدمة</label>
                        <select name="service_id" class="form-select" required>
                            <option value="" disabled selected>-- اختر الخدمة --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">العنوان</label>
                        <input type="text" name="title" class="form-control" placeholder="مثل: عرض خاص" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">القيمة</label>
                        <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">الوصف</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    
                    <button type="submit" id="savePriceBtn" class="btn btn-primary">حفظ السعر</button>
                </div> 
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // 1. حفظ السعر عبر AJAX
    $('#addPriceForm').on('submit', function(e) {
        e.preventDefault();
        let btn = $('#savePriceBtn');
        
        $.ajax({
            url: "{{ route('admin.prices.store') }}",
            type: "POST",
            data: $(this).serialize(),
            beforeSend: function() {
                btn.prop('disabled', true).text('جارٍ الحفظ...');
            },
            success: function(response) {
                Swal.fire({ icon: 'success', title: 'تم الحفظ بنجاح', timer: 1500, showConfirmButton: false })
                .then(() => location.reload());
            },
            error: function(xhr) {
                btn.prop('disabled', false).text('حفظ السعر');
                // عرض أخطاء الـ Validation بشكل واضح
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';
                $.each(errors, function(key, value) {
                    errorMsg += value[0] + '<br>';
                });
                Swal.fire({ icon: 'error', title: 'خطأ في البيانات', html: errorMsg });
            }
        });
    });

    // 2. حذف السعر (حل مشكلة Undefined variable $user)
    $(document).on('click', '.delete-price-btn', function() {
        let url = $(this).data('url');
        let row = $(this).closest('tr');

        Swal.fire({
            title: 'هل أنت متأكد؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: { 
                        _token: "{{ csrf_token() }}", 
                        _method: "DELETE" // ضروري جداً لمسارات الـ Resource
                    },
                    success: function() {
                        row.fadeOut(500, function() { $(this).remove(); });
                        Swal.fire('تم!', 'تم حذف السعر.', 'success');
                    }
                });
            }
        });
    });
});
</script>
@endsection