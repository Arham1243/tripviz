<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;

class MediaController extends Controller
{
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return redirect()->back()->with('notify_success', 'Media deleted successfully.');
    }
}
