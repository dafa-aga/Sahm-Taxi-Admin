<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service; // أضفنا هذا السطر لتبسيط الكود
use Illuminate\Support\Facades\Storage;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب كل الخدمات مع أسعارها المرتبطة بها
        $services = Service::with('prices')->get(); 
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // رفع الصورة وتخزين مسارها
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

        // التعديل هنا: أضفنا .index ليتطابق مع اسم الراوت في ملف web.php
        return redirect()->route('admin.services.index')->with('success', 'تمت إضافة الخدمة لمكتب سهم بنجاح!'); 
    }

    // ... باقي الدوال (show, edit, update, destroy) تبقى كما هي 
    public function edit($id)
{
    $service = Service::findOrFail($id);
    return view('admin.services.edit', compact('service'));
} 

public function update(Request $request, $id)
{
    $service = Service::findOrFail($id);
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'icon' => 'nullable' // إذا كنت تستخدم أيقونات أو صور
    ]);

    $service->update($data);
    return redirect()->route('admin.services.index')->with('success', 'تم تحديث الخدمة بنجاح');
}

// 3. تنفيذ الحذف (Destroy) عبر AJAX
public function destroy($id)
{
    try {
            $service = Service::findOrFail($id);
            
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $service->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الخدمة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
}


}