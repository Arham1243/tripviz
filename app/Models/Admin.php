<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // Specify the table name if it's not the default plural form
    protected $table = 'admins';

    public $timestamps = true;
}
