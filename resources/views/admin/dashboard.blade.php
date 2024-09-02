@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-9">
        <div class="dashboard-content">
            <div class="revenue">
                <div class="section-content">
                    <h3 class="heading">Overview</h3>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="revenue-card">
                            <div class="revenue-card__icon"><i class='bx bxs-group'></i></div>
                            <div class="revenue-card__content">
                                <div class="title">Verified Users</div>
                                <div class="num">{{ count($users) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="revenue-card">
                            <div class="revenue-card__icon"><i class='bx bxs-plane'></i></div>
                            <div class="revenue-card__content">
                                <div class="title">Active Tours</div>
                                <div class="num">{{ count($tours) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="revenue-card">
                            <div class="revenue-card__icon"><i class='bx bx-dollar'></i></div>
                            <div class="revenue-card__content">
                                <div class="title">Total Income</div>
                                <div class="num">{{ env('APP_CURRENCY') }}100000</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="custom-sec">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">travel packages</h3>
                    </div>
                    <div class="custom-filters">
                        <div class="view-all">Sort by:</div>
                        <select name="sort_by" class="button-dropdown">
                            <option value="Latest">Latest</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="custom-card">
                            <a href="#" class="custom-card__img">
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <div class="participant">4,9</div>
                                </div>
                                <img src="assets/images/quad.jpg" alt="" class="imgFluid">
                            </a>
                            <div class="custom-card__content">
                                <div class="title">Bali, Indonesia</div>
                                <div class="duration">10 Days, 9 Nights</div>

                                <div class="card-bottom">
                                    <div class="price">$1,800</div>
                                    <a href="#" class="themeBtn">View </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <a href="#" class="custom-card__img">

                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <div class="participant">4,9</div>
                                </div>
                                <img src="assets/images/quad.jpg" alt="" class="imgFluid">
                            </a>
                            <div class="custom-card__content">
                                <div class="title">Bali, Indonesia</div>
                                <div class="duration">10 Days, 9 Nights</div>

                                <div class="card-bottom">
                                    <div class="price">$1,800</div>
                                    <a href="#" class="themeBtn">View </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-card">
                            <a href="#" class="custom-card__img">

                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <div class="participant">4,9</div>
                                </div>
                                <img src="assets/images/quad.jpg" alt="" class="imgFluid">
                            </a>
                            <div class="custom-card__content">
                                <div class="title">Bali, Indonesia</div>
                                <div class="duration">10 Days, 9 Nights</div>

                                <div class="card-bottom">
                                    <div class="price">$1,800</div>
                                    <a href="#" class="themeBtn">View </a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="custom-sec">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">Recent Bookings</h3>
                    </div>
                    <a href="#" class="custom-link">View All</a>
                </div>
                <div class="table-container table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Destination</th>
                                <th>Date & Duration</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Elena Rodriguez</td>
                                <td>Santorini, Greece</td>
                                <td>15 - 22 Apr 2024</td>
                                <td>$2,500</td>
                                <td>
                                    <span class="badge rounded-pill bg-warning">Pending</span>
                                </td>
                                <td>
                                    <div class="dropstart">
                                        <button type="button" class="recent-act__icon dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <lord-icon src="https://cdn.lordicon.com/jpgpblwn.json" trigger="hover">
                                            </lord-icon>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/system/solid/92-visability.json"
                                                        trigger="loop" delay="2000">
                                                    </lord-icon>
                                                    View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">


                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/wired/outline/2465-restriction.json"
                                                        trigger="loop" delay="2000"
                                                        colors="primary:#000,secondary:#000">
                                                    </lord-icon>


                                                    Suspend
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    onclick="return confirm('Are you sure you want to delete')"
                                                    href="javascript:void(0)">

                                                    <lord-icon src="https://cdn.lordicon.com/skkahier.json" trigger="loop"
                                                        delay="2000">
                                                    </lord-icon>

                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Elena Rodriguez</td>
                                <td>Santorini, Greece</td>
                                <td>15 - 22 Apr 2024</td>
                                <td>$2,500</td>
                                <td>
                                    <span class="badge rounded-pill bg-danger">Cancelled</span>
                                </td>
                                <td>
                                    <div class="dropstart">
                                        <button type="button" class="recent-act__icon dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <lord-icon src="https://cdn.lordicon.com/jpgpblwn.json" trigger="hover">
                                            </lord-icon>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/system/solid/92-visability.json"
                                                        trigger="loop" delay="2000">
                                                    </lord-icon>
                                                    View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">


                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/wired/outline/2465-restriction.json"
                                                        trigger="loop" delay="2000"
                                                        colors="primary:#000,secondary:#000">
                                                    </lord-icon>


                                                    Suspend
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    onclick="return confirm('Are you sure you want to delete')"
                                                    href="javascript:void(0)">

                                                    <lord-icon src="https://cdn.lordicon.com/skkahier.json" trigger="loop"
                                                        delay="2000">
                                                    </lord-icon>

                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Elena Rodriguez</td>
                                <td>Santorini, Greece</td>
                                <td>15 - 22 Apr 2024</td>
                                <td>$2,500</td>
                                <td>
                                    <span class="badge rounded-pill bg-success">Completed</span>
                                </td>
                                <td>
                                    <div class="dropstart">
                                        <button type="button" class="recent-act__icon dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <lord-icon src="https://cdn.lordicon.com/jpgpblwn.json" trigger="hover">
                                            </lord-icon>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/system/solid/92-visability.json"
                                                        trigger="loop" delay="2000">
                                                    </lord-icon>
                                                    View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">


                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/wired/outline/2465-restriction.json"
                                                        trigger="loop" delay="2000"
                                                        colors="primary:#000,secondary:#000">
                                                    </lord-icon>


                                                    Suspend
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    onclick="return confirm('Are you sure you want to delete')"
                                                    href="javascript:void(0)">

                                                    <lord-icon src="https://cdn.lordicon.com/skkahier.json" trigger="loop"
                                                        delay="2000">
                                                    </lord-icon>

                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Elena Rodriguez</td>
                                <td>Santorini, Greece</td>
                                <td>15 - 22 Apr 2024</td>
                                <td>$2,500</td>
                                <td>
                                    <span class="badge rounded-pill bg-warning">Pending</span>
                                </td>
                                <td>
                                    <div class="dropstart">
                                        <button type="button" class="recent-act__icon dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <lord-icon src="https://cdn.lordicon.com/jpgpblwn.json" trigger="hover">
                                            </lord-icon>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/system/solid/92-visability.json"
                                                        trigger="loop" delay="2000">
                                                    </lord-icon>
                                                    View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">


                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/wired/outline/2465-restriction.json"
                                                        trigger="loop" delay="2000"
                                                        colors="primary:#000,secondary:#000">
                                                    </lord-icon>


                                                    Suspend
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    onclick="return confirm('Are you sure you want to delete')"
                                                    href="javascript:void(0)">

                                                    <lord-icon src="https://cdn.lordicon.com/skkahier.json" trigger="loop"
                                                        delay="2000">
                                                    </lord-icon>

                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Elena Rodriguez</td>
                                <td>Santorini, Greece</td>
                                <td>15 - 22 Apr 2024</td>
                                <td>$2,500</td>
                                <td>
                                    <span class="badge rounded-pill bg-success">Completed</span>
                                </td>
                                <td>
                                    <div class="dropstart">
                                        <button type="button" class="recent-act__icon dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <lord-icon src="https://cdn.lordicon.com/jpgpblwn.json" trigger="hover">
                                            </lord-icon>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/system/solid/92-visability.json"
                                                        trigger="loop" delay="2000">
                                                    </lord-icon>
                                                    View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">


                                                    <lord-icon
                                                        src="https://media.lordicon.com/icons/wired/outline/2465-restriction.json"
                                                        trigger="loop" delay="2000"
                                                        colors="primary:#000,secondary:#000">
                                                    </lord-icon>


                                                    Suspend
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    onclick="return confirm('Are you sure you want to delete')"
                                                    href="javascript:void(0)">

                                                    <lord-icon src="https://cdn.lordicon.com/skkahier.json" trigger="loop"
                                                        delay="2000">
                                                    </lord-icon>

                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="recent-act">
            <div class="recent-act__header">
                <div class="title">Recent Activity</div>
            </div>
            <ul class="activity-log">
                <li class="activity-log__item">
                    <a href="#">
                        <span class="icon"><i class='bx bx-time'></i></span>
                        <div class="info">Bill Trevor (admin) updated the "Kyoto, Japan" travel package</div>
                    </a>
                </li>
                <li class="activity-log__item">
                    <a href="#">
                        <span class="icon"><i class='bx bx-time'></i></span>
                        <div class="info">Bill Trevor (admin) updated the "Kyoto, Japan" travel package</div>
                    </a>
                </li>
                <li class="activity-log__item">
                    <a href="#">
                        <span class="icon"><i class='bx bx-time'></i></span>
                        <div class="info">Bill Trevor (admin) updated the "Kyoto, Japan" travel package</div>
                    </a>
                </li>
                <li class="activity-log__item">
                    <a href="#">
                        <span class="icon"><i class='bx bx-time'></i></span>
                        <div class="info">Bill Trevor (admin) updated the "Kyoto, Japan" travel package</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">

    </style>
@endsection
@section('js')
    <script type="text/javascript"></script>
@endsection
