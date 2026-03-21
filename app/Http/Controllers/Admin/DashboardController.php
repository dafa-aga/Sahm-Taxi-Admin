<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Complaint;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // جلب أرقام حقيقية من قاعدة البيانات
        $ordersCount = Order::count();
        $complaintsCount = Complaint::count();
        $servicesCount = Service::count();
        $usersCount = User::count();

        return view('admin.dashboard', compact('ordersCount', 'complaintsCount', 'servicesCount', 'usersCount'));
    }
}