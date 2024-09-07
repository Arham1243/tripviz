<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'social_id', 'full_name', 'email', 'social_token', 'avatar', 'signup_method', 'password', 'email_verification_token',
    ];
    // public $timestamps = true;

    //  public function getEmailVerifiedAttribute($value)
    // {
    //     return $value == 1 ? 'yes' : 'no';
    // }
}
