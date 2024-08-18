@extends('layouts.main')
@section('content')

<div class="location-banner1">
    <div class="container-Fluid">
        <div class="location-banner1__img">
            <img src="{{ asset("assets/images/Dubai-desert-sky.webp") }}" alt='image' class='imgFluid' loading='lazy'>
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
                            Dubai
                        </h2>
                        <ul class="location1-Breadcrumb">
                            <li><a href="#">United Arab Emirates,</a></li>
                            <li><a href="#">Middle East</a></li>
                        </ul>

                    </div>
                    <p class="location1-content__section--pra">Dubai is a stirring alchemy of profound traditions and ambitious futuristic vision wrapped into starkly evocative desert splendor.</p>
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
                25 best things to do in Dubai
                </a>
            </div>
            <div class="curated-by">
                Curated by
                <a href=""> Lonely Planet Editors</a>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-3">
                <div class="card-content">
                    <a href="#" class="card_img">
                        <img data-src="assets/images/8c (1).webp" alt="image" class="imgFluid lazy" loading="lazy" src="assets/images/8c (1).webp">
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
                            <div><span> From $159
                                </span></div>
                            <div class="tour-activity-card__details--title">
                                Karachi Sightseeing Private Tour: Explore the Captivating City of Lights
                            </div>
                        </div>
                        <div class="tour-activity__RL">
                            <div class="card-rating">
                                <i class="bx bxs-star yellow-star"></i>
                                <span>5.0 1 Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-content">
                    <a href="#" class="card_img">
                        <img data-src="{{ asset("assets/images/1b.webp") }}" alt="image" class="imgFluid lazy" loading="lazy" src="assets/images/1b.webp">
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
                            <div><span> From $159
                                </span></div>
                            <div class="tour-activity-card__details--title">
                                Karachi Sightseeing Private Tour: Explore the Captivating City of Lights
                            </div>
                        </div>
                        <div class="tour-activity__RL">
                            <div class="card-rating">
                                <i class="bx bxs-star yellow-star"></i>
                                <span>5.0 1 Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-content">
                    <a href="#" class="card_img">
                        <img data-src="{{ asset("assets/images/8c.webp") }}" alt="image" class="imgFluid lazy" loading="lazy" src="assets/images/8c.webp">
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
                            <div><span> From $159
                                </span></div>
                            <div class="tour-activity-card__details--title">
                                Karachi Sightseeing Private Tour: Explore the Captivating City of Lights
                            </div>
                        </div>
                        <div class="tour-activity__RL">
                            <div class="card-rating">
                                <i class="bx bxs-star yellow-star"></i>
                                <span>5.0 1 Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-content">
                    <a href="#" class="card_img">
                        <img data-src="{{ asset("assets/images/8c.webp") }}" alt="image" class="imgFluid lazy" loading="lazy" src="assets/images/8c.webp">
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
                            <div><span> From $159
                                </span></div>
                            <div class="tour-activity-card__details--title">
                                Karachi Sightseeing Private Tour: Explore the Captivating City of Lights
                            </div>
                        </div>
                        <div class="tour-activity__RL">
                            <div class="card-rating">
                                <i class="bx bxs-star yellow-star"></i>
                                <span>5.0 1 Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="latest-stories-loc-2">
    <div class="container">
        <div class="latest-stories__title">03 / ARTICLES</div>
        <div class="latest-stories__details">
            <div class="section-content">
                <h2 class="subHeading">
                Latest stories from Dubai
                </h2>
            </div>
            <div class="latest-stories__btns">
                <button class="themeBtn-round">Read more articles</button>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-7">
                <div class="Desti-Pract__details">
                    <div class="Desti-Pract__img">
                        <img data-src="{{ asset("assets/images/BEAR_GRYLLS_RAK720desat.webp") }}" alt="image" class="imgFluid lazy" loading="lazy" src="assets/images/BEAR_GRYLLS_RAK720desat.webp">
                    </div>
                    <div class="Desti-Pract__content">
                        <div class="sub-title">Destination Practicalities</div>
                        <h3 href="#" class="Desti-Pract__title">8 things to know before visiting Savannah</h3>
                        <div class="date">Jun 21, 2024 • 6 min read</div>
                        <p>With its grand leafy streets and beautiful architecture, Savannah is an incredible city to visit. Here's everything you need to know before you go.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="Desti-Pract__activities">
                    <div class="activities-details">
                        <div class="activities-img">
                            <img data-src="{{ asset("assets/images/GettyImages-1392454769.webp") }}" alt="image" class="imgFluid lazy" loading="lazy" src="assets/images/GettyImages-1392454769.webp">
                        </div>
                        <div class="activities-content">
                            <p><b>Hiking</b></p>
                            <a href="#">9 best places to visit in Georgia </a>
                            <p>Jun 21, 2024 • 7 min read</p>
                        </div>
                    </div>
                </div>
                <div class="Desti-Pract__activities">
                    <div class="activities-details">
                        <div class="activities-img">
                            <img data-src="{{ asset("assets/images/GettyImages-1392454769.webp") }}" alt="image" class="imgFluid lazy" loading="lazy" src="assets/images/GettyImages-1392454769.webp">
                        </div>
                        <div class="activities-content">
                            <p><b>Hiking</b></p>
                            <a href="#">9 best places to visit in Georgia </a>
                            <p>Jun 21, 2024 • 7 min read</p>
                        </div>
                    </div>
                </div>
                <div class="Desti-Pract__activities">
                    <div class="activities-details">
                        <div class="activities-img">
                            <img data-src="{{ asset("assets/images/GettyImages-1392454769.webp") }}" alt="image" class="imgFluid lazy" loading="lazy" src="assets/images/GettyImages-1392454769.webp">
                        </div>
                        <div class="activities-content">
                            <p><b>Hiking</b></p>
                            <a href="#">9 best places to visit in Georgia </a>
                            <p>Jun 21, 2024 • 7 min read</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="Book-popular-activities">
    <div class="container">
        <div class="latest-stories__title text-center">Lorem ipsum dolor sit.</div>
        <div class="section-content text-center">
            <h2 class="subHeading">
            Book popular activities in Dubai
            </h2>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="Book-popular-activities__card">
                    <div class="Book-popular-activities__img">
                        <img src="{{ asset("assets/images/132.webp") }}" alt='image' class='imgFluid' loading='lazy'>
                    </div>
                    <div class="activities__card__content">
                        <a href="javascript:void(0)" class="activities__card__content__title">
                            Jeep Desert Safari, Camel Ride, and Quad Bike Tour
                        </a>
                    </div>
                    <div class="activities__card__duration">
                        <div class="activities__card__duration-icon">
                            <i class='bx bx-timer'></i>
                        </div>
                        <span>Duration: 4 hours</span>
                    </div>
                    <div class="card-rating">
                        <i class="bx bxs-star yellow-star"></i>
                        <span>5(200)</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="Book-popular-activities__card">
                    <div class="Book-popular-activities__img">
                        <img src='assets/images/132 (2).webp' alt='image' class='imgFluid' loading='lazy'>
                    </div>
                    <div class="activities__card__content">
                        <a href="javascript:void(0)" class="activities__card__content__title">
                            Jeep Desert Safari, Camel Ride, and Quad Bike Tour
                        </a>
                    </div>
                    <div class="activities__card__duration">
                        <div class="activities__card__duration-icon">
                            <i class='bx bx-timer'></i>
                        </div>
                        <span>Duration: 4 hours</span>
                    </div>
                    <div class="card-rating">
                        <i class="bx bxs-star yellow-star"></i>
                        <span>5(200)</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="Book-popular-activities__card">
                    <div class="Book-popular-activities__img">
                        <img src='assets/images/132 (3).webp' alt='image' class='imgFluid' loading='lazy'>
                    </div>
                    <div class="activities__card__content">
                        <a href="javascript:void(0)" class="activities__card__content__title">
                            Jeep Desert Safari, Camel Ride, and Quad Bike Tour
                        </a>
                    </div>
                    <div class="activities__card__duration">
                        <div class="activities__card__duration-icon">
                            <i class='bx bx-timer'></i>
                        </div>
                        <span>Duration: 4 hours</span>
                    </div>
                    <div class="card-rating">
                        <i class="bx bxs-star yellow-star"></i>
                        <span>5(200)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="location1-beyond">
    <div class="container">
        <div class="latest-stories__title">04 / GO BEYOND</div>
        <div class="latest-stories__details">
            <div class="section-content">
                <h2 class="subHeading">
                Dubai and beyond
                </h2>
            </div>
            <div class="latest-stories__btns">
                <button class="themeBtn-round">Read more articles</button>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-3">
                <div class="blog-more__dest-content">
                    <div class="location1-beyond__img">
                        <a href="#">
                            <img src="{{ asset("assets/images/abudhabi-GettyImages-1281590453-rfc.webp") }}" alt="image" class="imgFluid" loading="lazy">
                        </a>
                    </div>
                    <div class="blog-more__dest-title">
                        Abu Dhabi
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="blog-more__dest-content">
                    <div class="location1-beyond__img">
                        <a href="#">
                            <img src="{{ asset("assets/images/abudhabi-GettyImages-1281590453-rfc.webp") }}" alt="image" class="imgFluid" loading="lazy">
                        </a>
                    </div>
                    <div class="blog-more__dest-title">
                        Sharjah
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="blog-more__dest-content">
                    <div class="location1-beyond__img">
                        <a href="#">
                            <img src="{{ asset("assets/images/abudhabi-GettyImages-1281590453-rfc.webp") }}" alt="image" class="imgFluid" loading="lazy">
                        </a>
                    </div>
                    <div class="blog-more__dest-title">
                        Ajman
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="blog-more__dest-content">
                    <div class="location1-beyond__img">
                        <a href="#">
                            <img src="{{ asset("assets/images/abudhabi-GettyImages-1281590453-rfc.webp") }}" alt="image" class="imgFluid" loading="lazy">
                        </a>
                    </div>
                    <div class="blog-more__dest-title">
                        Umm Al Quwain
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



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