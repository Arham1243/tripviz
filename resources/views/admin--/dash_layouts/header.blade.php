<section class="dashboard-section">
    <header>
        <div class="container-fluid">
            <div class="header-links">



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
                </div>
                <div class="header-main__menu">
                    <a href="javascript:viod(0)" onclick="openSideBar()"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </div>
    </header>
