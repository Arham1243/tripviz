<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeCheckoutSession;

class CheckoutController extends Controller
{

    public function index()
    {
        $cartItems = session('cart', []);
        $cartTotal = session('cart_total');
        if (empty($cartItems)) {
            return redirect()->back()->with('notify_error', 'Your cart is empty! Please add items to proceed.');
        }

        if (!Auth::check()) {
            return redirect()->back()->with('notify_error', 'Please log in to proceed with the checkout.');
        }

        $itemIds = array_keys($cartItems);
        $items = Tour::whereIn('id', $itemIds)->get();
        $data = compact('cartItems', 'items', 'cartTotal');

        return view('checkout.index')->with('title', 'Checkout')->with($data);
    }

    public function process(Request $request)
    {
        // Validate the booking form data
        $request->validate([
            // Validation rules
        ]);

        // Encode the cart session data as JSON
        $cartData = json_encode(session('cart'));

        // Initialize Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a Stripe Checkout Session
        $session = StripeCheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $this->createLineItemsFromCart($cartData),
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        // Store booking details temporarily
        session(['booking_data' => [
            'user_id' => Auth::id(),
            'country' => $request->input('country'),
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal'),
            'city' => $request->input('city'),
            'pickup_location' => $request->input('location'),
            'whatsapp_number' => $request->input('whatsapp_number'),
            'alternative_number' => $request->input('alternative_number'),
            'cart_data' => $cartData,
        ]]);

        // Redirect to Stripe Checkout
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        // Initialize Stripe and retrieve session details
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = StripeCheckoutSession::retrieve($sessionId);

        // Get the stored booking data
        $bookingData = session('booking_data');
        if (!$bookingData) {
            return redirect()->route('index')->with('notify_error', 'Booking data not found.');
        }

        // Create a new booking
        $booking = Booking::create(array_merge($bookingData, [
            'stripe_session_id' => $sessionId,
        ]));

        // Update the booking with payment status
        $paymentStatus = $session->payment_status; // Retrieve the payment status from the Stripe session
        $booking->update(['payment_status' => $paymentStatus]);

        // Clear session data
        session()->forget('booking_data'); // Clear booking data
        session()->forget('cart'); // Clear the cart
        session()->forget('cart_total'); // Clear the cart total

        return view('checkout.success')->with('title', 'Payment Successful!')->with('notify_success', 'Payment Successful!');
    }




    public function cancel()
    {
        return view('checkout.cancel')->with('title', 'Payment Cancelled!')->with('notify_success', 'Your payment was cancelled. Please try again');
    }

    private function createLineItemsFromCart($cartData)
    {
        $cartItems = json_decode($cartData, true);
        $lineItems = [];

        foreach ($cartItems as $item) {
            $tourTitle = Tour::where("id", $item['tour_id'])->first()->title ?? 'Not Available';
            $amount = $item['total'] * 100; // Assuming 'total' is provided in cents

            $lineItems[] = [
                'price_data' => [
                    'currency' => env('APP_CURRENCY_CODE'),
                    'product_data' => [
                        'name' => 'Tour Title ' . $tourTitle,
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => $item['quantity'] ?? 1,
            ];
        }

        return $lineItems;
    }
}
