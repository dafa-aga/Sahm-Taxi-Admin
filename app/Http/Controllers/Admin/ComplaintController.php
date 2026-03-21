<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $complaints = Complaint::latest()->get();

        // لدعم التحديث التلقائي عبر Ajax
        if ($request->ajax()) {
            return response()->json(['complaints' => $complaints]);
        }

        return view('admin.complaints.index', compact('complaints'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
        ]);

        Complaint::create($request->all());

        return redirect()->back()->with('success', 'تم إضافة الشكوى بنجاح!');
    }

    public function destroy($id)
    {
        Complaint::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'تم حذف الشكوى!');
    }
}