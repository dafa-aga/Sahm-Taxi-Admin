@extends('layouts.app') 

@section('content')
<div class="container my-5 py-5" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">إنشاء حساب سائق جديد</h2>
                        <p class="text-muted">انضم إلى فريقنا وابدأ باستقبال الطلبات الآن</p>
                    </div>

                    <form action="{{ route('driver.register.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3 text-end">
                            <label class="form-label fw-bold">الاسم الكامل</label>
                            <input type="text" name="name" class="form-control form-control-lg bg-light" placeholder="أدخل اسمك الثلاثي" required>
                        </div>

                        <div class="mb-3 text-end">
                            <label class="form-label fw-bold">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control form-control-lg bg-light" placeholder="example@mail.com" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 text-end">
                                <label class="form-label fw-bold">الكنية (أبو...)</label>
                                <input type="text" name="nickname" class="form-control bg-light" placeholder="مثلاً: أبو حمدي" required>
                            </div>
                            <div class="col-md-6 mb-3 text-end">
                                <label class="form-label fw-bold">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control bg-light" placeholder="05xxxxxxxx">
                            </div>
                        </div>

                        <div class="mb-3 text-end">
                            <label class="form-label fw-bold">كلمة المرور</label>
                            <input type="password" name="password" class="form-control form-control-lg bg-light" placeholder="••••••••" required>
                        </div>

                        <div class="mb-4 text-end">
                            <label class="form-label fw-bold">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg bg-light" placeholder="••••••••" required>
                        </div>

                        <div class="mb-4 text-end">
                            <label class="form-label fw-bold">الصورة الشخصية (اختياري)</label>
                            <input type="file" name="image" class="form-control bg-light">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm mb-3 py-3 fw-bold">إنشاء الحساب والبدء</button>
                        
                        <div class="text-center mt-2">
                            <p class="mb-0 text-muted">لديك حساب بالفعل؟ 
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">تسجيل دخول من هنا</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body { background-color: #f0f2f5; font-family: 'Cairo', sans-serif; }
    .card { border-radius: 20px !important; }
    .form-control { border: 1px solid #eee; transition: all 0.3s ease; }
    .form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
        background-color: #fff !important;
    }
    .btn-primary {
        border-radius: 12px;
        background: linear-gradient(45deg, #0d6efd, #004dbb);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #004dbb, #0d6efd);
        transform: translateY(-2px);
    }
</style>
@endsection