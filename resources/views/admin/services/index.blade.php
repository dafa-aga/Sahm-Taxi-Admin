@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>قائمة خدمات مكتب سهم</span>
                <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    <i class="fas fa-plus"></i> إضافة خدمة جديدة
                </button>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>صورة الخدمة</th>
                            <th>اسم الخدمة</th>
                            <th>الوصف</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" width="60"
                                            class="img-thumbnail">
                                    @else
                                        <span class="badge bg-secondary">لا توجد صورة</span>
                                    @endif
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>{{ Str::limit($service->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('admin.services.edit', $service->id) }}"
                                        class="btn btn-outline-warning btn-sm border-0">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button type="button" 
        class="btn btn-outline-danger btn-sm border-0 delete-service-btn" 
        data-url="{{ route('admin.services.destroy', $service->id) }}">
    <i class="fa fa-trash"></i>
</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">لا توجد خدمات مضافة حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">إضافة خدمة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان الخدمة</label>
                            <input type="text" name="title" class="form-control" placeholder="مثلاً: تاكسي VIP"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">صورة الخدمة</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الوصف</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="اكتب وصف الخدمة هنا..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ الخدمة</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 

    <script>
$(document).ready(function() {
    $(document).on('click', '.delete-service-btn', function() {
        let url = $(this).data('url');
        let row = $(this).closest('tr');

        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "لن تتمكن من استعادة هذه الخدمة بعد الحذف!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم، احذفها!',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST", 
                    data: {
                        _token: "{{ csrf_token() }}",
                        _method: "DELETE"
                    },
                    success: function(response) {
                        // استخدام الرسالة القادمة من السيرفر أو رسالة افتراضية
                        Swal.fire('تم الحذف!', response.message || 'تم حذف العنصر بنجاح', 'success');
                        row.fadeOut(500, function() {
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        // السطر السحري لكشف الأخطاء في الـ Console (F12)
                        console.error("Error Detail:", xhr.responseText); 
                        
                        let errorMessage = 'حدث خطأ ما أثناء محاولة الحذف.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        Swal.fire('خطأ!', errorMessage, 'error');
                    }
                });
            }
        });
    });
});
</script>
@endsection
