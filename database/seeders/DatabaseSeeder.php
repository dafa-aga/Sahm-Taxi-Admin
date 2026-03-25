<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // بيانات تجريبية احترافية للخدمات + أسعارها (لضمان تعبئة السعر تلقائياً في نموذج الحجز)
        $airport = Service::firstOrCreate(
            ['title' => 'تاكسي المطار'],
            ['description' => 'توصيل من/إلى المطار مع التزام بالوقت وراحة عالية.', 'image' => 'services/default.png']
        );

        $city = Service::firstOrCreate(
            ['title' => 'تاكسي داخل المدينة'],
            ['description' => 'تنقلات داخل المدينة بسرعة وأمان على مدار اليوم.', 'image' => 'services/default.png']
        );

        $delivery = Service::firstOrCreate(
            ['title' => 'وصلني (توصيل طلبات)'],
            ['description' => 'توصيل أغراض/طلبات بشكل سريع داخل المدينة.', 'image' => 'services/default.png']
        );

        Price::firstOrCreate(
            ['service_id' => $airport->id, 'title' => 'سعر ثابت (مطار)'],
            ['amount' => 80.00, 'description' => 'سعر ثابت للتوصيل للمطار ضمن نطاق المدينة.']
        );

        Price::firstOrCreate(
            ['service_id' => $city->id, 'title' => 'سعر فتح العداد'],
            ['amount' => 15.00, 'description' => 'يُضاف عند بدء الرحلة داخل المدينة.']
        );

        Price::firstOrCreate(
            ['service_id' => $delivery->id, 'title' => 'سعر توصيل أساسي'],
            ['amount' => 25.00, 'description' => 'سعر توصيل أساسي لطلبات داخل المدينة (قد يختلف حسب المسافة).']
        );
    }
}
