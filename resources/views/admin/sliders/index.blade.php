@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Recent Sliders</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addsliderModal">
                <i class="fas fa-plus"></i> Add Slider
            </button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover mb-0" id="slidersTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $slider->title }}</td>
                        <td>
    <img src="{{ asset('assets/images/' . $slider->image) }}" 
         style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;" 
         class="shadow-sm">
</td>   
                        </td>
                        <td>{{ Str::limit($slider->description, 50) }}</td>
                        <td>
                            {{-- ابحث عن زر التعديل واستبدله بهذا السطر --}}
<a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-warning">
    <i class="fas fa-edit"></i>
</a>

                            <button class="btn btn-sm btn-danger delete-slider-btn" 
                                    data-url="{{ route('admin.sliders.destroy', $slider->id) }}">
                                <i class="fas fa-trash"></i>
                            </button> 
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addsliderModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Slider</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addsliderForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Slider</button>
                </div>
            </form>
        </div>
    </div>
</div> 


@endsection 



{{-- ثم أضف الكود هنا لضمان تحميله بعد الـ Layout --}}
@push('scripts')
<script>
$(document).ready(function() {
    $(document).on('submit', '#addsliderForm', function(e) {
        e.preventDefault(); // سيمنع ظهور الـ JSON الآن بنجاح
        
        let formData = new FormData(this);
        $.ajax({
            url: "{{ route('admin.sliders.store') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire('تم!', response.message, 'success').then(() => {
                    location.reload();
                });
            }
        });
    });
}); 
// عملية الحذف
$(document).on('click', '.delete-slider-btn', function() {
    let url = $(this).data('url');
    let row = $(this).closest('tr'); // تحديد السطر لحذفه من الجدول مباشرة

    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: "لن تتمكن من التراجع عن هذا الحذف!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'نعم، احذف الآن!',
        cancelButtonText: 'إلغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                method: "DELETE",
                data: { 
                    _token: "{{ csrf_token() }}" 
                },
                success: function(response) {
                    Swal.fire('تم الحذف!', response.message, 'success');
                    row.fadeOut(500, function() { $(this).remove(); }); // حذف السطر بتأثير بصري
                },
                error: function() {
                    Swal.fire('خطأ!', 'حدثت مشكلة أثناء الحذف', 'error');
                }
            });
        }
    });
});
</script>
@endpush