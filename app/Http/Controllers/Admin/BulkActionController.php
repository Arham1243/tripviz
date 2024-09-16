<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BulkActionController extends Controller
{
    public function handle(Request $request, $resource)
    {
        $action = $request->input('bulk_actions');
        $selectedIds = $request->input('bulk_select', []);

        switch ($resource) {
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
            default:
                return Redirect::back()->withErrors('Resource not found.');
        }

        return $this->handleBulkActions($modelClass, $column, $action, $selectedIds, $redirectRoute);
    }

    protected function handleBulkActions($modelClass, $idColumn, $action, $selectedIds, $redirectRoute)
    {
        $modelClass::whereIn($idColumn, $selectedIds)->each(function ($model) use ($action) {
            switch ($action) {
                case 'delete':
                    $model->delete();
                    break;
                default:
                    break;
            }
        });

        return redirect()->route($redirectRoute)->with('notify_success', 'Bulk action Performed Successfully.');
    }
}
