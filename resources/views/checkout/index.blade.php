@extends('layouts.main')
@section('content')
    <!-- Checkout -->
    <div class="checkout my-5 py-5">
        <div class="container">
            <div class="checkout-Mainheading">
                <div class="checkout-heading">
                    <h4>Product Checkout</h4>
                </div>

                <div class="checkout__order-list">
                    <div class="checkout__order-list__info">
                        <div class="checkout__order-list__infoIcon">
                            <i class='bx bx-check'></i>
                        </div>
                        <div class="checkout__order-list__infoTitle">
                            Information
                        </div>
                    </div>
                    <div class="checkout__order-list__info">
                        <div class="checkout__order-list__infoNum">
                            2
                        </div>
                        <div class="checkout__order-list__infoTitle">
                            Payment Details
                        </div>
                    </div>
                    <div class="checkout__order-list__info">
                        <div class="checkout__order-list__infoNum">
                            3
                        </div>
                        <div class="checkout__order-list__infoTitle">
                            Complete Order
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-lg-7">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="subTotal" id="subTotal">
                        <input type="hidden" name="total" id="total">
                        <div class="checkout__billingForm">
                            <div>
                                <label for="firstName">First Name <span>*</span></label>
                                <input type="text" name="firstName" id="firstName" value="{{ old('firstName') }}" required>
                                @error('firstName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="lastName">Last Name <span>*</span></label>
                                <input required type="text" name="lastName" id="lastName" value="{{ old('lastName') }}">
                                @error('lastName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="email">Email <span>*</span></label>
                                <input required type="email" name="email" id="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="phone">Phone <span>*</span></label>
                                <input required type="text" name="phone" id="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="country">Country <span>*</span></label>
                                <input required type="text" name="country" id="country" value="{{ old('country') }}">
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="city">City <span>*</span></label>
                                <input required type="text" name="city" id="city" value="{{ old('city') }}">
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="address">Address <span>*</span></label>
                                <input required type="text" name="address" id="address" value="{{ old('address') }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="postal">Postal Code <span>*</span></label>
                                <input required type="text" name="postal" id="postal" value="{{ old('postal') }}">
                                @error('postal')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>

                        <div class="checkout__billingForm mt-4">
                            <div class="checkout-heading">
                                <h4>Booking Details</h4>
                            </div>

                            <div>
                                <label for="location">Pickup Location <span>*</span></label>
                                <input type="text" name="location" id="location" value="{{ old('location') }}">
                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="checkout__billingForm-wp">
                                <label for="whatsapp_number">WhatsApp Number <span>*</span></label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number"
                                    value="{{ old('whatsapp_number') }}">
                                @error('whatsapp_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="alternative_number">Alternative Number <span>*</span></label>
                                <input type="text" name="alternative_number" id="alternative_number"
                                    value="{{ old('alternative_number') }}">
                                @error('alternative_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-guest__btn">
                            <button type="submit" class="app-btn themeBtn">Proceed to Checkout</button>
                        </div>

                    </form>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="checkout__orderOverview">
                        <div class="checkout-heading">
                            <h4>Order Overview</h4>
                        </div>

                        @php
                            $subTotal = 0;
                        @endphp
                        @foreach ($items as $item)
                            <div class="option-wrapper">
                                <div class="option">
                                    <div class="option-title">{{ $item->title }}</div>
                                    @if ($item->price_type == 'per_person')
                                        <div>{{ $cartItems[$item->id]['no_of_adults'] }}
                                            Adult{{ $cartItems[$item->id]['no_of_adults'] > 1 ? 's' : '' }} <span>x</span>
                                            {{ $item->normalForAdultPrice() }}</div>
                                        <div>{{ $cartItems[$item->id]['no_of_childs'] }}
                                            Child{{ $cartItems[$item->id]['no_of_childs'] > 1 ? 's' : '' }}
                                            <span>x</span> {{ $item->normalForChildPrice() }}
                                        </div>
                                    @elseif ($item->price_type == 'per_car')
                                        <div>{{ $cartItems[$item->id]['no_of_cars'] }}
                                            Car{{ $cartItems[$item->id]['no_of_cars'] > 1 ? 's' : '' }} <span>x</span>
                                            {{ $item->normalForCarPrice() }}</div>
                                    @endif
                                </div>

                                <div class="option">
                                    {{ env('APP_CURRENCY') . $cartItems[$item->id]['total'] }}
                                </div>


                            </div>
                        @endforeach


                        <div>
                            <span>Sub Total</span>
                            <span data-sub-total="{{ $cartTotal }}"
                                id="subTotalAmount">{{ env('APP_CURRENCY') . $cartTotal }}</span>
                        </div>
                        <div class="checkout__orderOverviewTotal">
                            <span>Total</span>
                            <span data-total="{{ $cartTotal }}"
                                id="totalAmount">{{ env('APP_CURRENCY') . $cartTotal }}</span>
                        </div>
                    </div>
                    <div class="checkout__order-cardMain">
                        @foreach ($items as $item)
                            <div class="checkout__order-card">
                                <div class="checkout__order-card__content">
                                    <a href="{{ route('tours.details', $item->slug) }}"
                                        class="checkout__order-card__img">
                                        <img src="{{ asset($item->img_path ?? 'assets/images/placeholder.png') }}"
                                            alt='{{ $item->title }}' class='imgFluid' loading='lazy'>
                                    </a>
                                    <div class="checkout__order-card__deatils">
                                        <div class="checkout__order-card__heading">
                                            {{ $item->title }}
                                        </div>
                                        {{-- <div class="checkout__order-cardQuantity-btns">
                                                <button><i class="bx bx-minus"></i></button>
                                                <input type="text" value="1">
                                                <button><i class="bx bx-plus"></i></button>
                                            </div> --}}
                                        <div class="person-overview">
                                            @if ($cartItems[$item->id]['price_type'] == 'per_person')
                                                <div class="single">{{ $cartItems[$item->id]['no_of_adults'] }}
                                                    Adult{{ $cartItems[$item->id]['no_of_adults'] > 1 ? 's' : '' }}
                                                </div>
                                                <div class="single">{{ $cartItems[$item->id]['no_of_childs'] }}
                                                    Child{{ $cartItems[$item->id]['no_of_childs'] > 1 ? 's' : '' }}
                                                </div>
                                            @elseif ($cartItems[$item->id]['price_type'] == 'per_car')
                                                <div class="single">{{ $cartItems[$item->id]['no_of_cars'] }}
                                                    Car{{ $cartItems[$item->id]['no_of_cars'] > 1 ? 's' : '' }}</div>
                                            @endif
                                        </div>
                                        <div class="checkout__order-card-EDP">
                                            <div class="checkout__order-card-ED">
                                                <a href="{{ route('cart.index') }}" class="checkout-card__btn">
                                                    <i class='bx bxs-edit-alt'></i>
                                                </a>
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="index" value="{{ $item->id }}">
                                                    <button class="checkout-card__btn">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="checkout__order-cardPrice">
                                                @if ($item->price_type == 'per_person')
                                                    <div class="price-type">
                                                        <span>
                                                            {{ $item->for_adult_price }}
                                                        </span>
                                                        <span>
                                                            adult
                                                        </span>
                                                    </div>
                                                    <div class="price-type">
                                                        <span>
                                                            {{ $item->for_child_price }}
                                                        </span>
                                                        <span>
                                                            child
                                                        </span>
                                                    </div>
                                                @elseif($item->price_type == 'per_car')
                                                    <div class="price-type">
                                                        <span>
                                                            {{ $item->for_car_price }}
                                                        </span>
                                                        <span>
                                                            car
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>



    {{-- <div class="checkout-addMoreCards">
                            <div class="checkout-heading">
                                <h4>May you Like to Add</h4>
                            </div>

                            <div class="checkout__order-card">
                                <div class="checkout__order-card__content">
                                    <div class="checkout__order-card__img">
                                        <img src="{{ asset('assets/images/dubai-palm-helicopter-tour-600.webp') }}"
                                            alt='image' class='imgFluid' loading='lazy'>
                                    </div>
                                    <div class="checkout__order-card__deatils">
                                        <div class="checkout__order-card__heading">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, quos excepturi
                                        </div>
                                        <div class="checkout__order-cardQuantity-btns">
                                            <button class="cardQuantity-btn"><i class="bx bx-minus"></i></button>
                                            <input type="text" value="1" class="cardQuantity-input">
                                            <button class="cardQuantity-btn"><i class="bx bx-plus"></i></button>
                                        </div>
                                        <div class="checkout__order-card-EDP">
                                            <div class="checkout__order-card-ED">
                                                <div class="checkout-card__editIcon">
                                                    <i class='bx bxs-edit-alt'></i>
                                                </div>
                                                <div class="checkout-card__deleteIcon">
                                                    <i class='bx bx-trash'></i>
                                                </div>
                                            </div>
                                            <div class="checkout__order-cardAddcart">
                                                <button class="themeBtn-round">
                                                    Add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__order-card">
                                <div class="checkout__order-card__content">
                                    <div class="checkout__order-card__img">
                                        <img src="{{ asset('assets/images/dubai-palm-helicopter-tour-600.webp') }}"
                                            alt='image' class='imgFluid' loading='lazy'>
                                    </div>
                                    <div class="checkout__order-card__deatils">
                                        <div class="checkout__order-card__heading">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, quos excepturi
                                        </div>
                                        <div class="checkout__order-cardQuantity-btns">
                                            <button class="cardQuantity-btn"><i class="bx bx-minus"></i></button>
                                            <input type="text" value="1" class="cardQuantity-input">
                                            <button class="cardQuantity-btn"><i class="bx bx-plus"></i></button>
                                        </div>
                                        <div class="checkout__order-card-EDP">
                                            <div class="checkout__order-card-ED">
                                                <div class="checkout-card__editIcon">
                                                    <i class='bx bxs-edit-alt'></i>
                                                </div>
                                                <div class="checkout-card__deleteIcon">
                                                    <i class='bx bx-trash'></i>
                                                </div>
                                            </div>
                                            <div class="checkout__order-cardTocart">
                                                <button class="themeBtn-round">
                                                    Add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

    {{-- <div class="checkout__paymentMethod">
                            <h4>Payment Method</h4>
                            <ul class="checkout__paymentMethodRadios">
                                <li>
                                    <input type="radio" name="payment" id="stripe">
                                    <label for="stripe">Stripe <img src="{{ asset('assets/images/Stripe.webp') }}"
                                            alt=""></label>
                                </li>
                                <li>
                                    <input type="radio" name="payment" id="paypal">
                                    <label for="paypal">Paypal <img src="{{ asset('assets/images/paypal.webp') }}"
                                            alt=""></label>
                                </li>

                            </ul>
                            <button type="submit" class="app-btn themeBtn">Place Your Order</button>
                        </div> --}}
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', () => {
            let totalAmount = document.getElementById("totalAmount").dataset.total
            let subTotalAmount = document.getElementById("subTotalAmount").dataset.subTotal
            document.getElementById("subTotal").setAttribute('value', totalAmount)
            document.getElementById("total").setAttribute('value', subTotalAmount)
        })
    </script>
@endsection
