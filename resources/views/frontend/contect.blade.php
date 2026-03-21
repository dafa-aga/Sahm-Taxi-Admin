<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تواصل معنا - مكتب سهم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .navbar { background: #1a1a1a; }
        
        /* خدعة إطار الجوال الاحترافية */
        .phone-container {
            position: relative;
            width: 250px;
            height: 500px;
            margin: auto;
            border: 12px solid #222; /* إطار الجوال الأسود */
            border-radius: 35px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .phone-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* الكاميرا الأمامية للجوال */
        .phone-container::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 18px;
            background: #222;
            border-radius: 10px;
            z-index: 10;
        }

        .btn-custom-outline {
            background-color: #fff;
            color: #333;
            border: 1px solid #333;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none !important; 
            padding: 8px 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
        }

        .contact-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
            height: 100%;
        }

        /* تحسين شكل المدخلات */
        .form-control:focus {
            box-shadow: none;
            border-bottom: 2px solid #0d6efd !important;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">مكتب سهم للتاكسيات</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/">الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('contact.index') }}">تواصل معنا</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-5 my-5">
  <div class="row justify-content-center">
    
    <div class="col-md-11 bg-white shadow-sm rounded-4 p-5 mb-5">
        <div class="row align-items-center">
            <div class="col-md-5 mb-4 mb-md-0">
                <div class="phone-container">
                    <img src="{{asset('assets/img/تنزيل.jpg')}}" alt="Mobile View">
                </div>
            </div>

            <div class="col-md-7">
                <h2 class="mb-4 fw-bold">أرسل لنا رسالة</h2> 
                @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif 
@if(session('success_message'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>شكراً لك!</strong> {{ session('success_message') }}
                <button type="button" class="btn-close" onclick="this.parentElement.remove()" aria-label="Close"></button>
            </div>
        @endif
               <form action="{{ route('admin.orders.store') }}" method="POST">
    @csrf
    <input type="hidden" name="start_location" value="تواصل مباشر">
    <input type="hidden" name="end_location" value="تواصل مباشر">
    <input type="hidden" name="service_id" value=""> 

    <div class="mb-3">
        <label class="form-label">الاسم الكامل</label>
        <input type="text" name="name" class="form-control" placeholder="أدخل اسمك" required>
    </div>

    <div class="mb-3">
        <label class="form-label">رقم الهاتف</label>
        <input type="tel" name="phone" class="form-control" placeholder="059xxxxxxx" required>
    </div>

    <div class="mb-3">
        <label class="form-label">تفاصيل الرسالة</label>
        <textarea name="description" class="form-control" rows="4" placeholder="كيف يمكننا مساعدتك؟" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">إرسال الرسالة الآن</button>
</form>
            </div>
        </div>
    </div>

    <div class="col-md-11">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="contact-card">
                    <p class="text-muted mb-2">البريد الإلكتروني</p>
                    <h5 class="fw-bold mb-4">mohammedehap977@gmail.com</h5>
                    <div class="social-icons d-flex justify-content-center gap-3">
                        <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" width="30"></a>
                        <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" width="30"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-card">
                    <p class="text-muted mb-2">اتصل بنا مباشرة</p>
                    <h5 class="fw-bold mb-4">0592189100</h5>
                    <a href="tel:0592189100" class="btn-custom-outline px-5 py-2">
                        اتصل الآن <i class="bi bi-telephone ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

  </div>
</div>

<footer class="py-4 mt-5 bg-dark text-white text-center">
    <p class="mb-0 opacity-75">&copy; 2026 جميع الحقوق محفوظة - مكتب سهم للتاكسيات</p>
</footer>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'تم الإرسال بنجاح',
        text: 'شكراً يا محمد، سنتواصل معك قريباً.',
        confirmButtonColor: '#0d6efd'
    });
</script>
@endif

</body>
</html>