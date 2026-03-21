<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // أضفنا هذا السطر لاستخدامه في التحقق

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // هنا نخبر لارافيل أين يوجه "الضيوف" (غير المسجلين)
        $middleware->redirectGuestsTo(function (Request $request) {
            // إذا كان الرابط يبدأ بكلمة admin، وجهه لصفحة دخول الأدمن
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            }
            // غير ذلك (مثل السائق)، وجهه لصفحة الدخول العادية
            return route('login');
        });

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();