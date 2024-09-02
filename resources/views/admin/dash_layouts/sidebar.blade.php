<div class="sidebar">
    <a href="#" class="sidebar-header">
        <div class="sidebar-header__icon">
            <img src="{{ asset($logo->img_path ?? 'admin/assets/images/placeholder-logo.png') }}" alt="Logo"
                class="imgFluid">
        </div>
    </a>
    <ul class="sidebar-nav">


        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="{{ Request::url() == route('admin.dashboard') ? 'active' : '' }}">
                <i class='bx bxs-dashboard'></i>
                dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.usersListing') }}"
                class="{{ Request::url() == route('admin.usersListing') ? 'active' : '' }}">
                <i class='bx bxs-group'></i>
                Users Management
            </a>
        </li>
        <li
            class="custom-dropdown {{ in_array(Request::url(), [route('admin.showLogo'), route('admin.socialInfo'), route('admin.sections.index')]) ? 'open' : '' }}">

            <a href="javascript:void(0)" class="custom-dropdown__active"">
                <i class='bx bxs-cog'></i>
                Site Settings
            </a>

            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li><a class="{{ Request::url() == route('admin.showLogo') ? 'active' : '' }}"
                            href="{{ route('admin.showLogo') }}">Logo Management</a></li>
                    {{-- <li><a class="{{ Request::url() == route('admin.sections.index') ? 'active' : '' }}"
                            href="{{ route('admin.sections.index') }}">Sections Management</a></li> --}}
        </li>
        <li><a class="{{ Request::url() == route('admin.socialInfo') ? 'active' : '' }}"
                href="{{ route('admin.socialInfo') }}">Contact/social Info</a></li>
    </ul>
</div>
</li>
<li><a href="{{ route('admin.logout') }}"><i class='bx bx-log-in'></i>Logout</a></li>

</ul>

</div>
