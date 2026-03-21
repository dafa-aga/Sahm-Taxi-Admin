@extends('layouts.admin')

@section('title', 'تعديل الخدمة: ' . $service->title)

@section('content')
<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                <a href="{{ route('admin.services.index') }}" class="text-decoration-none text-muted">
                    <i class="fas fa-arrow-right me-1"></i> العودة لقائمة الخدمات
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-edit me-2"></i> تعديل بيانات الخدمة
                    </h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold">عنوان الخدمة</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $service->title) }}" placeholder="مثلاً: تاكسي VIP">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">تحديث صورة الخدمة</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                
                                <div class="mt-3 p-2 border rounded bg-light d-inline-block">
                                    <small class="text-muted d-block mb-2">الصورة الحالية:</small>
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" width="120" class="img-thumbnail shadow-sm">
                                    @else
                                        <span class="badge bg-secondary">لا توجد صورة حالياً</span>
                                    @endif
                                </div>
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">الوصف</label>
                                <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" 
                                          placeholder="اكتب وصف الخدمة التفصيلي هنا...">{{ old('description', $service->description) }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-light px-4">إلغاء</a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="fas fa-save me-1"></i> حفظ التغييرات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection