<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service; // هاد السطر ضروري جداً عشان المتغير $services يشتغل
use Illuminate\Http\Request; // هاد السطر ضروري عشان دالة الـ store والـ update

class OrderController extends Controller
{
    public function index()
    {
        // جلب جميع الطلبات مع علاقة الخدمة
        $orders = Order::with('service')->latest()->get();
        
        // جلب جميع الخدمات لإظهارها في الـ Modal
        $services = Service::all(); 

        // إرسال المتغيرين للصفحة
        return view('admin.orders.index', compact('orders', 'services'));
    } 

// داخل دالة store في OrderController.php
public function store(Request $request)
{
    // 1. التحقق من البيانات
    $request->validate([
        'name'  => 'required',
        'phone' => 'required',
    ]);

    try {
        // 2. حل مشكلة الخطأ الأحمر: إذا لم يختر خدمة، نأخذ ID أول خدمة تلقائياً
        // هذا السطر سيمنع ظهور رسالة SQLSTATE[23000]
        $firstService = \App\Models\Service::first();
        $serviceId = $request->filled('service_id') ? $request->service_id : ($firstService ? $firstService->id : null);

        // 3. تخزين البيانات
        \App\Models\Order::create([
            'name'           => $request->name,
            'phone'          => $request->phone,
            'service_id'     => $serviceId, 
            'start_location' => $request->input('start_location', 'تواصل مباشر'),
            'end_location'   => $request->input('end_location', 'تواصل مباشر'),
            'description'    => $request->description,
            'status'         => 'pending',
            'date'           => $request->date ?? now()->toDateString(),
            'time'           => $request->time ?? now()->toTimeString(),
        ]);

        // 4. الآن ستعمل هذه الجملة وتظهر في المربع الأخضر
        // إضافة id القسم (booking) لضمان بقاء المتصفح عند مكان الرسالة
return redirect(url()->previous() . '#booking')->with('success_message', 'تم إرسال طلبك بنجاح! سنتواصل معك قريباً.'); 


    } catch (\Exception $e) {
        // في حال حدوث خطأ آخر، سيظهر لك هنا بدلاً من الصفحة البيضاء
        return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }
}
    
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        // التحقق من الحالة المرسلة
        $request->validate([
            'status' => 'required|in:accepted,rejected,pending'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح!');
    }

    public function destroy($id)
{
    // البحث عن الطلب وحذفه من قاعدة البيانات
    $order = \App\Models\Order::findOrFail($id);
    $order->delete();

    // العودة مع رسالة نجاح تظهر في لوحة التحكم
    return redirect()->back()->with('success', 'تم حذف الطلب بنجاح من القائمة.');
}


    
}