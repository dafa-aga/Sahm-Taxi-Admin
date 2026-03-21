@extends('layouts.admin') {{-- تأكد أن هذا اسم الملف الذي أرسلته لي --}}

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5>Orders</h5>
                    <h2>{{ $ordersCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h5>Complaints</h5>
                    <h2>{{ $complaintsCount }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5>Services</h5>
                    <h2>{{ $servicesCount }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection