@extends('admin.dash_layouts.main')

@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.pages.page-builder', $page) }}
            <div class="custom-sec custom-sec--form">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">Edit Template: {{ isset($title) ? $title : '' }}</h3>
                    </div>
                    <a href="{{ buildUrl(url('/'), 'page', $page->slug) }}?viewer=admin" target="_blank" class="themeBtn">View
                        Page</a>
                </div>

                <div class="row" x-data="templateManager()">
                    <div class="col-md-4">
                        @if (!$sectionsGroups->isEmpty())
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
                                                                    section_key: '{{ $section['section_key'] }}',
                                                                    preview_image: '{{ asset($section['preview_image']) }}'
                                                                }
                                                            }">
                                                                <div class="name" x-text="item.name"></div>
                                                                <div class="actions">
                                                                    <a :href="item.preview_image" data-fancybox="gallery"
                                                                        title="Section preview" class="icon"
                                                                        type="button">
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
                        @else
                            <div class="section-content mt-5 mb-4">
                                <h3 class="heading">No sections available.</h3>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="template-blocks template-blocks--sticky">
                            <form action="{{ route('admin.pages.page-builder.store', $page->id) }}" method="POST">
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
                                                        <template x-for="(item, index) in selectedItems"
                                                            :key="index">
                                                            <li class="chip-list__item">
                                                                <input type="hidden" :name="`sections[section_id][]`"
                                                                    :value="item.id">
                                                                <input type="hidden" class="order"
                                                                    :name="`sections[order][]`" :value="index + 1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div class="order-menu"><i class='bx-sm bx bx-menu'></i>
                                                                    </div>
                                                                    <div class="name" x-text="item.name"></div>
                                                                </div>
                                                                <div class="actions">
                                                                    <a :href="item.preview_image" data-fancybox="gallery"
                                                                        title="Section preview" class="icon"
                                                                        type="button">
                                                                        <i class='bx bxs-show'></i>
                                                                    </a>
                                                                    <button @click="editItem(item)" title="edit details"
                                                                        class="icon" type="button">
                                                                        <i class='bx bxs-edit'></i>
                                                                    </button>
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
                                                    <p class="text-center mb-0"><strong>Empty layout. Add sections.</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button :disabled="selectedItems.length === 0" class="themeBtn mt-4 ms-auto"
                                    type="submit">Save
                                    Template</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="editSection">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center gap-2"> Edit Section: <span
                            class="section-name"></span>
                        <a href="{{ asset('admin/assets/images/placeholder.png') }}" data-fancybox="gallery"
                            title="section preview" class="themeBtn section-preview-image p-1"><i
                                class='bx bxs-show'></i></a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="validation-form">
                    <div class="modal-body">
                        @csrf
                        <div id="renderFields"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="themeBtn bg-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="themeBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">
    </style>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    {{-- <script type="module">
        import {
            sections
        } from '{{ asset('admin/assets/js/sections-fields.js') }}';
    </script> --}}
    <script type="text/javascript">
        function templateManager() {
            return {
                // sections: sections,
                selectedItems: {!! $selectedSections !!},
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
                editItem(item) {
                    $('.section-name').text(item.name);
                    // $('#renderFields').html(this.sections[item.section_key]);
                    $('.section-preview-image').attr('href', item.preview_image);
                    $('#editSection').modal('show');
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
        $(document).ready(function() {
            $('#editSection').on('hidden.bs.modal', function() {
                $('.section-name').text('');
                $('#renderFields').html('');;
                $('.section-preview-image').attr('href',
                    `${$('#web_base_url').val()}/public/admin/assets/images/placeholder.png`);
            });
        });
    </script>
@endpush
