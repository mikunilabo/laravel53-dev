<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    
    protected $fillable = [
            'name',
            'email',
            'password',
    ];
    
    protected $hidden = [
            'password',
            'remember_token',
    ];
    
    protected $dates = [
            'confirmation_sent_at',
            'confirmed_at',
    ];
    
    protected $casts = [
            'status' => 'bool',
    ];
}
