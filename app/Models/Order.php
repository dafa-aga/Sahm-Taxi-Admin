<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // 
  protected $fillable = [
    'service_id', 'driver_id', 'name', 'phone', 'date', 'time', 
    'start_location', 'end_location', 'service_type', 'price', 'description', 'status'
];

// علاقة الطلب بالخدمة
public function service() {
    return $this->belongsTo(Service::class);
}
}
