<?php

namespace App\Http\Controllers\Frontend\Locations;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;

class CountryController extends Controller
{
    public function show($slug)
    {
        $item = Country::where('slug', $slug)->firstOrFail();
        $relatedCities = City::where('country_id', $item->id)
            ->where('status', 'publish')
            ->get();

        $tours = $relatedCities->flatMap(function ($city) {
            return $city->tours;
        })->sortByDesc('average_rating');

        $data = compact('item', 'tours', 'relatedCities');

        return view('frontend.locations.country.details')
            ->with('title', ucfirst(strtolower($item->name)))
            ->with($data);
    }
}
