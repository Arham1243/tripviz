@extends('admin.dash_layouts.main')

@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.pages.template-builder', $page) }}
            <div class="section-content mt-5 mb-4">
                <h3 class="heading">Edit Template: {{ isset($title) ? $title : '' }}</h3>
            </div>
            @php
                $sectionsGroups = [
                    'Banner Sections' => [
                        [
                            'id' => 1,
                            'name' => 'Banner: Search Bar',
                            'preview_image' => asset('admin/assets/images/sections/banner.png'),
                        ],
                    ],
                    'Location Sections' => [
                        [
                            'id' => 2,
                            'name' => 'Location Slider: Cities with Tour Count',
                            'preview_image' => asset('admin/assets/images/sections/cities-slider.png'),
                        ],
                        [
                            'id' => 3,
                            'name' => 'Location List: Cities with Tour Count',
                            'preview_image' => asset('admin/assets/images/sections/cities-list.png'),
                        ],
                        [
                            'id' => 19,
                            'name' => 'Location Slider: Popular Cities',
                            'preview_image' => asset('admin/assets/images/sections/cities-popular.png'),
                        ],
                    ],
                    'Tour Sections' => [
                        [
                            'id' => 4,
                            'name' => 'Tour Section: 5-Item Grid',
                            'preview_image' => asset('admin/assets/images/sections/tour-5-box.png'),
                        ],
                        [
                            'id' => 5,
                            'name' => 'Tour Section: 4-Item Grid',
                            'preview_image' => asset('admin/assets/images/sections/tour-4-box.png'),
                        ],
                        [
                            'id' => 6,
                            'name' => 'Tour Section: 3-Item Grid',
                            'preview_image' => asset('admin/assets/images/sections/tour-3-box.png'),
                        ],
                        [
                            'id' => 7,
                            'name' => 'Tour Section: Trending Tours Slider',
                            'preview_image' => asset('admin/assets/images/sections/trending-4-tour.png'),
                        ],
                    ],
                    'Activities Sections' => [
                        [
                            'id' => 8,
                            'name' => 'Water Activities: 3-Box Layout',
                            'preview_image' => asset('admin/assets/images/sections/act-3.png'),
                        ],
                        [
                            'id' => 9,
                            'name' => 'Water Activities: 4-Item Grid',
                            'preview_image' => asset('admin/assets/images/sections/act-4.png'),
                        ],
                    ],
                    'Call-to-Action' => [
                        [
                            'id' => 10,
                            'name' => 'Call-to-Action: Standard',
                            'preview_image' => asset('admin/assets/images/sections/cta-1.png'),
                        ],
                        [
                            'id' => 11,
                            'name' => 'Call-to-Action: Counter Style',
                            'preview_image' => asset('admin/assets/images/sections/cta-2.png'),
                        ],
                    ],
                    'Other Content' => [
                        [
                            'id' => 12,
                            'name' => 'News Section: Standard',
                            'preview_image' => asset('admin/assets/images/sections/news.png'),
                        ],
                        [
                            'id' => 13,
                            'name' => 'Testimonials Section',
                            'preview_image' => asset('admin/assets/images/sections/testimonials.png'),
                        ],
                        [
                            'id' => 14,
                            'name' => 'Newsletter Signup',
                            'preview_image' => asset('admin/assets/images/sections/newsletter.png'),
                        ],
                        [
                            'id' => 15,
                            'name' => 'Contact Section: Standard',
                            'preview_image' => asset('admin/assets/images/sections/contact.png'),
                        ],
                        [
                            'id' => 16,
                            'name' => 'Travel Promotions Section',
                            'preview_image' => asset('admin/assets/images/sections/promotion.png'),
                        ],
                        [
                            'id' => 17,
                            'name' => 'App Download Section',
                            'preview_image' => asset('admin/assets/images/sections/download.png'),
                        ],
                    ],
                ];
            @endphp
            <div class="row" x-data="templateManager()">
                <div class="col-md-4">
                    <ul class="template-blocks">
                        @foreach ($sectionsGroups as $category => $sectionsGroup)
                            <li class="template-block {{ $loop->first ? 'open' : '' }}" custom-accordion>
                                <div class="template-block__header" custom-accordion-header>
                                    <div class="title">{{ $category }}</div>
                                    <div class="icon"><i class='bx bx-chevron-down'></i></div>
                                </div>
                                <div class="template-block__body" custom-accordion-body>
                                    <div class="overflow-hidden">
                                        <div class="body-wrapper">
                                            <ul class="chip-list">
                                                @foreach ($sectionsGroup as $section)
                                                    <li class="chip-list__item" x-data="{
                                                        item: {
                                                            id: '{{ $section['id'] }}',
                                                            name: '{{ $section['name'] }}',
                                                            previewImage: '{{ $section['preview_image'] }}'
                                                        }
                                                    }">
                                                        <div class="name" x-text="item.name"></div>
                                                        <div class="actions">
                                                            <a :href="item.previewImage" data-fancybox="gallery"
                                                                title="Section preview" class="icon" type="button">
                                                                <i class='bx bxs-show'></i>
                                                            </a>
                                                            <button title="Add Section" @click="addItem(item)"
                                                                class="icon" type="button"><i
                                                                    class='bx bx-plus'></i></button>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-8">
                    <div class="template-blocks template-blocks--sticky">
                        <form action="{{ route('admin.pages.template-builder.store', $page->id) }}" method="POST">
                            @csrf
                            <div class="template-block">
                                <div class="template-block__header">
                                    <div class="title">Page Content Layout</div>
                                </div>
                                <div class="template-block__body">
                                    <div class="overflow-hidden">
                                        <div class="body-wrapper">
                                            <div x-show="selectedItems.length > 0">
                                                <ul class="chip-list" data-sortable-body>
                                                    <template x-for="(item, index) in selectedItems" :key="index">
                                                        <li class="chip-list__item">
                                                            <input type="hidden" :name="`sections[section_id][]`"
                                                                :value="item.name">
                                                            <input type="hidden" class="order" :name="`sections[order][]`"
                                                                :value="index + 1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="order-menu mt-1"><i
                                                                        class='bx-sm bx bx-menu'></i>
                                                                </div>
                                                                <div class="name" x-text="item.name"></div>
                                                            </div>
                                                            <div class="actions">
                                                                <a :href="item.previewImage" data-fancybox="gallery"
                                                                    title="Section preview" class="icon" type="button">
                                                                    <i class='bx bxs-show'></i>
                                                                </a>
                                                                <button @click="removeItem(index)" title="Remove"
                                                                    class="icon" type="button">
                                                                    <i class='text-danger bx bxs-trash-alt'></i>
                                                                </button>
                                                            </div>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                            <div x-show="selectedItems.length === 0">
                                                <p class="text-center mb-0"><strong>Empty layout. Add sections.</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="themeBtn mt-4 ms-auto" type="submit">Save Template</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script type="text/javascript">
        function templateManager() {
            return {
                selectedItems: [],
                addItem(item) {
                    this.selectedItems.push({
                        ...item
                    });
                    this.updateOrder();
                },
                removeItem(index) {
                    this.selectedItems.splice(index, 1);
                    this.updateOrder();
                },
                updateOrder() {
                    this.selectedItems.forEach((item, index) => {
                        item.order = index + 1;
                    });
                }
            };
        }

        document.addEventListener('alpine:init', () => {
            const sortableTableBody = document.querySelector("[data-sortable-body]");
            if (sortableTableBody) {
                const sortable = new Sortable(sortableTableBody, {
                    animation: 300,
                    onEnd: function(evt) {
                        const chipItems = sortableTableBody.querySelectorAll('.chip-list__item');
                        chipItems?.forEach((item, index) => {
                            const orderInput = item.querySelector('.order');
                            if (orderInput) {
                                orderInput.value = index + 1;
                            }
                        });
                    },
                });
            }
        });
    </script>
@endsection
