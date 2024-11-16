<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\TourCategory;
use Illuminate\Http\Request;

class SearchSuggestionController extends Controller
{
    public function suggest(Request $request)
    {
        $query = $request->input('q');

        // Query for cities, countries, and tour categories based on the search term
        $cities = City::where('name', 'like', $query.'%')->get();
        $countries = Country::where('name', 'like', $query.'%')->get();
        $tourCategories = TourCategory::where('name', 'like', $query.'%')->get();

        // Find matches where the term appears anywhere in the name
        $citiesOthers = City::where('name', 'like', '%'.$query.'%')->get();
        $countriesOthers = Country::where('name', 'like', '%'.$query.'%')->get();
        $tourCategoriesOthers = TourCategory::where('name', 'like', '%'.$query.'%')->get();

        // Merge and sort the results to prioritize starts-with matches first
        $suggestions = $cities->merge($countries)->merge($tourCategories)
            ->merge($citiesOthers)->merge($countriesOthers)->merge($tourCategoriesOthers)
            ->sortBy(function ($item) use ($query) {
                // Sorting by whether the name starts with the query term first
                return strpos(strtolower($item->name), strtolower($query)) === 0 ? 0 : 1;
            });

        // Reindex the results
        $reindexedSuggestions = $suggestions->values(); // Reindex to start from 0

        // Return the response with the mapped and reindexed results
        return response()->json([
            'results' => $reindexedSuggestions->map(function ($item) {
                $type = null;

                // Determine the type of the suggestion
                if ($item instanceof City) {
                    $type = 'city';
                } elseif ($item instanceof Country) {
                    $type = 'country';
                } elseif ($item instanceof TourCategory) {
                    $type = 'tour_category';
                }

                return [
                    'id' => $item->id,
                    'text' => $item->name,
                    'type' => $type,
                ];
            }),
        ]);
    }
}
