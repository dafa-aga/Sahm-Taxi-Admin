@extends('layouts.admin')

@section('title', 'Edit User: ' . $user->name)

@section('content')
    <div class="container-fluid p-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3">
                    <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-muted">
                        <i class="fas fa-arrow-left"></i> Back to Users List
                    </a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-user-edit me-2"></i> Edit User Information
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Full Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" placeholder="Enter full name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nick Name</label>
                                    <<input type="text" name="nick_name"
                                        class="form-control @error('nick_name') is-invalid @enderror"
                                        value="{{ old('nick_name', $user->nick_name) }}" placeholder="e.g. Developer">

                                        @error('nick_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone Number</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $user->phone) }}" placeholder="059xxxxxxx">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">User Image</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    <div class="mt-2 d-flex align-items-center">
                                        <small class="text-muted me-2">Current:</small>
                                        @if ($user->image)
                                            <img src="{{ asset('storage/' . $user->image) }}" width="40" height="40"
                                                class="rounded-circle shadow-sm object-fit-cover">
                                        @else
                                            <span class="badge bg-light text-dark border">No Image</span>
                                        @endif
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Write something about the user...">{{ old('description', $user->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-1"></i> Update User Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
