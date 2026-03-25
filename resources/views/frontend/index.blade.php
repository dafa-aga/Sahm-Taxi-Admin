<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مكتب التاكسيات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">مكتب تاكسيات</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">عن المكتب</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">خدماتنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="#prices">الأسعار</a></li>
                    <a class="nav-link" href="{{ route('drivers.public') }}">السائقين</a>
                    <li class="nav-item"><a class="nav-link" href="#booking">الحجز</a></li>
                    <li class="nav-item"><a class="nav-link" href= "testimonials.html">آراء العملاء</a></li>
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-person-circle me-1"></i> تسجيل دخول السائق
                    </a>
                </ul>
            </div>
        </div>
    </nav>

    <header id="home">
        <div class="container d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
            <h1>خدمة التاكسي الأسرع والأكثر أماناً</h1>
            <p>نقلك من وإلى أي مكان بسرعة وراحة</p>
            <a href="#booking" class="btn btn-custom">احجز رحلتك الآن</a>
        </div>
    </header>

    <section id="about" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">عن مكتبنا</h2>
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div id="aboutCarousel" class="carousel slide rounded" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#aboutCarousel" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="الشريحة 1"></button>
                            <button type="button" data-bs-target="#aboutCarousel" data-bs-slide-to="1"
                                aria-label="الشريحة 2"></button>
                        </div>
                        <div class="carousel-inner rounded">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/img/ncm1.png') }}" class="d-block w-100" alt="مكتب التاكسي">
                                <div
                                    class="carousel-caption d-none d-md-block text-dark bg-white bg-opacity-75 rounded p-2">
                                    <h5 class="fw-bold">أسطول حديث</h5>
                                    <p class="mb-0">نضمن لك رحلة آمنة ومريحة مع سائقين محترفين.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/img/ncm2.png') }}" class="d-block w-100"
                                    alt="سيارات التاكسي">
                                <div
                                    class="carousel-caption d-none d-md-block text-dark bg-white bg-opacity-75 rounded p-2">
                                    <h5 class="fw-bold">خدمة سريعة</h5>
                                    <p class="mb-0">استجابة سريعة وحجوزات مرنة لكل الأوقات.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel"
                            data-bs-slide="prev" aria-label="السابق">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">السابق</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel"
                            data-bs-slide="next" aria-label="التالي">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">التالي</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <h4 class="fw-bold mb-3 text-center">نقلك براحة وأمان</h4>
                    <p class="lead text-center">مكتبنا يقدم خدمات تاكسي احترافية بأسطول سيارات حديث وسائقين ذوي خبرة
                        عالية.</p>
                    <p class="lead text-center">نغطي جميع مناطق المدينة، رحلات المطار، وخدمات النقل الجماعي بأسعار مرنة
                        وسرعة استجابة.</p>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-dark px-2 py-2 fw-bold"
                            style="border-radius: 8px; text-decoration: none; color: #000000;">
                            تواصل معنا <i class="bi bi-telephone ms-1"></i>
                        </a>
                        <a href="#booking" class="btn btn-outline-dark px-4"><i
                                class="bi bi-calendar-check me-2"></i> احجز الآن</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">خدماتنا</h2>
            <div class="row mt-4">
                @forelse($services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top"
                                alt="{{ $service->title }}" style="height: 220px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-dark"><i
                                        class="bi bi-star-fill me-2"></i>{{ $service->title }}</h5>
                                <p class="card-text text-muted">{{ $service->description }}</p>
                                {{-- تعديل الاستدعاء ليكون أوردر رسمي --}}
                                <button class="btn btn-dark w-100 rounded-pill py-2 mt-3 fw-bold"
                                    onclick="setOfficialBooking({{ $service->id }}, '{{ $service->title }}')">
                                    طلب هذه الخدمة
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">لا توجد خدمات متاحة حالياً.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="prices" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5 fw-bold">قائمة الأسعار والخدمات</h2>
            <div class="row justify-content-center">
                @foreach ($prices as $price)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-2 transition-hover">
                            <div class="card-body">
                                {{-- اسم الخدمة في كبسولة علوية --}}
                                <div class="mb-3">
                                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2">
                                        {{ $price->service->title ?? 'خدمة عامة' }}
                                    </span>
                                </div>

                                {{-- عرض السعر بشكل بارز جداً --}}
                                <div class="price-box my-4">
                                    <span class="display-4 fw-bold text-dark">{{ $price->amount }}</span>
                                    <span class="text-primary fs-3 fw-bold">₪</span>
                                </div>

                                {{-- تفاصيل الخدمة --}}
                                <h6 class="fw-bold mb-2">{{ $price->title }}</h6>
                                <p class="text-muted small mb-3 px-2">{{ $price->description }}</p>
                            </div>

                            {{-- زر تفاعلي أسفل الكرت --}}
                            <div class="card-footer bg-transparent border-0 pb-4">
                                <a href="#orderForm" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">احجز
                                    الآن</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        /* تأثير بسيط عند تمرير الماوس لجعل الموقع حيوي */
        .transition-hover {
            transition: all 0.3s ease-in-out;
        }

        .transition-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .1) !important;
        }

        .rounded-4 {
            border-radius: 1.25rem !important;
        }
    </style>

    <section id="drivers" class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">سائقين المكتب</h2>
        <div class="row justify-content-center">
            @foreach ($drivers as $driver)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="mb-3 d-flex justify-content-center">
                            <img src="{{ $driver->image && $driver->image != 'default.png' ? asset('storage/drivers/' . $driver->image) : 'https://ui-avatars.com/api/?name=' . urlencode($driver->name) . '&background=0D6EFD&color=fff' }}" 
                                 class="rounded-circle shadow-sm"
                                 style="width: 130px; height: 130px; object-fit: cover; border: 3px solid #0d6efd;"
                                 alt="{{ $driver->name }}">
                        </div>
                        
                        <h5 class="fw-bold mb-1">{{ $driver->name }}</h5>
                        <p class="text-primary fw-bold mb-2">{{ $driver->nickname }}</p>
                        
                        @if($driver->phone)
                            <div class="text-muted small">
                                <i class="bi bi-telephone-fill"></i> {{ $driver->phone }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .transition-hover { transition: transform 0.3s ease; }
    .transition-hover:hover { transform: translateY(-10px); }
    .image-container { display: flex; justify-content: center; align-items: center; }
</style>

    <section id="booking" class="py-5" style="background: linear-gradient(90deg, #fff9e6, #fff3cc);">
        <div class="container">
            <h2 class="section-title text-center">احجز رحلتك بسهولة</h2>
            <p class="text-center mb-5">املأ النموذج أدناه وسيتواصل معك سائقنا خلال دقائق</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success_message'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong>شكراً لك!</strong> {{ session('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.orders.store') }}" method="POST" id="orderForm">
                        @csrf
                        <input type="hidden" name="service_id" id="selected_service_id">
                        <input type="hidden" name="price" id="selected_price">
                        <input type="hidden" name="payment_method" value="cash">

                        <div class="row g-3">
                            <div class="col-md-6"><input type="text" name="name" class="form-control"
                                    placeholder="الاسم الكامل" required></div>
                            <div class="col-md-6"><input type="tel" name="phone" class="form-control"
                                    placeholder="رقم الهاتف" required></div>
                            <div class="col-md-6"><input type="text" name="start_location" id="input_start"
                                    class="form-control" placeholder="بداية الرحلة" required></div>
                            <div class="col-md-6"><input type="text" name="end_location" id="input_end"
                                    class="form-control" placeholder="نهاية الرحلة" required></div>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <select name="service_id_select" id="service_select_dropdown" class="form-select"
                                    onchange="document.getElementById('selected_service_id').value = this.value">
                                    <option value="">اختر نوع الخدمة</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3"><input type="date" name="date" class="form-control"
                                    value="{{ date('Y-m-d') }}" required></div>
                            <div class="col-md-3"><input type="time" name="time" class="form-control"
                                    value="{{ date('H:i') }}" required></div>
                        </div>

                        <div class="row g-3 mt-3 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">طريقة الدفع</label>
                                <input type="text" class="form-control" value="كاش" readonly>
                                <div class="form-text">حالياً الدفع متاح كاش فقط.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">سعر التوصيل (تلقائي)</label>
                                <input type="text" class="form-control" id="price_preview" value="—" readonly>
                                <div class="form-text" id="price_hint">اختر الخدمة ليظهر السعر.</div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <textarea name="description" id="booking_description" class="form-control" rows="3"
                                placeholder="ملاحظات إضافية"></textarea>
                        </div>

                        <button type="submit" id="submit_btn" class="btn btn-warning w-100 mt-4 fw-bold py-3"
                            style="border-radius: 8px;">إرسال الحجز</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5" style="background: linear-gradient(to right, #111, #333); color: #fff;">
        <div class="container text-center">
            <h5 class="mb-3">ابق على تواصل معنا</h5>
            <div class="mb-3">
                <a href="#" class="me-3 text-warning fs-5"><i class="bi bi-facebook"></i> Facebook</a>
                <a href="#" class="me-3 text-warning fs-5"><i class="bi bi-twitter"></i> Twitter</a>
                <a href="#" class="text-warning fs-5"><i class="bi bi-instagram"></i> Instagram</a>
            </div>
            <p class="mb-0">&copy; 2026 جميع الحقوق محفوظة لمكتب التاكسيات.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        async function applyServicePrice(serviceId) {
            const hidden = document.getElementById('selected_price');
            const preview = document.getElementById('price_preview');
            const hint = document.getElementById('price_hint');

            if (!hidden || !preview) return;

            hidden.value = '';
            preview.value = '...';
            if (hint) hint.textContent = 'جاري جلب السعر...';

            try {
                const res = await fetch(`/services/${serviceId}/default-price`, {
                    headers: { 'Accept': 'application/json' },
                });

                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const data = await res.json();

                const amount = data?.amount ?? null;
                const currency = data?.currency ?? '₪';

                if (amount === null || Number.isNaN(Number(amount))) {
                    hidden.value = '';
                    preview.value = '—';
                    if (hint) hint.textContent = 'لا يوجد سعر محدد لهذه الخدمة بعد.';
                    return;
                }

                hidden.value = amount;
                preview.value = amount + ' ' + currency;
                if (hint) hint.textContent = 'تم تعبئة السعر تلقائياً حسب الخدمة المختارة.';
            } catch (e) {
                hidden.value = '';
                preview.value = '—';
                if (hint) hint.textContent = 'تعذر جلب السعر تلقائياً، جرّب مرة أخرى.';
            }
        }

        function setOfficialBooking(serviceId, serviceTitle) {
            // 1. ربط الـ ID في الحقل المخفي والمنسدل
            document.getElementById('selected_service_id').value = serviceId;
            const dropdown = document.getElementById('service_select_dropdown');
            if (dropdown) dropdown.value = serviceId;
            applyServicePrice(serviceId);

            // 2. تغيير نص الزر ليكون تأكيد حجز رسمي
            document.getElementById('submit_btn').innerText = "تأكيد طلب حجز: " + serviceTitle;

            // 3. كتابة وصف رسمي في الملاحظات لتمييز الطلب في الإدارة
            const descField = document.getElementById('booking_description');
            if (descField) descField.value = "طلب حجز رسمي لخدمة: " + serviceTitle;

            // 4. النزول السلس والتركيز على حقل البداية لضمان تعبئته
            document.getElementById('booking').scrollIntoView({
                behavior: 'smooth'
            });
            setTimeout(() => {
                document.getElementById('input_start').focus();
            }, 800);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.getElementById('service_select_dropdown');
            if (dropdown) {
                dropdown.addEventListener('change', (e) => {
                    const value = e.target.value ? Number(e.target.value) : null;
                    if (value) applyServicePrice(value);
                });
            }
        });
    </script>

</body>

</html>
