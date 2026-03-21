@extends('layouts.admin')

@section('content')
<main class="main-content">
    <div id="dashboard-content">
        <div class="container-fluid p-4">
            {{-- رسائل النجاح --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">الشكاوى المستلمة (Recent Complaints)</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addComplaintModal">
                        <i class="fas fa-plus"></i> إضافة شكوى يدوياً
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle mb-0" id="complaintsTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $complaint)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-bold">{{ $complaint->name }}</td>
                                <td>{{ $complaint->email }}</td>
                                <td>{{ $complaint->phone }}</td>
                                <td>{{ Str::limit($complaint->description, 50) }}</td>
                                <td>
                                    {{-- زر الحذف المعدل ليعمل مع السكريبت --}}
                                    <button class="btn btn-sm btn-outline-danger delete-complaint-btn" 
                                            data-url="{{ route('admin.complaints.destroy', $complaint->id) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr class="no-data">
                                <td colspan="6" class="text-center text-muted">لا يوجد شكاوى حالياً</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Modal إضافة شكوى --}}
<div class="modal fade" id="addComplaintModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('admin.complaints.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add New Complaint</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Complaint</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- سكريبت الجافا سكريبت --}}
<script>
    // 1. وظيفة الحذف الاحترافي باستخدام SweetAlert2
    $(document).on('click', '.delete-complaint-btn', function() {
        let url = $(this).data('url');
        let btn = $(this);

        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "لن تتمكن من استعادة هذه الشكوى!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        Swal.fire('تم الحذف!', 'تمت إزالة الشكوى بنجاح.', 'success');
                        btn.closest('tr').fadeOut(500); // إخفاء السطر
                    },
                    error: function() {
                        Swal.fire('خطأ!', 'حدث خطأ أثناء محاولة الحذف.', 'error');
                    }
                });
            }
        });
    });

    // 2. وظيفة التحديث التلقائي للجدول كل 15 ثانية
    function fetchComplaints() {
        $.ajax({
            url: "{{ route('admin.complaints.index') }}", 
            type: "GET",
            dataType: "json",
            success: function(data) {
                if(data.complaints && data.complaints.length > 0) {
                    let rows = '';
                    data.complaints.forEach((complaint, index) => {
                        rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td class="fw-bold">${complaint.name}</td>
                                <td>${complaint.email}</td>
                                <td>${complaint.phone}</td>
                                <td>${complaint.description.length > 50 ? complaint.description.substring(0, 50) + '...' : complaint.description}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-danger delete-complaint-btn" 
                                            data-url="/admin/complaints/${complaint.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#complaintsTable tbody').html(rows);
                }
            }
        });
    }

    // تفعيل المؤقت
    setInterval(fetchComplaints, 15000); 
</script>
@endsection