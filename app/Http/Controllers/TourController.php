<?php

namespace App\Http\Controllers;

use App\Models\AdditionalItem;
use App\Models\City;
use App\Models\Country;
use App\Models\Tour;
use App\Models\TourAttribute;
use App\Models\TourCategory;
use App\Models\TourExclusion;
use App\Models\TourInclusion;
use App\Models\TourItinerary;
use App\Models\ToursFaq;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function details($slug)
    {
        $tour = Tour::where('slug', $slug)->with('categories', 'cities')->first();
        $tourFaqs = ToursFaq::where('tour_id', $tour->id)->where('is_active', 1)->with('tour')->get();
        $itineraries = TourItinerary::where('tour_id', $tour->id)->orderBy('day', 'asc')->where('is_active', 1)->get();
        $attributes = TourAttribute::where('tour_id', $tour->id)->where('is_active', 1)->get();
        $exclusions = TourExclusion::where('tour_id', $tour->id)->where('is_active', 1)->get();
        $inclusions = TourInclusion::where('tour_id', $tour->id)->where('is_active', 1)->get();
        $groupedAdditionalItems = AdditionalItem::where('tour_id', $tour->id)
            ->where('is_active', 1)
            ->with('additional')
            ->get()
            ->groupBy('additional.name');

        if ($tour) {
            $data = compact('tour', 'tourFaqs', 'itineraries', 'attributes', 'exclusions', 'inclusions', 'groupedAdditionalItems');

            return view('tours.details')->with('title', $tour->title)->with($data);
        }

        return redirect()->back()->with('notify_error', 'Page Not Available');
    }

    public function searchResults()
    {
        return view('tours.search-results')->with('title', 'Search Results');
    }

    public function showSearchResults(Request $request)
    {
        $resourceId = $request->input('resource_id');
        $resourceType = $request->input('resource_type');
        $tours = collect();

        switch ($resourceType) {
            case 'city':
                $city = City::find($resourceId);
                if ($city) {
                    $tours = $city->tours()->where('status', 'publish')->get();
                }
                break;
            case 'country':
                $country = Country::find($resourceId);
                if ($country) {
                    $tours = Tour::whereHas('cities', function ($query) use ($country) {
                        $query->where('country_id', $country->id);
                    })->where('status', 'publish')->get();
                }
                break;

            case 'category':
                $category = TourCategory::find($resourceId);
                if ($category) {
                    $tours = $category->tours()->where('status', 'publish')->get();
                }
                break;

            default:
                $tours = collect();
                break;
        }

        return view('tours.search-results', compact('tours'))->with('title', 'Tour Search Results');
    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1); // Get the current page, default to 1 if not provided

        $tours = Tour::where('is_active', '1')->with('categories', 'cities', 'reviews')->latest()->paginate(8, ['*'], 'page', $page);

        return response()->json([
            'status' => 200,
            'tours' => $tours->items(),
            'next_page_url' => $tours->nextPageUrl(),
        ]);
    }
}
