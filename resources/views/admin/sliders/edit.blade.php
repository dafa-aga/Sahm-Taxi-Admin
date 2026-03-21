@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Edit Slider: {{ $slider->title }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- ضروري جداً لعمل التحديث --}}

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $slider->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                   <td>{{-- تأكد من استخدام storage وليس assets --}}
<img src="{{ asset('storage/' . $slider->image) }}" width="80" class="img-thumbnail" alt="Slider Image">
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Leave blank if you don't want to change the image</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5">{{ $slider->description }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Back to List</a>
                    <button type="submit" class="btn btn-warning">Update Slider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection