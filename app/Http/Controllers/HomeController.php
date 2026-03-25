<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;   // استدعاء موديل السلايدر
use App\Models\Service;  // استدعاء موديل الخدمات

class HomeController extends Controller
{
  public function index()
{
    $services = \App\Models\Service::with('prices')->get();
    $sliders = \App\Models\Slider::all();
    $prices = \App\Models\Price::with('service')->get(); 
    
    // جلب السائقين الذين سنضيفهم لاحقاً من لوحة التحكم
    $drivers = \App\Models\Driver::all(); 

    return view('frontend.index', compact('services', 'sliders', 'prices', 'drivers'));
}
}