<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    // السماح بحفظ هذه الحقول
    protected $fillable = ['name', 'email', 'phone', 'description'];
}