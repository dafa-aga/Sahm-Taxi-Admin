@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        {{-- الجزء الأيمن: بطاقة التعريف --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <div class="position-relative d-inline-block mx-auto mb-3">
                    {{-- إصلاح وسم الصورة --}}
                    <img src="{{ (auth()->user() && auth()->user()->image) ? asset('storage/'.auth()->user()->image) : asset('assets/img/default-avatar.png') }}" 
                         class="rounded-circle img-thumbnail" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                <h5 class="fw-bold">{{ auth()->user()->name ?? 'مستخدم' }}</h5>
                <p class="text-muted small">مسؤول النظام (Admin)</p>
            </div>
        </div>

        {{-- الجزء الأيسر: الإعدادات --}}
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0">
                    <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab">الملف الشخصي</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab">إعدادات الأمان</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="profileTabsContent">
                        {{-- تبويب الملف الشخصي --}}
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">الاسم الكامل</label>
                                    {{-- القيمة يجب أن تكون داخل الـ input --}}
                                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">البريد الإلكتروني</label>
                                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">تغيير الصورة الشخصية</label>
                                    <input type="file" name="image" class="form-control">
                                    <small class="text-muted">يفضل استخدام صورة مربعة واضحة.</small>
                                </div>
                                <button type="submit" class="btn btn-primary px-4">حفظ التغييرات</button>
                            </form>
                        </div>

                        {{-- تبويب الأمان --}}
                        <div class="tab-pane fade" id="settings" role="tabpanel">
                            <form action="{{ route('admin.profile.password') }}" method="POST">
                                @csrf @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">كلمة المرور الجديدة</label>
                                    <input type="password" name="password" class="form-control" placeholder="أدخل كلمة مرور قوية">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">تأكيد كلمة المرور</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="أعد كتابة كلمة المرور">
                                </div>
                                <button type="submit" class="btn btn-dark px-4">تحديث كلمة المرور</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. فحص إذا كان الرابط يحتوي على #settings عند تحميل الصفحة لأول مرة
        if (window.location.hash === '#settings') {
            var settingsTab = new bootstrap.Tab(document.querySelector('#settings-tab'));
            settingsTab.show();
        }

        // 2. فحص إذا تغير الرابط وأنت داخل الصفحة (مثلاً ضغطت على زر Settings من المنيو)
        window.addEventListener('hashchange', function() {
            if (window.location.hash === '#settings') {
                var settingsTab = new bootstrap.Tab(document.querySelector('#settings-tab'));
                settingsTab.show();
            }
        });
    });
</script>
@endsection