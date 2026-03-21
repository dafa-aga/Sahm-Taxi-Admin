<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * 1. عرض صفحة تسجيل دخول الأدمن
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * 2. معالجة عملية تسجيل الدخول
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'بيانات الاعتماد المقدمة لا تطابق سجلاتنا.',
        ]);
    }

    /**
     * 3. عرض صفحة الملف الشخصي
     */
    public function edit()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('admin.login');
        }
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * 4. تحديث البيانات (الاسم، الايميل، الصورة)
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        // حماية إضافية في حال انتهت الجلسة
        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path;
        }

        $user->save();

        return back()->with('success', 'تم تحديث بياناتك بنجاح');
    }

    /**
     * 5. تحديث كلمة المرور
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('admin.login');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'تم تغيير كلمة المرور بنجاح');
    }

    /**
     * 6. دالة تسجيل الخروج
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}