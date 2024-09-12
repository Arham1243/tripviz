@php
    $menuItems = [
        [
            'title' => 'Dashboard',
            'icon' => 'bx bxs-home',
            'route' => route('admin.dashboard'),
        ],
        [
            'title' => 'Blog | News',
            'icon' => 'bx bx-news',
            'submenu' => [
                [
                    'title' => 'Blog',
                    'icon' => 'bx bxl-blogger',
                    'submenu' => [
                        [
                            'title' => 'All Blog',
                            'icon' => 'bx bx-list-ul',
                            'route' => route('admin.blogs.index'),
                        ],
                        [
                            'title' => 'Add Blog',
                            'icon' => 'bx bx-plus',
                            'route' => route('admin.blogs.create'),
                        ],
                    ],
                ],
                [
                    'title' => 'News',
                    'icon' => 'bx bxs-news',
                    'submenu' => [
                        [
                            'title' => 'All News',
                            'icon' => 'bx bx-list-ul',
                            'route' => 'javascript:void(0)',
                        ],
                        [
                            'title' => 'Add News',
                            'icon' => 'bx bx-plus',
                            'route' => 'javascript:void(0)',
                        ],
                    ],
                ],
                [
                    'title' => 'Categories',
                    'icon' => 'bx bx-box',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Tags',
                    'icon' => 'bx bx-tag',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Recovery',
                    'icon' => 'bx bx-refresh',
                    'route' => 'javascript:void(0)',
                ],
            ],
        ],
        [
            'title' => 'Page',
            'icon' => 'bx bx-file',
            'submenu' => [
                [
                    'title' => 'All Page',
                    'icon' => 'bx bx-list-ul',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Add Page',
                    'icon' => 'bx bx-plus',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Recovery',
                    'icon' => 'bx bx-refresh',
                    'route' => 'javascript:void(0)',
                ],
            ],
        ],
        [
            'title' => 'Location',
            'icon' => 'bx bx-map',
            'submenu' => [
                [
                    'title' => 'All Location',
                    'icon' => 'bx bx-list-ul',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'All Category',
                    'icon' => 'bx bx-category',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Recovery',
                    'icon' => 'bx bx-refresh',
                    'route' => 'javascript:void(0)',
                ],
            ],
        ],
        [
            'title' => 'Tour',
            'icon' => 'bx bx-world',
            'submenu' => [
                [
                    'title' => 'All Tour',
                    'icon' => 'bx bx-list-ul',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Add Tour',
                    'icon' => 'bx bx-plus',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Categories',
                    'icon' => 'bx bx-category',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Attributes',
                    'icon' => 'bx bx-info-circle',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Availability',
                    'icon' => 'bx bx-calendar',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Booking Calendar',
                    'icon' => 'bx bx-calendar-check',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Recovery',
                    'icon' => 'bx bx-refresh',
                    'route' => 'javascript:void(0)',
                ],
            ],
        ],
        [
            'title' => 'Popup',
            'icon' => 'bx bx-message-square',
            'route' => 'javascript:void(0)',
        ],
        [
            'title' => 'Coupon',
            'icon' => 'bx bx-gift',
            'route' => 'javascript:void(0)',
        ],
        [
            'title' => 'Reviews',
            'icon' => 'bx bx-comment-detail',
            'submenu' => [
                [
                    'title' => 'All Reviews',
                    'icon' => 'bx bx-list-ul',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Approved',
                    'icon' => 'bx bx-check',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Remove',
                    'icon' => 'bx bx-x',
                    'route' => 'javascript:void(0)',
                ],
            ],
        ],
        [
            'title' => 'Media',
            'icon' => 'bx bx-image',
            'submenu' => [
                [
                    'title' => 'Video',
                    'icon' => 'bx bxs-videos',
                    'submenu' => [
                        [
                            'title' => 'Used',
                            'icon' => 'bx bx-video',
                            'route' => 'javascript:void(0)',
                        ],
                        [
                            'title' => 'Un-Used',
                            'icon' => 'bx bx-video-off',
                            'route' => 'javascript:void(0)',
                        ],
                    ],
                ],
                [
                    'title' => 'Pictures',
                    'icon' => 'bx bx-photo-album',
                    'submenu' => [
                        [
                            'title' => 'Used',
                            'icon' => 'bx bx-image',
                            'route' => 'javascript:void(0)',
                        ],
                        [
                            'title' => 'Un-Used',
                            'icon' => 'bx bx-image-off',
                            'route' => 'javascript:void(0)',
                        ],
                    ],
                ],
            ],
        ],
        [
            'title' => 'Payout',
            'icon' => 'bx bx-dollar',
            'submenu' => [
                [
                    'title' => 'Vendor Payment',
                    'icon' => 'bx bx-credit-card-alt',
                    'submenu' => [
                        [
                            'title' => 'Invoice',
                            'icon' => 'bx bx-receipt',
                            'route' => 'javascript:void(0)',
                        ],
                        [
                            'title' => 'Commissions',
                            'icon' => 'bx bx-credit-card',
                            'route' => 'javascript:void(0)',
                        ],
                    ],
                ],
                [
                    'title' => 'Generator',
                    'icon' => 'bx bxs-store-alt',
                    'submenu' => [
                        [
                            'title' => 'Invoice',
                            'icon' => 'bx bx-receipt',
                            'route' => 'javascript:void(0)',
                        ],
                        [
                            'title' => 'Quotation',
                            'icon' => 'bx bxs-quote-alt-left',
                            'route' => 'javascript:void(0)',
                        ],
                        [
                            'title' => 'Voucher',
                            'icon' => 'bx bx-money-withdraw',
                            'route' => 'javascript:void(0)',
                        ],
                    ],
                ],
            ],
        ],
        [
            'title' => 'Themes',
            'icon' => 'bx bx-paint',
            'route' => 'javascript:void(0)',
        ],
        [
            'title' => 'Setting',
            'icon' => 'bx bx-cog',
            'submenu' => [
                [
                    'title' => 'General',
                    'icon' => 'bx bx-cog',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Header',
                    'icon' => 'bx bx-vertical-top',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Footer',
                    'icon' => 'bx bx-vertical-top bx-rotate-180',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Logo',
                    'icon' => 'bx bx-image',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Favicon',
                    'icon' => 'bx bx-image-alt',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Email',
                    'icon' => 'bx bx-envelope',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Social Media Links',
                    'icon' => 'bx bx-share',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'Contact Information',
                    'icon' => 'bx bx-phone',
                    'route' => 'javascript:void(0)',
                ],
                [
                    'title' => 'SEO',
                    'icon' => 'bx bx-search-alt',
                    'route' => 'javascript:void(0)',
                ],
            ],
        ],
    ];
@endphp


<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-header">
        <div class="sidebar-header__icon">
            <img src="{{ asset($logo->img_path ?? 'admin/assets/images/placeholder-logo.png') }}" alt="Logo"
                class="imgFluid">
        </div>
    </a>
    <ul class="sidebar-nav">
        @foreach ($menuItems as $item)
            @php
                $isItemActive = Request::url() === ($item['route'] ?? '');
                $hasActiveSubmenu =
                    isset($item['submenu']) &&
                    array_filter($item['submenu'], function ($submenu) {
                        return isset($submenu['submenu']) &&
                            array_filter($submenu['submenu'], function ($subSubMenu) {
                                return Request::url() === ($subSubMenu['route'] ?? '');
                            });
                    });
                $isOpen = $isItemActive || $hasActiveSubmenu;
            @endphp
            <li class="{{ isset($item['submenu']) ? ($isOpen ? 'custom-dropdown open' : 'custom-dropdown') : '' }}">
                <a href="{{ $item['route'] ?? 'javascript:void(0)' }}"
                    class="{{ isset($item['submenu']) ? 'custom-dropdown__active' : '' }} {{ $isItemActive ? 'active' : '' }}">
                    <div class="info">
                        <i class="{{ $item['icon'] }}"></i>
                        {{ $item['title'] }}
                    </div>
                    @if (isset($item['submenu']))
                        <div class="icon"><i class='bx bx-chevron-down'></i></div>
                    @endif
                </a>
                @if (isset($item['submenu']))
                    <div class="custom-dropdown__values {{ $isOpen ? 'open' : '' }}">
                        <ul class="values-wrapper">
                            @foreach ($item['submenu'] as $submenu)
                                @php
                                    $isSubmenuActive = Request::url() === ($submenu['route'] ?? '');
                                    $hasActiveSubSubmenu =
                                        isset($submenu['submenu']) &&
                                        array_filter($submenu['submenu'], function ($subSubMenu) {
                                            return Request::url() === ($subSubMenu['route'] ?? '');
                                        });
                                    $isSubOpen = $isSubmenuActive || $hasActiveSubSubmenu;
                                @endphp
                                <li class="custom-dropdown custom-dropdown--sub {{ $isSubOpen ? 'open' : '' }}">
                                    <a href="javascript:void(0)"
                                        class="{{ isset($submenu['submenu']) ? 'custom-dropdown__active' : '' }}">
                                        <div class="info">
                                            <i class="{{ $submenu['icon'] }}"></i> {{ $submenu['title'] }}
                                        </div>
                                        @if (isset($submenu['submenu']))
                                            <div class="icon"><i class='bx bx-chevron-down'></i></div>
                                        @endif
                                    </a>
                                    @if (isset($submenu['submenu']))
                                        <div class="custom-dropdown__values {{ $isSubOpen ? 'open' : '' }}">
                                            <ul class="values-wrapper">
                                                @foreach ($submenu['submenu'] as $subSubMenu)
                                                    @php
                                                        $isSubSubmenuActive =
                                                            Request::url() === ($subSubMenu['route'] ?? '');
                                                    @endphp
                                                    <li>
                                                        <a class="{{ $isSubSubmenuActive ? 'active' : '' }}"
                                                            href="{{ $subSubMenu['route'] ?? 'javascript:void(0)' }}">
                                                            <div class="info">
                                                                <i class="{{ $subSubMenu['icon'] }}"></i>
                                                                {{ $subSubMenu['title'] }}
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>

</div>
