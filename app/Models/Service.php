<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //  
    public function prices()
{
    // الخدمة الواحدة قد يكون لها أكثر من تسعيرة (مثل سعر نهار وسعر ليل)
    return $this->hasMany(Price::class);
} 
protected $fillable = ['title', 'description', 'image'];
    
}
