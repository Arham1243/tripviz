<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\ImageTable;

abstract class Controller
{

    public function __construct()
    {

        $logo = ImageTable::where('table_name', 'logo')->latest()->first();
        View()->share('logo', $logo);
    }
    public function shareCommonData()
    {
        $adminNotifications = auth()->guard('admin')->user()->unreadNotifications;
        dd($adminNotifications);
        View()->share('notifications', $adminNotifications);
    }

    public function someAction()
    {
        $this->shareCommonData();
        // Rest of your action logic...
    }

    public static function getConfig()
    {
        return Config::where('is_active', 1)
            ->pluck('flag_value', 'flag_type')
            ->toArray();
    }
}
