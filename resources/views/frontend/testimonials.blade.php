<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>آراء العملاء وتقديم الشكاوى</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('assets/style.css')}}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.html">مكتب تاكسيات</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>


<header class="bg-primary text-white text-center py-5">
  <div class="container">
    <h1 class="display-4">آراء الزبائن وتقديم الشكاوى</h1>
    <p class="lead">نرحب بآرائكم واقتراحاتكم لتحسين خدماتنا</p>
  </div>
</header>

<section id="testimonials" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5">ما قاله عملائنا</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card shadow-sm p-4">
          <p class="fst-italic">"خدمة ممتازة وسائق محترف، وصلنا في الوقت المحدد!"</p>
          <p class="fw-bold text-end">- أحمد</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm p-4">
          <p class="fst-italic">"راحة وسلاسة في الرحلة، أنصح الجميع بهذا المكتب."</p>
          <p class="fw-bold text-end">- ليلى</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm p-4">
          <p class="fst-italic">"أسعار مناسبة وخدمة سريعة، تجربة رائعة!"</p>
          <p class="fw-bold text-end">- سامي</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="complaint" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">نموذج تقديم الشكاوى</h2>
    <p class="text-center mb-5">يرجى تعبئة النموذج أدناه لتقديم شكوى أو ملاحظة، وسنتواصل معكم بأسرع وقت</p>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="الاسم الكامل" required>
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" placeholder="البريد الإلكتروني" required>
          </div>
          <div class="mb-3">
            <input type="tel" class="form-control" placeholder="رقم الهاتف" required>
          </div>
          <div class="mb-3">
            <textarea class="form-control" rows="5" placeholder="اكتب شكواك هنا..." required></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-100">إرسال الشكوى</button>
        </form>
      </div>
    </div>
  </div>
</section>

<footer class="bg-dark text-white text-center py-4">
  <p class="mb-2">&copy; 2026 جميع الحقوق محفوظة لمكتب التاكسيات</p>
  <div>
    <a href="#" class="text-warning me-2"><i class="bi bi-facebook"></i></a>
    <a href="#" class="text-warning me-2"><i class="bi bi-twitter"></i></a>
    <a href="#" class="text-warning"><i class="bi bi-instagram"></i></a>
  </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
