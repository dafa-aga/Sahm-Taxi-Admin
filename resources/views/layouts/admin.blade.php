<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- سطر أساسي لعمل الـ AJAX --}}
    <title>Admin Dashboard</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> 
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#">
                    <i class="fas fa-chart-line"></i> Admin Dashboard
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle"></i> Admin
                            </a>
                           <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
    <li>
        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
            <i class="fas fa-user me-2 text-primary"></i> Profile
        </a>
    </li>

    <li>
    <a class="dropdown-item" href="{{ route('admin.profile.edit') }}#settings">
        <i class="fas fa-cog me-2 text-secondary"></i> Settings
    </a>
</li>

    <li><hr class="dropdown-divider"></li>

    <li>
        <a class="dropdown-item text-danger" href="#" 
           onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        
       {{-- التعديل في السطر 54 --}}
<form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
    </li>
</ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="d-flex">
            <nav id="sidebar" class="sidebar bg-light">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                                <i class="fas fa-box"></i> Sliders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.services.index') }}">
                                <i class="fas fa-shopping-cart"></i> Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.prices.index') }}">
                                <i class="fas fa-chart-bar"></i> Prices
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                                <i class="fas fa-shopping-cart"></i> Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.drivers.index') }}">
                                <i class="fas fa-shopping-cart"></i> drivers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.complaints.index') }}">
                                <i class="fas fa-comment"></i> Complaints
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>

    {{-- المكان المخصص لاستقبال كود الـ JavaScript من صفحات الـ index --}}
    @stack('scripts')
</body>
</html>