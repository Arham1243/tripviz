<?php

namespace App\Http\Controllers\Admin\Tour;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class BookingController extends Controller
{
    public function index()
    {
        $tours = Tour::all();

        return view('admin.tours.booking-calendar.main', compact('tours'))->with('title', 'Tours Booking Calendar');
    }
}
