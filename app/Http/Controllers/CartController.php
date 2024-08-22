<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function calculateAndUpdateTotal(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $total = 0; // Initialize the total amount

        foreach ($cart as $tourId => $item) {
            $service_fee = $item['service_fee'] ?? 0;
            $clean_service = $item['clean_service'] ?? 0;
            $extra_charges = $service_fee + $clean_service;

            $tour = Tour::find($tourId);

            if (!$tour) {
                continue;
            }

            $amount = 0;
            if ($tour->price_type == 'per_person') {
                $amount = ($item['no_of_adults'] * $tour->normalForAdultPrice()) +
                    ($item['no_of_childs'] * $tour->normalForChildPrice());
            } elseif ($tour->price_type == 'per_car') {
                $amount = $item['no_of_cars'] * $tour->normalForCarPrice();
            }

            $cart[$tourId]['per_adult_price'] = $tour->normalForAdultPrice();
            $cart[$tourId]['per_child_price'] = $tour->normalForChildPrice();
            $cart[$tourId]['per_car_price'] = $tour->normalForCarPrice();
            $cart[$tourId]['total'] = $amount + $extra_charges;

            // Accumulate the total amount for all items
            $total += $cart[$tourId]['total'];
        }

        // Save the updated cart and total into the session
        $request->session()->put('cart', $cart);
        $request->session()->put('cart_total', $total);

        return response()->json([
            'total' => $total
        ]);
    }

    public function index()
    {
        // Retrieve the cart data from the session
        $cartItems = session('cart', []);
        $cartTotal = session('cart_total');

        // Extract all tour IDs from the cart data
        $itemIds = array_keys($cartItems);

        // Query the database to get items with the extracted tour IDs
        $items = Tour::whereIn('id', $itemIds)->get();

        $data = compact('cartItems', 'items', 'cartTotal');
        return view('cart')->with('title', 'Cart')->with($data);
    }

    public function add(Request $request)
    {

        // Validate the request
        $validatedData = $request->validate([
            'tour_id' => 'required|integer',
            'start_date' => 'required|date',
            'no_of_adults' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->input('price_type') === 'per_person' && !$value) {
                        $fail('The number of adults is required!');
                    }
                },
            ],
            'no_of_childs' => 'nullable|integer',
            'no_of_cars' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->input('price_type') === 'per_car' && !$value) {
                        $fail('The number of cars is required!');
                    }
                },
            ],
        ]);

        // Retrieve existing cart from the session or initialize as an empty array
        $cart = $request->session()->get('cart', []);

        // Use the tour_id as the key
        $tourId = $validatedData['tour_id'];

        // Update or add the new tour to the cart
        $cart[$tourId] = $request->except("_token");

        // Save the updated cart data into the session
        $request->session()->put('cart', $cart);

        // Recalculate and update the total
        $this->calculateAndUpdateTotal($request);

        // Redirect to the cart page
        return redirect()->route('cart.index')
            ->with('notify_success', 'Tour Added To Cart successfully!');
    }

    public function remove(Request $request)
    {
        // Retrieve the cart from the session
        $cart = $request->session()->get('cart', []);

        // Check if the index exists in the cart array
        if (isset($cart[$request->index])) {
            // Remove the item from the cart
            unset($cart[$request->index]);

            // Save the updated cart back into the session
            $request->session()->put('cart', $cart);

            // Recalculate and update the total
            $this->calculateAndUpdateTotal($request);

            // Redirect to the checkout page
            return redirect()->route('checkout.index')
                ->with('notify_success', 'Item removed from your cart successfully!');
        }

        // Redirect with an error message if the index does not exist
        return redirect()->route('checkout.index')
            ->with('notify_error', 'Item could not be found in your cart!!');
    }

    public function updateQuantity(Request $request)
    {
        // Retrieve the cart from the session
        $cart = $request->session()->get('cart', []);

        // Get the index from the request
        $index = $request->input('index');
        $no_of_adults = $request->input('no_of_adults') ?? null;
        $no_of_childs = $request->input('no_of_childs') ?? null;
        $no_of_cars = $request->input('no_of_cars') ?? null;

        // Check if the index exists in the cart array
        if (isset($cart[$index])) {
            $cart[$index]['no_of_adults'] = $no_of_adults;
            $cart[$index]['no_of_childs'] = $no_of_childs;
            $cart[$index]['no_of_cars'] = $no_of_cars;

            // Save the updated cart back into the session
            $request->session()->put('cart', $cart);

            // Recalculate and update the total
            $this->calculateAndUpdateTotal($request);

            // Redirect to the checkout page
            return redirect()->back()
                ->with('notify_success', 'Updated successfully!');
        }

        // Redirect with an error message if the index does not exist
        return redirect()->back()
            ->with('notify_error', 'Item could not be found in your cart.');
    }
}
