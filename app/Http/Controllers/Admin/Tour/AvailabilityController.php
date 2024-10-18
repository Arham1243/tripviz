<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Traits\Sluggable;
use App\Traits\UploadImageTrait;

class AvailabilityController extends Controller
{
    use Sluggable;
    use UploadImageTrait;

    public function index()
    {
        // $tours = Tour::where('status', 'publish')->get();
        $tours = Tour::all();

        return view('admin.tours.availability.main', compact('tours'))->with('title', 'Tours Availability Calendar');
    }
}
