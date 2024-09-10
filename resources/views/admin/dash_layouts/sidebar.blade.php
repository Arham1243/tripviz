<div class="sidebar">
    <a href="#" class="sidebar-header">
        <div class="sidebar-header__icon">
            <img src="{{ asset($logo->img_path ?? 'admin/assets/images/placeholder-logo.png') }}" alt="Logo"
                class="imgFluid">
        </div>
    </a>
    <ul class="sidebar-nav">


        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class='bx bxs-home'></i>
                Dashboard
            </a>
        </li>

        <!-- Blog | News -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-news'></i>
                Blog | News
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li class="custom-dropdown custom-dropdown--sub">
                        <a href="javascript:void(0)" class="custom-dropdown__active">
                            <div class="start-icon"><i class='bx bxl-blogger'></i>Blog</div>
                            <div class="icon"><i class='bx bx-chevron-right'></i>
                            </div>
                        </a>
                        <div class="custom-dropdown__values">
                            <ul class="values-wrapper">
                                <li><a href="{{ route('admin.blogs.index') }}"><i class='bx bx-list-ul'></i> All
                                        Blog</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bx-plus'></i> Add Blog</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="custom-dropdown custom-dropdown--sub">
                        <a href="javascript:void(0)" class="custom-dropdown__active">
                            <div class="start-icon"><i class='bx bxs-news'></i>News</div>
                            <div class="icon"><i class='bx bx-chevron-right'></i></div>
                        </a>
                        <div class="custom-dropdown__values">
                            <ul class="values-wrapper">
                                <li><a href="javascript:void(0)"><i class='bx bx-list-ul'></i> All News</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bx-plus'></i> Add News</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="javascript:void(0)">
                            <div class="icon"><i class='bx bx-box'></i></div> Categories
                        </a></li>
                    <li><a href="javascript:void(0)">
                            <div class="icon"><i class='bx bx-tag'></i></div> Tags
                        </a></li>
                    <li><a href="javascript:void(0)">
                            <div class="icon"><i class='bx bx-refresh'></i></div> Recovery
                        </a></li>
                </ul>
            </div>
        </li>


        <!-- Page -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-file'></i> Page
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li><a href="javascript:void(0)"><i class='bx bx-list-ul'></i> All Page</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-plus'></i> Add Page</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-refresh'></i> Recovery</a></li>
                </ul>
            </div>
        </li>

        <!-- Location -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-map'></i> Location
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li><a href="javascript:void(0)"><i class='bx bx-list-ul'></i> All Location</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-category'></i> All Category</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-refresh'></i> Recovery</a></li>
                </ul>
            </div>
        </li>

        <!-- Tour -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-world'></i> Tour
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li><a href="javascript:void(0)"><i class='bx bx-list-ul'></i> All Tour</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-plus'></i> Add Tour</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-category'></i> Categories</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-info-circle'></i> Attributes</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-calendar'></i> Availability</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-calendar-check'></i> Booking Calendar</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-refresh'></i> Recovery</a></li>
                </ul>
            </div>
        </li>

        <!-- Popup -->
        <li>
            <a href="javascript:void(0)">
                <i class='bx bx-message-square'></i> Popup
            </a>
        </li>

        <!-- Coupon -->
        <li>
            <a href="javascript:void(0)">
                <i class='bx bx-gift'></i> Coupon
            </a>
        </li>

        <!-- Reviews -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-comment-detail'></i> Reviews
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li><a href="javascript:void(0)"><i class='bx bx-list-ul'></i> All Reviews</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-check'></i> Approved</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-x'></i> Remove</a></li>
                </ul>
            </div>
        </li>

        <!-- Media -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-image'></i> Media
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li class="custom-dropdown custom-dropdown--sub">
                        <a href="javascript:void(0)" class="custom-dropdown__active">
                            <div class="start-icon"><i class='bx bxs-videos'></i>Video</div>
                            <div class="icon"><i class='bx bx-chevron-right'></i></div>
                        </a>
                        <div class="custom-dropdown__values">
                            <ul class="values-wrapper">
                                <li><a href="javascript:void(0)"><i class='bx bx-video'></i> Used</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bx-video-off'></i> Un-Used</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="custom-dropdown custom-dropdown--sub">
                        <a href="javascript:void(0)" class="custom-dropdown__active">
                            <div class="start-icon"><i class='bx bx-photo-album'></i>Pictures</div>
                            <div class="icon"><i class='bx bx-chevron-right'></i></div>
                        </a>
                        <div class="custom-dropdown__values">
                            <ul class="values-wrapper">
                                <li><a href="javascript:void(0)"><i class='bx bx-image'></i> Used</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bx-image-off'></i> Un-Used</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Payout -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-dollar'></i> Payout
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li class="custom-dropdown custom-dropdown--sub">
                        <a href="javascript:void(0)" class="custom-dropdown__active">
                            <div class="start-icon"><i class='bx bx-credit-card-alt'></i>Vendor Payment </div>
                            <div class="icon"><i class='bx bx-chevron-right'></i></div>
                        </a>
                        <div class="custom-dropdown__values">
                            <ul class="values-wrapper">
                                <li><a href="javascript:void(0)"><i class='bx bx-receipt'></i> Invoice</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bx-credit-card'></i> Commissions</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="custom-dropdown custom-dropdown--sub">
                        <a href="javascript:void(0)" class="custom-dropdown__active">
                            <div class="start-icon"><i class='bx bxs-store-alt'></i>Generator</div>
                            <div class="icon"><i class='bx bx-chevron-right'></i></div>
                        </a>
                        <div class="custom-dropdown__values">
                            <ul class="values-wrapper">
                                <li><a href="javascript:void(0)"><i class='bx bx-receipt'></i> Invoice</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bxs-quote-alt-left'></i> Quotation</a>
                                </li>
                                <li><a href="javascript:void(0)"><i class='bx bx-money-withdraw'></i> Voucher</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Themes -->
        <li>
            <a href="javascript:void(0)">
                <i class='bx bx-paint'></i> Themes
            </a>
        </li>
        <!-- Setting -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-cog'></i> Setting
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li><a href="javascript:void(0)"><i class='bx bx-cog'></i> General</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-vertical-top'></i> Header</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-vertical-top bx-rotate-180'></i> Footer</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-image'></i> Logo</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-image-alt'></i> Favicon</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-envelope'></i> Email</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-share'></i> Social Media Links</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-phone'></i> Contact Information</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-search'></i> SEO</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-lock-alt'></i> Privacy Policy</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-archive'></i> Terms & Conditions</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-bar-chart'></i> Analytics</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-bell'></i> Notifications</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-dollar'></i> Currency</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-world'></i> Language</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-credit-card'></i> Payment Gateway</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bxs-truck'></i> Shipping Methods</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-dollar-circle'></i> Tax Settings</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-cloud-upload'></i> Backup & Restore</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-hard-hat'></i> Maintenance Mode</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bxs-check-shield'></i> Captcha</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-key'></i> API Keys</a></li>
                </ul>
            </div>
        </li>

        <!-- Tools -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-wrench'></i> Tools
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li><a href="javascript:void(0)"><i class='bx bx-world'></i> Languages</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-dollar'></i> Currency</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-transfer-alt'></i> Translation Manager</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bxs-cog'></i> System Logs</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-plug'></i> Plugins</a></li>
                </ul>
            </div>
        </li>

        <!-- Users -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-user'></i> Users
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li class="custom-dropdown">
                        <a href="javascript:void(0)">
                            <div class="icon"><i class='bx bxs-user'></i></div>User
                        </a>
                        <div class="custom-dropdown__values">
                            <ul class="values-wrapper">
                                <li><a href="javascript:void(0)"><i class='bx bx-list-ul'></i> All User</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bx-calendar'></i> User Plans</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bx-bar-chart'></i> Plan Report</a></li>
                                <li><a href="javascript:void(0)"><i class='bx bx-calendar-plus'></i> Plan Request</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="javascript:void(0)"><i class='bx bx-shield'></i> Role Manager</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-envelope'></i> Subscribers</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-git-pull-request'></i> Upgrade Request</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-check-circle'></i> Verification Request</a></li>
                </ul>
            </div>
        </li>

        <!-- Report -->
        <li class="custom-dropdown">
            <a href="javascript:void(0)" class="custom-dropdown__active">
                <i class='bx bx-bar-chart'></i> Report
            </a>
            <div class="custom-dropdown__values">
                <ul class="values-wrapper">
                    <li><a href="javascript:void(0)"><i class='bx bx-file'></i> Enquiry Reports</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-calendar'></i> Booking Reports</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-chart'></i> Booking Statistic</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-mail-send'></i> Contact Submissions</a></li>
                    <li><a href="javascript:void(0)"><i class='bx bx-credit-card'></i> Credit Purchase Report</a></li>
                </ul>
            </div>
        </li>


    </ul>

</div>
