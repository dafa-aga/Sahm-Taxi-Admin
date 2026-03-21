<?php

namespace App\Http\Controllers\Admin; // هذا هو المسار الصحيح بما أن الملف داخل مجلد Admin

use App\Http\Controllers\Controller; // يجب استدعاء الكنترولر الأساسي هنا
use App\Models\SiteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SiteUserController extends Controller
{
    // عرض المستخدمين
    public function index()
    {
        $users = SiteUser::all(); // تم تبسيط الاستدعاء لأننا عملنا use فوق
        return view('admin.users.index', compact('users'));
    }

    // تخزين مستخدم جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('users', 'public');
        }

        $data['nick_name'] = $request->nickname; 
        $data['description'] = $request->description;

        SiteUser::create($data);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'تم إضافة المستخدم بنجاح!'
            ]);
        }

        return back()->with('success', 'تم إضافة المستخدم بنجاح!');
    } 


    // لعرض صفحة التعديل
public function edit($id)
{
    $user = SiteUser::findOrFail($id);
    // جرب هذا المسار إذا كنت واضع الملف داخل مجلد admin/users
    return view('admin.users.edit', compact('user'));
}

// لتنفيذ عملية الحذف
public function destroy($id)
{
    try {
        $user = \App\Models\SiteUser::findOrFail($id);

        // حذف الصورة ليبقى السيرفر نظيفاً
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'تم حذف المستخدم بنجاح.'
        ]);
    } catch (\Exception $e) {
        // في حال كان المستخدم مرتبط بطلبات أو شكاوى
        return response()->json([
            'status' => 'error',
            'message' => 'عذراً، لا يمكن حذف هذا المستخدم حالياً لوجود بيانات مرتبطة به.'
        ], 500);
    }
}

public function update(Request $request, $id)
{
    $user = SiteUser::findOrFail($id);

    // التحقق من البيانات (Validation)
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'nick_name' => 'nullable|string',
        'phone' => 'nullable',
        'description' => 'nullable',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // إذا تم رفع صورة جديدة
    if ($request->hasFile('image')) {
        // احذف القديمة إذا أردت توفير مساحة
        // Storage::delete('public/'.$user->image); 
        $data['image'] = $request->file('image')->store('users', 'public');
    }

    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'تم تحديث البيانات بنجاح');
}
}