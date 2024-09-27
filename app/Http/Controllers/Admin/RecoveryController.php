<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\News;
use Illuminate\Support\Facades\Redirect;

class RecoveryController extends Controller
{
    public function index($resource)
    {
        switch ($resource) {
            case 'blogs':
                $items = Blog::onlyTrashed()->get();
                break;
            case 'news':
                $items = News::onlyTrashed()->get();
                break;
            default:
                return Redirect::back()->with('notify_error', 'Resource not found.');
        }
        $data = compact('items', 'resource');

        return view('admin.recovery-management.list')->with('title', 'Recovery')->with($data);
    }
}
