<?php

namespace App\Models;

// تأكد من استدعاء Authenticatable وليس Model العادي
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Driver extends Authenticatable
{
    use Notifiable;

    protected $table = 'drivers'; // لضمان الربط بجدول drivers اللي في phpMyAdmin

    protected $fillable = [
        'name', 'email', 'password', 'nickname', 'image', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}