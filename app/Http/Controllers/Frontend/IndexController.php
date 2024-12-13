<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\ImageTable;
use App\Models\Newsletter;
use App\Models\Promotion;
use App\Models\Section;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourReview;
use App\Models\TourStory;
use App\Traits\Sluggable;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use Sluggable;

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
        $tours = Tour::where('status', 'publish')->with('reviews', 'cities', 'categories')->latest()->get()->sortByDesc('average_rating');

        $waterActivityCategory = Category::where('name', 'Water Activities')
            ->where('is_active', 1)
            ->first();

        if ($waterActivityCategory) {
            $categoryId = $waterActivityCategory->id;

            $waterActivityTours = Tour::whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })->where('status', 'publish')
                ->with('cities', 'categories', 'tour_attributes')
                ->latest()
                ->get()->sortByDesc('average_rating');
        } else {

            $waterActivityTours = collect();
        }

        $cities = City::where('status', 'publish')
            ->withCount('tours')
            ->orderBy('tours_count', 'desc')
            ->latest()
            ->get();

        $countries = Country::where('status', 'publish')
            ->latest()
            ->get();

        $testimonials = Testimonial::where('is_active', 1)->with('images')->latest()->get();
        $stories = TourStory::where('is_active', 1)->where('show_on_homepage', 1)->with('city')->latest()->get();
        $promotions = Promotion::where('is_active', 1)->latest()->get();
        $sections = Section::where('is_active', 1)->latest()->get();
        $data = compact('stories', 'cities', 'promotions', 'tours', 'waterActivityTours', 'countries', 'testimonials', 'sections');

        return view('index')->with('title', 'Home')->with($data);
    }

    public function storyDetails($slug)
    {
        $story = TourStory::where('slug', $slug)->with('city')->first();

        return view('story-details')->with('title', $story->title)->with(compact('story'));
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

    public function country_details($slug)
    {
        $country = Country::where('slug', $slug)->with('continent', 'cities')->first();
        $tours = $country->tours()->with('tour_attributes', 'reviews')->get()->sortByDesc('average_rating');
        $data = compact('country', 'tours');

        return view('country-details')->with('title', $country->name)->with($data);
    }

    public function make_slug()
    {
        $entries = City::latest()->get();
        foreach ($entries as $entry) {
            $slug = $this->createSlug($entry['name'], 'cities');
            $entry->slug = $slug;
            $entry->save();
        }

        return 'Done';
    }

    public function wishlist()
    {
        return view('wishlist')->with('title', 'Wishlist');
    }

    public function save_newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        Newsletter::create($request->all());

        return redirect()->back()->with('notify_success', 'Newsletter Signup successfully.');
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
