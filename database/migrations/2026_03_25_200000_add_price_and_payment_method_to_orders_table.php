<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('service_id');
            }

            if (! Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('orders', 'payment_method')) {
                $columns[] = 'payment_method';
            }

            if (Schema::hasColumn('orders', 'price')) {
                $columns[] = 'price';
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};

