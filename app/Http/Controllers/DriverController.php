<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Driver;
use App\Models\Order;

class DriverController extends Controller
{
    /**
     * 1. عرض قائمة السائقين في لوحة التحكم
     */
    public function adminIndex()
    {
        $drivers = Driver::latest()->get();
        
        // التأكد من أن المسار يطابق مجلد views/admin/drivers/index.blade.php
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * 2. تفعيل حساب السائق (قبول الطلب)
     */
    public function approve($id)
    {
        // جلب السائق أو إظهار خطأ 404
        $driver = Driver::findOrFail($id);
        
        // تحديث الحالة
        $driver->status = 'active';
        $driver->save();

        // تحديث حالة طلب الانضمام المرتبط به في جدول الأوردرات
        Order::where('driver_id', $id)->update(['status' => 'completed']);

        // العودة مع التوستر بنجاح
        return redirect()->back()->with('success', 'تم قبول طلب السائق وتفعيل حسابه بنجاح!');
    }

    /**
     * 3. معالجة تسجيل السائق الجديد
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required',
        ]);

        $imageName = 'default.png';
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('storage/drivers'), $imageName);
        }

        // إنشاء السائق بحالة معلقة
        $driver = Driver::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'nickname' => $request->nickname ?? 'بدون كنية', 
            'image'    => $imageName,
            'status'   => 'pending', 
        ]);

        // حل مشكلة الحقول الإجبارية ونقص عمود price
        Order::create([
            'driver_id'      => $driver->id,
            'name'           => 'طلب انضمام: ' . $request->name, 
            'phone'          => $request->phone,
            'start_location' => 'تسجيل جديد', 
            'end_location'   => 'لوحة التحكم',
            'service_id'     => 1, 
            'date'           => now()->format('Y-m-d'), 
            'service_type'   => 'driver_registration', 
            'status'         => 'pending',
            'price'          => 0, // ضروري عشان ما يطلع خطأ Column price not found
        ]);

        return redirect()->route('login')->with('info', 'تم تقديم طلبك بنجاح، بانتظار موافقة الإدارة لتفعيل حسابك.');
    }

    /**
     * 4. تسجيل الدخول للسائقين مع فحص التفعيل
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('driver')->attempt($credentials)) {
            $user = Auth::guard('driver')->user();
            
            // إذا كان الحساب غير مفعل
            if ($user->status !== 'active') {
                Auth::guard('driver')->logout();
                return back()->withErrors(['email' => 'حسابك لا يزال بانتظار تفعيل الإدارة.']);
            }

            $request->session()->regenerate();
            return redirect()->route('driver.dashboard');
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة'])->withInput();
    }

    /**
     * 5. رفض وحذف الطلب
     */
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);

        if ($driver->image && $driver->image != 'default.png') {
            $imagePath = public_path('storage/drivers/' . $driver->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $driver->delete();
        return back()->with('success', 'تم رفض وحذف الطلب بنجاح');
    }

    // دوال العرض البسيطة
    public function index()
    {
        $drivers = Driver::where('status', 'active')->get(); 
        return view('frontend.driver', compact('drivers'));
    }

    public function showLoginForm() { return view('frontend.driver-login'); }
    public function showRegisterForm() { return view('frontend.driver-register'); }
}