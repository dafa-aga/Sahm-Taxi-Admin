@extends('layouts.admin')
@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary">إدارة طلبات انضمام السائقين</h4>
        <span class="badge bg-primary px-3 py-2">{{ count($drivers) }} طلبات جديدة</span>
    </div>

    <div class="row">
        @forelse($drivers as $driver)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100 border-0 shadow-sm text-center p-3" style="border-radius: 15px;">
                <div class="position-relative">
                    <img src="{{ asset('storage/drivers/' . ($driver->image ?? 'default.png')) }}" 
                         alt="{{ $driver->name }}" 
                         class="rounded-circle border border-4 border-white shadow-sm mb-3" 
                         width="120" height="120" style="object-fit: cover;">
                </div>
                
                <h5 class="fw-bold mb-1">{{ $driver->name }}</h5>
                <p class="text-primary fw-bold mb-1">{{ $driver->nickname ?? 'بدون كنية' }}</p>
                <p class="text-muted small mb-3">
                    <i class="fas fa-phone-alt me-1"></i> {{ $driver->phone }}
                </p>

                <div class="d-grid gap-2 d-md-flex justify-content-center mt-auto">
                    {{-- زر التأكيد والقبول --}}
                    <form action="{{ route('admin.drivers.approve', $driver->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm px-4 rounded-pill">
                            تأكيد وقبول
                        </button>
                    </form>

                    {{-- زر الرفض والحذف --}}
                    <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رفض وحذف هذا الطلب؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm px-4 rounded-pill">
                            رفض وحذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light p-5 rounded-3">
                <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                <p class="text-muted h5">لا توجد طلبات انضمام جديدة حالياً.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection