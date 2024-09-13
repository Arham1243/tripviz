<?php

namespace App\Traits;

trait BulkActionable
{
    public function handleBulkActions($model, $columnName, $action, $selectedItems, $redirectRoute)
    {
        if ($action == 'delete') {
            if (empty($selectedItems)) {
                return redirect()->route($redirectRoute)->with('notify_error', 'No items selected.');
            }

            $model::whereIn($columnName, $selectedItems)->delete();

            return redirect()->route($redirectRoute)->with('notify_success', 'Selected items deleted successfully.');
        }

        return redirect()->route($redirectRoute)->with('notify_error', 'Invalid bulk action.');
    }
}
