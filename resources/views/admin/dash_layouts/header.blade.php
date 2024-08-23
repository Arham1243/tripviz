<section class="dashboard-section">
    <header>
        <div class="container-fluid">
            <div class="header-links">



                {{-- <div class="dropdown show user-link">
                    <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <div class="user-info">
                            <h4 style="text-transform: capitalize">{{ Auth::guard('admin')->user()->name }}</h4>
                        </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                        <a onclick="return confirm('Do you really want to Logout?')" class="dropdown-item"
                            href="{{ route('admin.logout') }}">Logout</a>
                    </div>
                </div>
                <div class="dropdown show user-link">
                    <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <div class="user-info">
                            <h4 style="text-transform: capitalize">{{ Auth::guard('admin')->user()->name }}</h4>
                        </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                        <a onclick="return confirm('Do you really want to Logout?')" class="dropdown-item"
                            href="{{ route('admin.logout') }}">Logout</a>
                    </div>
                </div> --}}

                <ul class="header-actions">
                    <li>
                        <a href="javascript:void(0)" class="header-actions__item" id="notification-icon">
                            <i class='bx bxs-bell-ring' id="notification-icon-class"></i>
                            <span class="new"
                                id="notification-count">{{ $notifications ? auth()->guard('admin')->user()->unreadNotifications->count() : 0 }}</span>
                        </a>
                        <div class="notification-wrapper">
                            <ul class="notifications" id="notifications">
                                @if ($notifications)
                                    @foreach ($notifications as $notification)
                                        <li>
                                            <a href="{{ $notification->data['link'] }}" class="notification">
                                                <div class="content">
                                                    <div class="title">
                                                        {{ $notification->data['message'] }}
                                                    </div>
                                                    <div class="time"
                                                        data-timestamp="{{ $notification->created_at }}">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="message text-center">No notifications</li>
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>


                <div class="header-main__menu">
                    <a href="javascript:viod(0)" onclick="openSideBar()"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </div>
    </header>
