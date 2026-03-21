<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتب التاكسيات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}"> {{-- --}}
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">مكتب تاكسيات</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="#booking">احجز الآن</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.sliders.index') }}">لوحة التحكم</a></li> {{-- --}}
                </ul>
            </div>
        </div>
    </nav>

    @yield('content') {{-- هذا هو الجزء المتغير --}}

    <footer class="py-5 bg-dark text-white text-center">
        <div class="container">
            <p>&copy; 2026 جميع الحقوق محفوظة لمكتب التاكسيات</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>