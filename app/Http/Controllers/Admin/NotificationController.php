<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {

        $user = auth()->guard('admin')->user();
        if ($user) {
            $notification = $user->notifications()->find($id);

            if ($notification) {
                $notification->markAsRead();
                return response()->json(['status' => 'success']);
            }
        }

        return response()->json(['status' => 'error'], 404);
    }
}
