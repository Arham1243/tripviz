@if (isset($content->is_form_enabled))
    @if ($content->form_type === 'normal')
        <div class="col-md-12">
            <form action="" class="banner-search" id="destination-wrapper">
                <i class="bx bx-search"></i>
                <select placeholder="Where are you going?" class="banner-search__input" name="resource_id" id="destination"
                    style="width: 100%"></select>
                <input type="hidden" name="resource_type" id="resource_type">
            </form>
        </div>
    @elseif($content->form_type === 'date_selection')
        <div class="col-md-9">
            <div class="date-search">
                <form action="#" class="date-search__btns">
                    <input type="hidden" name="resource_type" id="resource_type">
                    <label for="destination" id="destination-wrapper" class="date-search__btn">
                        <div class="first-half">
                            <i class='bx bxs-map'></i>
                        </div>
                        <div class="second-half">
                            <span class="top-label">Going to</span>
                            <div class="content">
                                <select placeholder="Where are you going?" name="resource_id" id="destination"
                                    style="width: 100%"></select>
                            </div>
                        </div>
                    </label>
                    <button class="date-search__btn date-range-picker" type="button">
                        <div class="first-half">
                            <i class='bx bxs-calendar'></i>
                        </div>
                        <div class="second-half">
                            <span class="top-label">Tour Date</span>
                            <div class="content d-flex align-items-center">
                                <div class="date-wrapper">
                                    <input readonly="" type="text" class="date" name="start_date"
                                        id="startDate" />
                                </div>
                                <div class="date-wrapper">
                                    <input readonly="" type="text" class="date" name="end_date"
                                        id="endDate" />
                                </div>
                            </div>
                        </div>
                    </button>
                    <button type="submit" class="primary-btn">
                        <i class="bx bx-search"></i><span>Search</span>
                    </button>
                </form>
            </div>
        </div>
    @endif
@endif


@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        function initializeDateRangePicker(selectedDate) {
            $("#startDate").val(selectedDate);
            $("#endDate").val(selectedDate);
            $(".date-range-picker")
                .daterangepicker({
                    locale: {
                        format: "MMM D, YYYY",
                    },
                    opens: "center",
                })
                .on("apply.daterangepicker", function(ev, picker) {
                    $("#startDate").val(picker.startDate.format("MMM D, YYYY"));
                    $("#endDate").val(picker.endDate.format("MMM D, YYYY"));
                });
        }
        const today = new Date();
        const formattedDate = today.toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
        });

        document.addEventListener("DOMContentLoaded", function() {
            initializeDateRangePicker(formattedDate);
        });
        $('#destination').select2({
            placeholder: 'Where are you going?',
            dropdownParent: $('#destination-wrapper'),
            minimumInputLength: 1,
            ajax: {
                url: '{{ route('search.suggestions') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: Object.values(data.results)
                    };
                },
                cache: true
            }
        });

        $('#destination-wrapper').on('click focus', function() {
            $('#destination').select2('open');
        });
    </script>
@endpush
