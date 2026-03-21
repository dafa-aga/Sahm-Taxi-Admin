@extends('layouts.app') 

@section('content')
<style>
    .card-clean { border-radius: 12px; border: none; transition: 0.3s; }
    .card-clean:hover { transform: translateY(-5px); }
    .status-pending { background: #fff4e5; color: #ff9800; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; fw-bold; }
    .status-completed { background: #e8f5e9; color: #4caf50; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; fw-bold; }
    .header-row { border-bottom: 2px solid #eee; padding-bottom: 15px; }
</style>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="bi bi-speedometer2 me-2"></i>لوحة السائق: {{ Auth::user()->name }}</a>
        <div class="d-flex">
            <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل خروج</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </div>
</nav>

<main class="container py-4 my-5" dir="rtl">
    <div class="d-flex header-row align-items-center justify-content-between mb-4">
        <div>
            <h5 class="fw-bold mb-0">طلباتك الحالية</h5>
            <small class="text-muted">عرض سريع للطلبات وحالتها من قاعدة البيانات</small>
        </div>
        <div class="d-flex gap-2">
            <a href="#" class="btn btn-outline-primary active">الكل</a>
            <a href="#" class="btn btn-outline-primary">قيد التنفيذ</a>
            <a href="#" class="btn btn-outline-primary">مكتملة</a>
        </div>
    </div>

    <div class="row g-3">
        {{-- هنا نبدأ جلب البيانات الحقيقية من جدول الطلبات (Orders) --}}
        @forelse($orders as $order)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-clean shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h6 class="fw-bold mb-0">{{ $order->customer_name }}</h6>
                            <small class="text-muted">{{ $order->created_at->format('Y-m-d H:i') }}</small>
                        </div>
                        <span class="{{ $order->status == 'completed' ? 'status-completed' : 'status-pending' }}">
                            {{ $order->status == 'completed' ? 'مكتملة' : 'قيد التنفيذ' }}
                        </span>
                    </div>
                    <p class="mb-1"><strong>من:</strong> {{ $order->pickup_location }}</p>
                    <p class="mb-1"><strong>إلى:</strong> {{ $order->dropoff_location }}</p>
                    <p class="mb-2"><strong>{{ $order->service_type }}</strong></p>
                    <p class="mb-2 text-primary fw-bold">الأجرة: {{ $order->price }}$</p>
                    
                    <div class="d-flex justify-content-between actions mt-3">
                        <a class="btn btn-sm btn-outline-secondary px-3" href="#">تفاصيل</a>
                        @if($order->status != 'completed')
                            <form action="{{ route('order.complete', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success px-3">وضع كمكتمل</button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-outline-success disabled px-3">مكتملة</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
            <p class="mt-3 text-muted">لا يوجد طلبات مسجلة حالياً</p>
        </div>
        @endforelse
    </div>
</main>

<footer class="py-5 mt-5" style="background: linear-gradient(to right, #111, #333); color: #fff;">
    <div class="container text-center">
        <h5 class="mb-3">ابق على تواصل معنا</h5>
        <div class="mb-3">
            <a href="#" class="me-3 text-warning fs-5 text-decoration-none"><i class="bi bi-facebook"></i> Facebook</a>
            <a href="#" class="me-3 text-warning fs-5 text-decoration-none"><i class="bi bi-twitter"></i> Twitter</a>
            <a href="#" class="text-warning fs-5 text-decoration-none"><i class="bi bi-instagram"></i> Instagram</a>
        </div>
        <p class="mb-0 opacity-75">&copy; 2026 جميع الحقوق محفوظة لمكتب التاكسيات.</p>
    </div>
</footer>
@endsection