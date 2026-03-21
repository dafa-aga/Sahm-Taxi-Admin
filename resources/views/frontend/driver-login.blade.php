<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تسجيل دخول السائق</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/style.css')}}">
  <style>
    body { font-family: 'Cairo', sans-serif; background:#f0f2f5; }
    .login-card { max-width:450px; margin:10vh auto; border-radius: 20px; border: none; }
    .btn-primary { padding: 12px; border-radius: 10px; font-weight: bold; }
    .form-control { padding: 12px; border-radius: 10px; margin-bottom: 15px; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/">مكتب تاكسيات</a>
    </div>
  </nav>

  <main class="container">
    <div class="card login-card shadow-lg">
      <div class="card-body p-5 text-end">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary">تسجيل دخول السائق</h4>
            <p class="text-muted">مرحباً بك مجدداً، ادخل بياناتك للمتابعة</p>
        </div>

        <form action="{{ route('driver.login.submit') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control bg-light" placeholder="example@mail.com" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control bg-light" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 shadow-sm mb-3">دخول لوحة التحكم</button> 
            
            <div class="text-center mt-3">
                <span class="text-muted">ليس لديك حساب؟</span>
                <a href="{{ route('driver.register') }}" class="text-primary fw-bold text-decoration-none">أنشئ حساباً الآن</a>
            </div>
        </form>
      </div>
    </div>
  </main>

  <footer class="py-4 bg-dark text-white text-center mt-5">
    <div class="container">
      <p class="mb-0">&copy; 2026 جميع الحقوق محفوظة لمكتب التاكسيات.</p>
    </div>
  </footer>
</body>
</html>