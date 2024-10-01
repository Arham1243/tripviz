<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\City;
use App\Models\Country;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BulkActionController extends Controller
{
    public function handle(Request $request, $resource)
    {
        $action = $request->input('bulk_actions');
        $selectedIds = $request->input('bulk_select', []);
        if (empty($selectedIds)) {
            return Redirect::back()->with('notify_error', 'No items selected for the bulk action.');
        }

        switch ($resource) {
            case 'blogs':
                $modelClass = Blog::class;
                $column = 'slug';
                $redirectRoute = 'admin.blogs.index';
                break;
            case 'blogs-tags':
                $modelClass = BlogTag::class;
                $column = 'slug';
                $redirectRoute = 'admin.blogs-tags.index';
                break;
            case 'blogs-categories':
                $modelClass = BlogCategory::class;
                $column = 'slug';
                $redirectRoute = 'admin.blogs-categories.index';
                break;
            case 'news':
                $modelClass = News::class;
                $column = 'slug';
                $redirectRoute = 'admin.news.index';
                break;
            case 'news-tags':
                $modelClass = NewsTag::class;
                $column = 'slug';
                $redirectRoute = 'admin.news-tags.index';
                break;
            case 'news-categories':
                $modelClass = NewsCategory::class;
                $column = 'slug';
                $redirectRoute = 'admin.news-categories.index';
                break;
            case 'countries':
                $modelClass = Country::class;
                $column = 'slug';
                $redirectRoute = 'admin.countries.index';
                break;
            case 'cities':
                $modelClass = City::class;
                $column = 'slug';
                $redirectRoute = 'admin.cities.index';
                break;

            default:
                return Redirect::back()->with('notify_error', 'Resource not found.');
        }

        return $this->handleBulkActions($modelClass, $column, $action, $selectedIds, $redirectRoute);
    }

    protected function handleBulkActions($modelClass, $idColumn, $action, $selectedIds, $redirectRoute)
    {
        switch ($action) {
            case 'delete':
                $modelClass::whereIn($idColumn, $selectedIds)->each(function ($model) {
                    $model->delete();
                });
                break;
            case 'draft':
                $modelClass::whereIn($idColumn, $selectedIds)->update(['status' => 'draft']);
                break;
            case 'publish':
                $modelClass::whereIn($idColumn, $selectedIds)->update(['status' => 'publish']);
                break;
            case 'restore':
                $modelClass::withTrashed()->whereIn($idColumn, $selectedIds)->each(function ($model) {
                    $model->restore();
                });
                break;
            case 'permanent_delete':
                $modelClass::onlyTrashed()->whereIn($idColumn, $selectedIds)->each(function ($model) {
                    $model->forceDelete();
                });
                break;
            default:
                break;
        }

        return redirect()->route($redirectRoute)->with('notify_success', 'Bulk action performed successfully!');
    }
}
