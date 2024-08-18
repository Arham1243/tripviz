<?php

namespace App\Http\Controllers;
use App\Models\Tour;
use App\Models\ToursFaq;
use App\Models\TourItinerary;
use App\Models\TourAttribute;
use App\Models\TourExclusion;
use App\Models\TourInclusion;
use App\Models\AdditionalItem;
use App\Models\TourReview;
use Illuminate\Http\Request;

class TourController extends Controller
{
        public function details($slug)
    {
        $tour = Tour::where("slug",$slug)->with('categories','cities')->first();
        $tourFaqs = ToursFaq::where("tour_id", $tour->id)->where("is_active", 1)->with('tour')->get();
        $itineraries = TourItinerary::where("tour_id", $tour->id)->orderBy('day', 'asc')->where("is_active", 1)->get();
        $attributes = TourAttribute::where("tour_id", $tour->id)->where("is_active", 1)->get();
        $exclusions = TourExclusion::where("tour_id", $tour->id)->where("is_active", 1)->get();
        $inclusions = TourInclusion::where("tour_id", $tour->id)->where("is_active", 1)->get();
        $groupedAdditionalItems = AdditionalItem::where("tour_id", $tour->id)
    ->where("is_active", 1)
    ->with('additional')
    ->get()
    ->groupBy('additional.name');
    
        if($tour){
            $data = compact('tour','tourFaqs','itineraries','attributes','exclusions','inclusions','groupedAdditionalItems');
            return view('tours.details')->with('title', $tour->title)->with($data);   
        }
        return redirect()->back()->with('notify_error', 'Page Not Available');
    }

    public function listing()
    {
        $total_tours = Tour::where("is_active",'1')->with('categories','cities')->latest()->get();
        $tours = Tour::where("is_active",'1')->with('categories','cities','reviews')->latest()->paginate(8);
        $data = compact('tours','total_tours');
        return view('tours.listing')->with('title', 'Tour Listing')->with($data);
    }
    
  public function loadMore(Request $request)
{
    $page = $request->input('page', 1); // Get the current page, default to 1 if not provided

    $tours = Tour::where("is_active", '1')->with('categories', 'cities','reviews')->latest()->paginate(8, ['*'], 'page', $page);
   
    
    return response()->json([
        'status' => 200,
        'tours' => $tours->items(),
        'next_page_url' => $tours->nextPageUrl()
    ]);
}


}
