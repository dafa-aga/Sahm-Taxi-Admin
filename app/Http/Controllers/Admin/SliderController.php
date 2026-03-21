<?php

namespace App\Http\Controllers\Admin;
use App\Models\Slider; // تأكد من إضافة هذا السطر هنا <---
use App\Http\Controllers\Controller;
use App\Models\SiteUser; // التأكد من استخدام الموديل الصحيح
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
      $sliders = Slider::all();
    return view('admin.sliders.index', compact('sliders'));
    }

    // app/Http/Controllers/Admin/SliderController.php

public function store(Request $request)
{
    $request->validate([
        'title' => 'nullable|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
    ]);

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();  
        // الحفظ داخل مجلد public/assets/images
        $request->image->move(public_path('assets/images'), $imageName);

        \App\Models\Slider::create([
            'title' => $request->title,
            'image' => $imageName, // بنخزن اسم الملف فقط
            'description' => $request->description,
        ]);

        return response()->json(['status' => 'success', 'message' => 'تم إضافة السلايدر بنجاح!']);
    }
}


public function edit(Slider $slider)
{
    // هذه الدالة هي المسؤولة عن فتح صفحة التعديل وإرسال بيانات السلايدر لها
    return view('admin.sliders.edit', compact('slider'));
}

public function update(Request $request, Slider $slider)
{
    $slider->title = $request->title;
    $slider->description = $request->description;

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة من التخزين لتوفير المساحة
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        
        // رفع الصورة الجديدة
        $path = $request->file('image')->store('sliders', 'public');
        $slider->image = $path;
    }

    $slider->save();

    return redirect()->route('admin.sliders.index')->with('success', 'تم تحديث السلايدر بنجاح');
}

    public function destroy(Slider $slider)
{
    try {
        // حذف ملف الصورة من السيرفر لتوفير مساحة
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        
        $slider->delete();
        return response()->json(['status' => 'success', 'message' => 'تم حذف السلايدر بنجاح']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'فشل الحذف'], 500);
    }
}
}