<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class SearchSuggestionController extends Controller
{
    public function suggest(Request $request)
    {
        $query = $request->input('q');
        $suggestions = City::where('name', 'like', "%$query%")
            ->limit(10)
            ->get(['id', 'name']);

        return response()->json([
            'results' => $suggestions->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name,
                ];
            }),
        ]);
    }
}
