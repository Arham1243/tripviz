@extends('layouts.main')
@section('content')
    <div class="location-banner1">
        <div class="container-Fluid">
            <div class="location-banner1__img">
                <img src="{{ asset($country->img_path ?? 'assets/images/placeholder.png') }}" alt='{{ $country->name }}'
                    class='imgFluid' loading='lazy'>
            </div>
        </div>
    </div>

    <div class="location1-content__section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="location1-content__section--details">
                        <div class="location1-content__section--heading">
                            <h2>
                                {{ $country->name }}
                            </h2>
                            {{-- {{ route('country.details', $country->continent->slug) }} --}}
                            <ul class="location1-Breadcrumb">
                                <li><a
                                        href="javascript:void(0)">{{ $country->continent ? $country->continent->name . ',' : '' }}</a>
                                </li>
                                <li><a href="javascript:void(0)">{{ $country->name }}</a></li>
                            </ul>

                        </div>
                        <p class="location1-content__section--pra">
                            {{ $country->short_desc }}
                        </p>
                        <a class="location1-content__section--btn">
                            <button class="app-btn">
                                Best Things to Do
                                <i class='bx bx-right-arrow-alt'></i>
                            </button>

                        </a>

                    </div>


                </div>
                <div class="col-md-5">
                    <div class="loaction-guide">
                        <div class="loaction-guide-content">
                            <div class="loaction-guide-heading">
                                Guide
                            </div>
                            <div class="loaction-guide-title">
                                Plan your trip with Guide, an AI travel planner!

                            </div>
                            <div class="loaction-guide-pra">
                                Create a personalized trip itinerary in seconds using artificial intelligence.
                            </div>
                            <div class="loaction-guide-btn">
                                <a href="">
                                    <button class="themeBtn-round">Create a trip</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

   


    @if (!$tours->isEmpty())
        <div class="Book-popular-activities">
            <div class="container">
                <div class="latest-stories__title text-center">Discover Popular Activities</div>
                <div class="section-content text-center">
                    <h2 class="subHeading">
                        Book popular activities in {{ $country->name }}
                    </h2>
                </div>

                <div class="row">
                    @foreach ($tours as $tour)
                        <div class="col-md-4">
                            <div class="Book-popular-activities__card">
                                <a href="{{ route('tours.details', $tour->slug) }}" class="Book-popular-activities__img">
                                    <img src="{{ asset($tour->img_path ?? 'assets/images/placeholder.png') }}"
                                        alt='{{ $tour->title }}' class='imgFluid' loading='lazy'>
                                </a>
                                <div class="activities__card__content">
                                    <a href="{{ route('tours.details', $tour->slug) }}"
                                        class="activities__card__content__title">
                                        {{ $tour->title }}
                                    </a>
                                </div>
                                @if (!$tour->tour_attributes->isEmpty())
                                    <div class="activities__card__duration">
                                        <div class="activities__card__duration-icon">
                                            <i class='{{ $tour->tour_attributes[0]->icon_class }}'></i>
                                        </div>
                                        <span>
                                            {{ $tour->tour_attributes[0]->title }}
                                        </span>
                                    </div>
                                @endif
                                <div class="card-rating">
                                    <x-star-rating :rating="$tour->average_rating" />
                                    <span class="average-rating">
                                        {{ $tour->average_rating }}
                                    </span>
                                    <span class="total">
                                        @if ($tour->reviews->count() > 0)
                                            ({{ $tour->reviews->count() }}
                                            Review{{ $tour->reviews->count() > 1 ? 's' : '' }})
                                        @else
                                            (No Reviews Yet)
                                        @endif
                                    </span>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif



    @if (!$country->cities->isEmpty())
        <div class="location1-beyond">
            <div class="container">
                <div class="latest-stories__title">03 / GO BEYOND</div>
                <div class="latest-stories__details">
                    <div class="section-content">
                        <h2 class="subHeading">
                            {{ $country->name }} and beyond
                        </h2>
                    </div>
                    {{-- <div class="latest-stories__btns">
                    <button class="themeBtn-round">Read more articles</button>
                </div> --}}
                </div>

                <div class="row pt-5">
                    @foreach ($country->cities as $city)
                        <div class="col-md-3">
                            <div class="blog-more__dest-content">
                                <div class="location1-beyond__img">
                                    <a href="{{ route('city.details', $city->slug) }}">
                                        <img src="{{ asset($city->img_path ?? 'assets/images/placeholder.png') }}"
                                            alt='{{ $city->name }}' class="imgFluid" loading="lazy">
                                    </a>
                                </div>
                                <div class="blog-more__dest-title">
                                    {{ $city->name }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        /*in page js here*/
    </script>
@endsection
