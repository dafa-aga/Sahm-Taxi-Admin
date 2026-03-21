@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
    <div class="container-fluid p-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold text-primary">Recent Users</h5>
                <button class="btn btn-primary btn-sm px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus me-1"></i> Add User
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0" id="usersTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Nick Name</th>
                            <th>Image</th>
                            <th>Phone</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-bold">{{ $user->name }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $user->nick_name }}</span></td>
                                <td>
                                    @if ($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" width="45" height="45"
                                            alt="User" class="rounded-circle shadow-sm object-fit-cover">
                                    @else
                                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                            style="width: 45px; height: 45px; font-size: 12px;">No img</div>
                                    @endif
                                </td>
                                <td>{{ $user->phone }}</td>
                                <td class="text-muted small">{{ Str::limit($user->description, 40) }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> </a>
                                        
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
        class="btn btn-outline-danger btn-sm border-0 delete-user-btn" 
        data-url="{{ route('admin.users.destroy', $user->id) }}">
    <i class="fa fa-trash"></i>
</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No users found in the database.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- تضمين المودالز --}}
    @include('admin.users.partials.modals')

    {{-- المكتبات المطلوبة --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
        
        // --- 1. كود حفظ مستخدم جديد (الذي أرفقته أنت مع تحسينات) ---
        $('#saveUserBtn').click(function(e) {
            e.preventDefault();
            let form = $('#addUserForm')[0];
            let formData = new FormData(form);

            $.ajax({
                url: "{{ route('admin.users.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#saveUserBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');
                },
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            title: 'تم بنجاح!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#0d6efd'
                        }).then(() => {
                            location.reload(); 
                        });
                    }
                },
                error: function(xhr) {
                    $('#saveUserBtn').prop('disabled', false).text('Save User');
                    let errorMsg = '';
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            errorMsg += '• ' + value + '<br>';
                        });
                    } else {
                        errorMsg = 'حدث خطأ ما (Status: ' + xhr.status + ')';
                    }
                    Swal.fire({
                        title: 'تنبيه!',
                        html: '<div class="text-start text-danger">' + errorMsg + '</div>',
                        icon: 'warning'
                    });
                }
            });
        });

        // --- 2. كود حذف مستخدم (التعديل المطلوب للحذف اللائق) ---
        $(document).on('click', '.delete-user-btn', function() {
            // بدلاً من كتابة الرابط هنا، نسحبه من الزر الذي ضغطنا عليه
let url = $(this).data('url');
            let row = $(this).closest('tr');

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "سيتم حذف هذا المستخدم نهائياً من النظام!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6e7881',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
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
                            Swal.fire({
                                icon: 'success',
                                title: 'تم الحذف',
                                text: response.message || 'تم حذف المستخدم بنجاح',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            // إخفاء السطر من الجدول
                            row.fadeOut(600, function() { $(this).remove(); });
                        },
                        error: function(xhr) {
                            // عرض الخطأ الحقيقي إذا كان هناك علاقات (Orders مثلاً)
                            let msg = 'حدث خطأ أثناء الحذف';
                            if(xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            Swal.fire('خطأ!', msg, 'error');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });

    });
</script>
@endsection
