<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    // 
    public function service()
{
    return $this->belongsTo(Service::class);
} 
protected $fillable = ['service_id', 'title', 'description', 'amount'];}
