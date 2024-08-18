<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageTable;
use App\Models\TourReview;
use App\Models\Newsletter;
use App\Models\Tour;

class IndexController extends Controller
{
    public function __construct()
    {
        $logo = Imagetable::where('table_name', 'logo')->latest()->first();
        View()->share('config', $this->getConfig());
        View()->share('logo', $logo);
    }

    public function blog_details()
    {
        return view('blog-details')->with('title', 'Blog Details');
    }

    public function privacy_policy()
    {
        return view('privacy-policy')->with('title', 'Privacy Policy');
    }
    public function terms_conditions()
    {
        return view('terms-conditions')->with('title', 'Terms & Conditions');
    }
    public function blog()
    {
        return view('blog')->with('title', 'Blog');
    }
    public function index()
    {
        return view('index')->with('title', 'Home');
    }

    public function cart()
    {
        return view('cart')->with('title', 'Cart');
    }

    public function checkout()
    {
        return view('checkout')->with('title', 'Checkout');
    }

    public function country()
    {
        return view('country')->with('title', 'Country');
    }

    public function location_1()
    {
        return view('location-1')->with('title', 'Location 1');
    }

    public function location_2()
    {
        return view('location-2')->with('title', 'Location 2');
    }
    public function wishlist()
    {
        return view('wishlist')->with('title', 'Wishlist');
    }
    public function newsletter_save(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        Newsletter::create($request->all());
        return redirect()->route('index')->with('notify_success', 'Newsletter Signup successfully.');
    }

    public function save_review(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'tour_id' => 'required',
            'title' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required',
        ]);
        $review = TourReview::create($validated);

        return back()->with('notify_success', 'Review Pending For Admin Approval!');
    }
}
