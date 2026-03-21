<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // إضافة الأعمدة فقط إذا لم تكن موجودة لمنع الأخطاء
            if (!Schema::hasColumn('orders', 'driver_id')) {
                $table->unsignedBigInteger('driver_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('orders', 'service_type')) {
                $table->string('service_type')->nullable();
            }
            if (!Schema::hasColumn('orders', 'start_location')) {
                $table->string('start_location')->nullable();
            }
            if (!Schema::hasColumn('orders', 'end_location')) {
                $table->string('end_location')->nullable();
            }
            if (!Schema::hasColumn('orders', 'service_id')) {
                $table->unsignedBigInteger('service_id')->nullable();
            }
            if (!Schema::hasColumn('orders', 'date')) {
                $table->date('date')->nullable();
            }
        }); // القوس هنا كان مفقوداً في الكود الخاص بك
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['driver_id', 'service_type', 'start_location', 'end_location', 'service_id', 'date']);
        });
    }
};