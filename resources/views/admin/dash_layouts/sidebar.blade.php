<div class="side-bar" id="sideBar">
    <a href="javascript:void(0)" class="sideBar__close" onclick="closeSideBar()">×</a>
    <div class="side-bar-logo bg-logo-wrapper">

        <a href="{{ route('admin.dashboard') }}"><img
                src="{{ asset($logo->img_path ?? 'admin/assets/images/placeholder-logo.png') }}" alt="logo"
                class="img-fluid"></a>

    </div>
    <div class="side-bar-links">
        <ul class="navigation-list">

            <li><a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-home" aria-hidden="true"></i> Dashboard
                </a>
            </li>
            <li><a href="{{ route('admin.usersListing') }}">
                    <i class="fa fa-users" aria-hidden="true"></i> Users Management
                </a>
            </li>



            <li
                class="custom-dropdown {{ in_array(Request::url(), [
                    route('admin.continents.index'),
                    route('admin.countries.index'),
                    route('admin.cities.index'),
                ])
                    ? 'open'
                    : '' }}">
                <a href="javascript:void(0)" class="custom-dropdown__active">
                    <i class="fa fa-location-dot" aria-hidden="true"></i> Locations Management
                </a>
                <div class="custom-dropdown__values">
                    <ul class="values-wrapper">
                        <li><a class="{{ Request::url() == route('admin.continents.index') ? 'active' : '' }}"
                                href="{{ route('admin.continents.index') }}">Continents</a></li>
                        <li><a class="{{ Request::url() == route('admin.countries.index') ? 'active' : '' }}"
                                href="{{ route('admin.countries.index') }}">Countries</a></li>
                        <li><a class="{{ Request::url() == route('admin.cities.index') ? 'active' : '' }}"
                                href="{{ route('admin.cities.index') }}">Cities</a></li>
                    </ul>
                </div>
            </li>

            <li
                class="custom-dropdown {{ in_array(Request::url(), [
                    route('admin.categories.index'),
                    route('admin.tours.index'),
                    route('admin.tours-additionals.index'),
                    route('admin.tour-reviews.index'),
                ])
                    ? 'open'
                    : '' }}">
                <a href="javascript:void(0)" class="custom-dropdown__active">
                    <i class="fa fa fa-plane" aria-hidden="true"></i> Tours Management
                </a>
                <div class="custom-dropdown__values">
                    <ul class="values-wrapper">
                        <li><a class="{{ Request::url() == route('admin.tours.index') ? 'active' : '' }}"
                                href="{{ route('admin.tours.index') }}">Tours</a></li>
                        <li><a class="{{ Request::url() == route('admin.categories.index') ? 'active' : '' }}"
                                href="{{ route('admin.categories.index') }}">Categories</a></li>
                        <li><a class="{{ Request::url() == route('admin.tours-additionals.index') ? 'active' : '' }}"
                                href="{{ route('admin.tours-additionals.index') }}">Tours Additionals</a></li>
                        <li><a class="{{ Request::url() == route('admin.tour-reviews.index') ? 'active' : '' }}"
                                href="{{ route('admin.tour-reviews.index') }}">Tours Reviews</a></li>
                    </ul>
                </div>
            </li>

            <li><a href="{{ route('admin.promotions.index') }}">
                    <i class="bx bxs-megaphone" aria-hidden="true"></i> Latest travel promotions
                </a>
            </li>
            <li><a href="{{ route('admin.newsletters') }}">
                    <i class="fa fa-envelope" aria-hidden="true"></i> Newsletter
                </a>
            </li>


            <li
                class="custom-dropdown {{ in_array(Request::url(), [route('admin.showLogo'), route('admin.socialInfo')]) ? 'open' : '' }}">
                <a href="javascript:void(0)" class="custom-dropdown__active">
                    <i class="fa fa-location-dot" aria-hidden="true"></i> Site Settings
                </a>
                <div class="custom-dropdown__values">
                    <ul class="values-wrapper">
                        <li><a class="{{ Request::url() == route('admin.showLogo') ? 'active' : '' }}"
                                href="{{ route('admin.showLogo') }}">Logo Management</a></li>
                        <li><a class="{{ Request::url() == route('admin.socialInfo') ? 'active' : '' }}"
                                href="{{ route('admin.socialInfo') }}">Contact/social Info</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
