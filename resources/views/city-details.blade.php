@extends('layouts.main')
@section('content')
    <div class="location-banner1">
        <div class="container-Fluid">
            <div class="location-banner1__img">
                <img src="{{ asset($city->img_path ?? 'assets/images/placeholder.png') }}" alt='{{ $city->name }}'
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
                                {{ $city->name }}
                            </h2>
                            <ul class="location1-Breadcrumb">
                                <li><a
                                        href="{{ route('country.details', $city->country->slug) }}">{{ $city->country ? $city->country->name . ',' : '' }}</a>
                                </li>
                                <li><a href="javascript:void(0)">{{ $city->name }}</a></li>
                            </ul>

                        </div>
                        <p class="location1-content__section--pra">
                            {{ $city->short_desc }}
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
        <div class="top-picks-experts">
            <div class="container">
                <div class="top-picks-experts__heading">
                    <div class="section-content">
                        <h2 class="subHeading">
                            Top picks from our travel experts
                        </h2>
                    </div>
                    <div class="top-picks-experts__Smheading section-content">
                        <a class="heading">
                            {{ $tours->count() }} best things to do in {{ $city->name }}
                        </a>
                    </div>
                </div>
                <div class="row pt-3">
                    @foreach ($tours as $tour)
                        <div class="col-md-3">
                            <div class="card-content">
                                <a href="{{ route('tours.details', $tour->slug) }}" class="card_img">
                                    <img data-src="{{ asset($tour->img_path ?? 'assets/images/placeholder.png') }}"
                                        alt="{{ $tour->title }}" class="imgFluid lazy" loading="lazy">
                                    <div class="price-details">
                                        <div class="heart-icon">
                                            <div class="service-wishlis">
                                                <i class="bx bx-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="tour-activity-card__details">
                                    <div class="vertical-activity-card__header">
                                        @if ($tour->price_type == 'per_person')
                                            <div><span> From <strong>{{ $tour->for_adult_price }} </strong> per
                                                    person</span></div>
                                        @elseif($tour->price_type == 'per_car')
                                            <div><span> From {{ $tour->for_car_price }} per car</span></div>
                                        @endif
                                        <div class="tour-activity-card__details--title">
                                            {{ $tour->title }}
                                        </div>
                                    </div>

                                    <div class="tour-activity__RL">
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
    @endif




    @if (!$stories->isEmpty())
        <div class=latest-stories>
            <div class=container>
                <div class=latest-stories__title>TRAVEL STORIES AND NEWS</div>
                <div class=latest-stories__details>
                    <div class=section-content>
                        <h2 class=subHeading>
                            Latest stories from {{ $city->name }}
                        </h2>
                    </div>

                </div>
                <div class="row pt-3">
                    @if ($stories->count() > 0)
                        @php
                            // Get the first story for the main section
                            $mainStory = $stories->shift();
                        @endphp

                        <div class="col-md-7">
                            <div class="Desti-Pract__details">
                                <div class="Desti-Pract__img">
                                    <img data-src="{{ asset($mainStory->img_path ?? 'assets/images/placeholder.png') }}"
                                        alt="{{ $mainStory->title }}" class="imgFluid lazy" loading="lazy">
                                </div>
                                <div class="Desti-Pract__content">
                                    <div class="sub-title">{{ $mainStory->city->name ?? '' }}</div>
                                    <a href="{{ route('stories.details', $mainStory->slug) }}"
                                        class="Desti-Pract__title">{{ $mainStory->title }}</a>
                                    <div class="date">{{ $mainStory->created_at->format('M d, Y') }} •
                                        {{ $mainStory->estimated_read_time }} min read</div>
                                    <p>{{ $mainStory->short_desc }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            @if ($stories->count() > 0)
                                @foreach ($stories as $story)
                                    <div class="Desti-Pract__activities">
                                        <div class="activities-details">
                                            <a href="{{ route('stories.details', $story->slug) }}" class="activities-img">
                                                <img data-src="{{ asset($story->img_path ?? 'assets/images/placeholder.png') }}"
                                                    alt="{{ $story->title }}" class="imgFluid lazy" loading="lazy">
                                            </a>
                                            <div class="activities-content">
                                                <p><b>{{ $story->city->name ?? '' }}</b></p>
                                                <a
                                                    href="{{ route('stories.details', $story->slug) }}">{{ $story->title }}</a>
                                                <p>{{ $story->created_at->format('M d, Y') }} •
                                                    {{ $story->estimated_read_time }} min read</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">No additional stories added yet.</p>
                            @endif
                        </div>
                    @else
                        <div class="col-12">
                            <p class="text-center">No stories found.</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    @endif

    @if (!$tours->isEmpty())
        <div class="Book-popular-activities">
            <div class="container">
                <div class="latest-stories__title text-center">Discover Popular Activities</div>
                <div class="section-content text-center">
                    <h2 class="subHeading">
                        Book popular activities in {{ $city->name }}
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
                        </div>)
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    @if (!$relatedCities->isEmpty())
        <div class="location1-beyond">
            <div class="container">
                <div class="latest-stories__title">03 / GO BEYOND</div>
                <div class="latest-stories__details">
                    <div class="section-content">
                        <h2 class="subHeading">
                            {{ $city->name }} and beyond
                        </h2>
                    </div>
                    {{-- <div class="latest-stories__btns">
                <button class="themeBtn-round">Read more articles</button>
            </div> --}}
                </div>

                <div class="row pt-5">
                    @foreach ($relatedCities as $city)
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
