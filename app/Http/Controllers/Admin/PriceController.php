<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Service;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::with('service')->latest()->get();
        $services = Service::all(); 
        return view('admin.prices.index', compact('prices', 'services'));
    }

    public function store(Request $request)
    {
        // التحقق من البيانات بالأسماء الجديدة المتوافقة مع الـ Blade
        $validated = $request->validate([
            'service_id'  => 'required|exists:services,id',
            'title'       => 'required|string|max:255', 
            'amount'      => 'required|numeric',        
            'description' => 'required|string',         
        ]);

        $price = Price::create($validated);

        // دعم الـ AJAX لنموذج الإضافة المنبثق (Modal)
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'تم إضافة السعر بنجاح']);
        }

        return redirect()->back()->with('success', 'تم إضافة السعر بنجاح');
    }  

    public function edit($id)
    {
        // جلب السعر أو إظهار خطأ 404 إذا لم يوجد
        $price = Price::findOrFail($id);
        $services = Service::all(); 
        return view('admin.prices.edit', compact('price', 'services'));
    }

    public function update(Request $request, $id)
    {
        $price = Price::findOrFail($id);

        $validated = $request->validate([
            'service_id'  => 'required|exists:services,id',
            'title'       => 'required|string|max:255', 
            'amount'      => 'required|numeric',        
            'description' => 'required|string',         
        ]);

        $price->update($validated);

        // التوجيه لصفحة الـ Index بعد التعديل اليدوي في صفحة منفصلة
        return redirect()->route('admin.prices.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();

        // دعم حذف السطر عبر AJAX في الجدول
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'تم حذف السعر بنجاح']);
        }

        return redirect()->back()->with('success', 'تم حذف السعر بنجاح');
    }
}