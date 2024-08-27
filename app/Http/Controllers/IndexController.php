<?php

namespace App\Http\Controllers;

use App\Events\ReviewAdded;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\ImageTable;
use App\Models\TourReview;
use App\Models\Newsletter;
use App\Models\Tour;
use App\Models\City;
use App\Models\Country;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\TourStory;
use App\Models\Section;
use App\Models\Promotion;
use App\Notifications\ReviewNotification;
use App\Traits\Sluggable;
use Illuminate\Support\Facades\Auth;

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
        $tours = Tour::where("is_active", 1)->where("show_on_homepage", 1)->with('reviews', 'cities', 'categories')->latest()->get()->sortByDesc('average_rating');


        $waterActivityCategory = Category::where("name", "Water Activities")
            ->where("is_active", 1)
            ->first();

        if ($waterActivityCategory) {
            $categoryId = $waterActivityCategory->id;


            $waterActivityTours = Tour::whereHas('categories', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })->where('is_active', 1)
                ->with('cities', 'categories', 'tour_attributes')
                ->latest()
                ->get()->sortByDesc('average_rating');
        } else {

            $waterActivityTours = collect();
        }


        $cities = City::where("is_active", 1)
            ->where("show_on_homepage", 1)
            ->withCount('tours')
            ->orderBy('tours_count', 'desc')
            ->latest()
            ->get();

        $countries = Country::where("is_active", 1)
            ->where("show_on_homepage", 1)
            ->latest()
            ->get();

        $testimonials = Testimonial::where("is_active", 1)->with('images')->latest()->get();
        $stories = TourStory::where("is_active", 1)->where("show_on_homepage", 1)->with('city')->latest()->get();
        $promotions = Promotion::where("is_active", 1)->latest()->get();
        $sections = Section::where("is_active", 1)->latest()->get();
        $data  = compact('stories', 'cities', 'promotions', 'tours', 'waterActivityTours', 'countries', 'testimonials', 'sections');
        return view('index')->with('title', 'Home')->with($data);
    }

    public function storyDetails($slug)
    {
        $story = TourStory::where('slug', $slug)->with('city')->first();
        return view('story-details')->with('title', $story->title)->with(compact('story'));
    }






    public function country()
    {
        return view('country')->with('title', 'Country');
    }

    public function city_details($slug)
    {
        $city = City::where('slug', $slug)->with('country')->first();
        $country = $city->country;
        $relatedCities = City::where('country_id', $country->id)->whereNot('id', $city->id)->get();
        $stories = TourStory::where("is_active", 1)->where('city_id', $city->id)->where("show_on_homepage", 1)->with('city')->latest()->get();
        $tours = $city->tours()->get()->sortByDesc('average_rating');
        $data  = compact('city', 'tours', 'relatedCities', 'stories');
        return view('city-details')->with('title', $city->name)->with($data);
    }

    public function country_details($slug)
    {
        $country = Country::where('slug', $slug)->with('continent', 'cities')->first();
        $tours = $country->tours()->with('tour_attributes', 'reviews')->get()->sortByDesc('average_rating');
        $data  = compact('country', 'tours');
        return view('country-details')->with('title', $country->name)->with($data);
    }

    public function make_slug()
    {
        $entries = City::all();
        foreach ($entries as $entry) {
            $slug = $this->createSlug($entry['name'], 'cities');
            $entry->slug = $slug;
            $entry->save();
        }
        return "Done";
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


        // Create the notification
        $admin = Admin::first();
        $notification = $admin->notify(new ReviewNotification([
            'message' => 'A new review has been added. - ' . $review->title,
            'link' => route('admin.tour-reviews.edit', $review->id),
        ]));

        // Retrieve the notification ID
        $notificationId = $admin->notifications()->latest()->first()->id;

        // Dispatch the event with the notification ID
        $data = [
            'message' => 'A new review has been added. - ' . $review->title,
            'review_id' => $review->id,
            'link' => route('admin.tour-reviews.edit', $review->id),
            'notification_id' => $notificationId, // Include the notification ID
        ];

        event(new ReviewAdded($data));

        return back()->with('notify_success', 'Review Pending For Admin Approval!');
    }
}
