@extends('layouts.main')
@section('content')
    <!-- Cart -->
    <div class="cart my-5 pb-5 pt-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 cartBottom">
                    @if (!$items->isEmpty())
                        @foreach ($items as $item)
                            @php
                                $cart = $cartItems[$item->id];
                            @endphp
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="cart__product">
                                        <a href="{{ route('tours.details', $item->slug) }}" class="cart__productImg">
                                            <img src="{{ asset($item->img_path ?? 'assets/images/placeholder.png') }}"
                                                alt="{{ $item->title }}" loading="lazy">
                                        </a>
                                        <div class="cart__productContent">
                                            <div>
                                                <div class="cart__productDescription">
                                                    <h4>{{ $item->title }}</h4>
                                                    <p>
                                                        {{ $item->short_desc }}
                                                    </p>
                                                    @if ($item->price_type == 'per_person')
                                                        <div class="cart__productPrice">{{ $item->for_adult_price }}
                                                            <span>per
                                                                adult</span>
                                                        </div>
                                                        <div class="cart__productPrice">{{ $item->for_child_price }}
                                                            <span>per
                                                                adult</span>
                                                        </div>
                                                    @elseif($item->price_type == 'per_car')
                                                        <div class="cart__productPrice">{{ $item->for_car_price }} <span>per
                                                                car</span></div>
                                                    @endif


                                                    <div class="cart__productOptions">
                                                        <form action="{{ route('cart.remove') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="index"
                                                                value="{{ $item->id }}">
                                                            <button class="themeBtn-round active">
                                                                <i class='bx bx-trash'></i> Remove from Cart
                                                            </button>
                                                        </form>
                                                        <button class="themeBtn-round">
                                                            <i class='bx bx-heart'></i> Move to Wishlist
                                                        </button>
                                                    </div>
                                                </div>
                                                <form action="{{ route('cart.updateQuantity') }}" method="POST">

                                                    <h6 class="total">Total:
                                                        <span>{{ env('APP_CURRENCY') . $cart['total'] }}</span>
                                                    </h6>
                                                    @csrf
                                                    <input type="hidden" name="index" value="{{ $item->id }}">
                                                    @if ($item->price_type == 'per_person')
                                                        <div class="cart__productQuantity-main">
                                                            <div class="cart__productQuantity mt-4 mb-4">
                                                                <div class="cart__product-title">
                                                                    Adults:
                                                                </div>
                                                                <div class="quantity-counter">
                                                                    <button
                                                                        class="quantity-counter__btn quantity-counter__btn--minus"
                                                                        type="button">
                                                                        <i class='bx bx-chevron-down'></i>
                                                                    </button>
                                                                    <input type="number"
                                                                        value="{{ $cart['no_of_adults'] }}"
                                                                        class="quantity-counter__btn quantity-counter__btn--quantity"
                                                                        min="0" name="no_of_adults" required>

                                                                    <button
                                                                        class="quantity-counter__btn quantity-counter__btn--plus"
                                                                        type="button">
                                                                        <i class='bx bx-chevron-up'></i>
                                                                    </button>
                                                                </div>

                                                            </div>

                                                            <div class="cart__productQuantity">
                                                                <div class="cart__product-title">
                                                                    Childs:
                                                                </div>
                                                                <div class="quantity-counter">
                                                                    <button
                                                                        class="quantity-counter__btn quantity-counter__btn--minus"
                                                                        type="button">
                                                                        <i class='bx bx-chevron-down'></i>
                                                                    </button>
                                                                    <input type="number"
                                                                        value="{{ $cart['no_of_childs'] }}"
                                                                        class="quantity-counter__btn quantity-counter__btn--quantity"
                                                                        min="0" name="no_of_childs" required>

                                                                    <button
                                                                        class="quantity-counter__btn quantity-counter__btn--plus"
                                                                        type="button">
                                                                        <i class='bx bx-chevron-up'></i>
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @elseif($item->price_type == 'per_car')
                                                        <div class="cart__productQuantity-main">
                                                            <div class="cart__productQuantity">
                                                                <div class="cart__product-title">
                                                                    Cars:
                                                                </div>

                                                                <div class="quantity-counter">
                                                                    <button
                                                                        class="quantity-counter__btn quantity-counter__btn--minus"
                                                                        type="button">
                                                                        <i class='bx bx-chevron-down'></i>
                                                                    </button>
                                                                    <input type="number" value="{{ $cart['no_of_cars'] }}"
                                                                        class="quantity-counter__btn quantity-counter__btn--quantity"
                                                                        min="0" name="no_of_cars" required>

                                                                    <button
                                                                        class="quantity-counter__btn quantity-counter__btn--plus"
                                                                        type="button">
                                                                        <i class='bx bx-chevron-up'></i>
                                                                    </button>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    @endif
                                                    <button class="badge rounded-pill bg-success">Update</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="section-content d-flex align-items-center justify-content-between mb-4">
                            <div class="heading">Total: </div>
                            <div class="heading">{{ env('APP_CURRENCY') . $cartTotal }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('tours.listing') }}" style="width: fit-content" class="app-btn themeBtn">Keep
                            Browsing</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('checkout.index') }}" class="app-btn themeBtn pull-right">Proceed to Checkout</a>
                    </div>
                </div>
            @else
                <div class="text-document text-center section-content my-5">
                    <div class="container">
                        <h3 class="subHeading">Oops! Your cart is empty.</h3>
                        <p class="mt-3">It looks like you haven’t added any items to your cart yet. Start browsing
                            our tours and add your favorites to your cart!</p>
                        <a href="{{ route('tours.listing') }}" class="app-btn themeBtn themeBtn--center mt-3">Browse
                            Tours</a>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">
        .quantity-counter {
            justify-content: flex-start;
        }

        .badge {
            border: none;
            outline: none;
            display: block;
            width: fit-content;
            margin: 1rem auto;
        }
    </style>
@endsection
@section('js')
    @if (!Auth::check())
        <script>
            window.addEventListener("DOMContentLoaded", () => {
                document.getElementById("loginPopup").classList.add("open")
            })
        </script>
    @endif
@endsection
