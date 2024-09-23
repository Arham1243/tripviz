<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\Redirect;

class RecoveryController extends Controller
{
    public function index($resource)
    {
        switch ($resource) {
            case 'blogs':
                $blogs = Blog::onlyTrashed()->get();
                $data = compact('blogs');
                break;
            default:
                return Redirect::back()->with('notify_error', 'Resource not found.');
        }

        return view('admin.recovery-management.list')->with('title', 'Recovery')->with($data);
    }
}
