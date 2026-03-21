@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-primary">تعديل بيانات السعر</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.prices.update', $price->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- ضروري جداً لإخبار لارافل أن العملية تحديث --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">الخدمة المرتبطة</label>
                        <select name="service_id" class="form-select" required>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $price->service_id == $service->id ? 'selected' : '' }}>
                                    {{ $service->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">العنوان</label>
                        <input type="text" name="title" class="form-control" value="{{ $price->title }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">القيمة (Amount)</label>
                        <input type="number" step="0.01" name="amount" class="form-control" value="{{ $price->amount }}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">الوصف</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ $price->description }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.prices.index') }}" class="btn btn-secondary px-4">إلغاء</a>
                    <button type="submit" class="btn btn-primary px-4">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection