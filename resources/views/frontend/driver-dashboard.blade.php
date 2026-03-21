@extends('layouts.app') @section('content')
<div class="container my-5 py-5 text-end" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body bg-primary text-white rounded shadow">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">مرحباً بك، {{ Auth::user()->name }} 👋</h2>
                        <form action="{{ route('driver.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger shadow-sm">
                                <i class="bi bi-box-arrow-right"></i> تسجيل الخروج
                            </button>
                        </form>
                    </div>
                    <p class="mt-2 mb-0">أنت الآن في لوحة تحكم السائق الخاصة بك.</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-calendar-check text-primary h1"></i>
                            <h5 class="card-title text-muted mt-3">طلبات الحجز الجديدة</h5>
                            <p class="display-4 fw-bold">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-check-circle text-success h1"></i>
                            <h5 class="card-title text-muted mt-3">رحلات مكتملة</h5>
                            <p class="display-4 fw-bold">0</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body text-center py-5">
                    <p class="text-muted">لا توجد طلبات حجز حالياً. ابقَ متصلاً!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* لتنسيق الخطوط والاتجاهات */
    body { background-color: #f8f9fa; }
    .card { border-radius: 15px; }
    .display-4 { color: #2c3e50; }
</style>
@endsection