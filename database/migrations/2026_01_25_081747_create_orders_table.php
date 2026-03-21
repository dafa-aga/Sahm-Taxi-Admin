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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('name'); // اسم الزبون
            $table->string('phone'); // جوال الزبون
            $table->date('date');
            $table->time('time');
            $table->string('start_location');
            $table->string('end_location');
            $table->text('description')->nullable();
            $table->string('status')->default('pending'); // حالة الطلب (قيد الانتظار)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
