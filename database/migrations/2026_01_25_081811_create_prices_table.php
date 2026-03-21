<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    { 
        //أين تذهب هذه البيانات في لوحة التحكم?
        //عندما يدخل المدير إلى لوحة تحكم مكتب "سهم"، ستكون البيانات كالتالي:
        //في صفحة إضافة خدمة: يكتب "تاكسي مطار". 
        //في قسم الأسعار التابع لها: يضيف "السعر الثابت: 50$" و "سعر الحقيبة الإضافية: 5$" 
        //عندما يفتح الزبون الموقع ويختار "خدمة التاكسي العادي"، سيقوم النظام (Laravel) بعمل استعلام (Query) لجلب الأسعار المرتبطة
        //بهذه الخدمة فقط وعرضها له قبل أن يضغط على "تأكيد الحجز
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
        // ربط السعر بجدول الخدمات - إذا حذفت الخدمة يحذف سعرها تلقائياً
        $table->foreignId('service_id')->constrained()->onDelete('cascade'); 
        
        $table->string('title');          // مثال: "سعر فتح العداد" أو "سعر الكيلومتر"
        $table->double('amount', 8, 2);   // القيمة الرقمية للسعر
        $table->text('description')->nullable(); // ملاحظات إضافية
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
