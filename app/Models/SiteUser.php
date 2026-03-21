<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteUser extends Model
{
    // 
    protected $fillable = ['name', 'nick_name', 'phone', 'image', 'description'];
}
