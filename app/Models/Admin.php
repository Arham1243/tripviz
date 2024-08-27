<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;
    // Specify the table name if it's not the default plural form
    protected $table = 'admins';

    public $timestamps = true;
}
