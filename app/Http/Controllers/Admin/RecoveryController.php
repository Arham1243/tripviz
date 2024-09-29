<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Location;
use App\Models\News;
use Illuminate\Support\Facades\Redirect;

class RecoveryController extends Controller
{
    private $columnsConfig = [
        'blogs' => [
            'title' => 'Title',
            'category' => 'Category',
            'author' => 'Author',
            'deleted_at' => 'Deleted On',
        ],
        'news' => [
            'title' => 'Title',
            'category' => 'Category',
            'author' => 'Author',
            'deleted_at' => 'Deleted On',
        ],
        'locations' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'deleted_at' => 'Deleted On',
        ],
    ];

    public function index($resource)
    {
        switch ($resource) {
            case 'blogs':
                $items = Blog::onlyTrashed()->get();
                break;
            case 'news':
                $items = News::onlyTrashed()->get();
                break;
            case 'locations':
                $items = Location::onlyTrashed()->with('parentLocation')->get();
                break;
            default:
                return Redirect::back()->with('notify_error', 'Resource not found.');
        }

        $columns = $this->columnsConfig[$resource] ?? [];
        $data = compact('items', 'resource', 'columns');

        return view('admin.recovery-management.list')->with('title', 'Recovery')->with($data);
    }
}
