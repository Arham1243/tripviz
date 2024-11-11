@extends('admin.dash_layouts.main')

@section('content')
    <div class="col-md-12" x-data="templateManager()">
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

                <div class="row">
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
                                                                    template_path: '{{ $section['template_path'] }}',
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

        <div class="modal" tabindex="-1" id="editSection">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center gap-2"> Edit Section: <span
                                id="section-name"></span>
                            <a href="{{ asset('admin/assets/images/placeholder.png') }}" data-fancybox="gallery"
                                title="section preview" class="themeBtn section-preview-image p-1"><i
                                    class='bx bxs-show'></i></a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.pages.page-builder.sections.save', $page->id) }}" method="POST"
                        id="validation-form" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="section_id" id="section-id">
                            <div class="text-center"><i class="bx-lg  bx bx-loader-alt bx-flip-vertical bx-spin"
                                    style="color: rgb(28, 77, 153); " x-show="isLoading">
                                </i>
                            </div>
                            <div id="renderFields" x-html="sectionContent"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="themeBtn bg-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="themeBtn">Save changes</button>
                        </div>
                    </form>
                </div>
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
    <script type="text/javascript">
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

        function repeater(maxItems) {
            return {
                items: [{
                    subTitle: ''
                }],
                maxItems: maxItems,
                addItem() {
                    if (this.items.length < this.maxItems) {
                        this.items.push({
                            subTitle: ''
                        });
                    }
                },
                remove(index) {
                    if (index !== 0) {
                        this.items.splice(index, 1);
                    }
                }
            };
        }

        function templateManager() {
            return {
                selectedItem: null,
                sectionContent: '',
                isLoading: false,
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
                async editItem(item) {
                    $('#editSection').modal('show');
                    $('#section-name').text(item.name);
                    $('#section-id').val(item.id);
                    this.selectedItem = item;
                    $('.section-preview-image').attr('href', item.preview_image);

                    this.isLoading = true;
                    try {
                        const response = await fetch(
                            `{{ route('admin.pages.page-builder.section-template', $page->id) }}?template_path=${item.template_path}&section_id=${item.id}`
                        );
                        if (response.ok) {
                            document.getElementById('renderFields').innerHTML = await response.text();
                        } else {
                            document.getElementById('renderFields').innerHTML = "<p>Template not found.</p>";
                        }
                    } catch (error) {
                        document.getElementById('renderFields').innerHTML = "<p>Error loading template.</p>";
                    } finally {
                        this.isLoading = false;
                    }

                },
                updateOrder() {
                    this.selectedItems.forEach((item, index) => {
                        item.order = index + 1;
                    });
                }
            };
        }
        $(document).ready(function() {
            $('#editSection').on('hidden.bs.modal', function() {
                $('#section-name').text('');
                $('#section-id').val('');
                $('#renderFields').html('');;
                $('.section-preview-image').attr('href',
                    `${$('#web_base_url').val()}/public/admin/assets/images/placeholder. png`);
            });
        });
    </script>
@endpush
