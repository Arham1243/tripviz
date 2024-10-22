@extends('admin.dash_layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="dashboard-content">
            {{ Breadcrumbs::render('admin.tour-availability.index') }}

            <div class="custom-sec custom-sec--form">
                <div class="custom-sec__header">
                    <div class="section-content">
                        <h3 class="heading">{{ isset($title) ? $title : '' }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-box">
                        <div class="form-box__header">
                            <div class="title">Tours</div>
                        </div>
                        <div class="form-box__body p-0">
                            <ul class="settings">
                                @php
                                    $selectedTourId = null;
                                @endphp
                                @foreach ($tours as $tour)
                                    @php
                                        if (request('tour_id') == $tour->id || (!request('tour_id') && $loop->first)) {
                                            $selectedTourId = $tour->id;
                                        }
                                    @endphp
                                    <li class="settings-item">
                                        <a href="{{ Request::url() . '?tour_id=' . $tour->id }}"
                                            data-tour-id="{{ $tour->id }}"
                                            class="settings-item__link 
                                               @if ($selectedTourId == $tour->id) ) 
                                                   active @endif">
                                            {{ $tour->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-box form-box--calendar">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="eventModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center gap-2">Date Information: <div id="selectedDateInfo">
                        </div>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.tour-availability.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="tour_id" id="tourId" value="{{ $selectedTourId }}">
                        <input type="hidden" name="start_date" id="startDate">
                        <input type="hidden" name="end_date" id="endDate">
                        <div class="row align-items-center mt-3">
                            <div class="col-md-6">
                                <div class="form-fields">
                                    <label class="title">Date Range:</label>
                                    <input type="text" name="dates" class="field date-range-picker" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="available_for_booking"
                                        id="available_for_booking" checked value="1">
                                    <label class="form-check-label" for="available_for_booking">Available for
                                        booking?</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-fields">
                                    <label class="title">Max Guest <span class="text-danger">*</span>:</label>
                                    <input type="number" min="0" name="max_guest" class="field" id="maxGuest"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="repeater-table form-fields">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Min</th>
                                                <th scope="col">Max</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" name="adult[name]" class="field" value="adult"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="adult[min]" class="field"
                                                        id="adultMin">
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="adult[max]" class="field"
                                                        id="adultMax">
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" min="0" name="adult[price]"
                                                        class="field" id="adultPrice">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name="child[name]" class="field"
                                                        value="child" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="child[min]"
                                                        class="field" id="childMin">
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="child[max]"
                                                        class="field" id="childMax">
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" min="0"
                                                        name="child[price]" class="field" id="childPrice">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="themeBtn bg-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="themeBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @php
        $selectedTour = \App\Models\Tour::where('id', $selectedTourId)->first();
        if ($selectedTour) {
            $availabilitiesJson = $selectedTour->availabilities->toJson();
        }
    @endphp
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/fullcalendar.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/momentjs/2.29.1/moment.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        const availabilities = {!! $availabilitiesJson !!};

        function formatDate(date) {
            let dateClass = new Date(date);
            let formattedDate = dateClass.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            return formattedDate;
        }

        function getDateRange(startDate, endDate) {
            const dates = [];
            const currentDate = new Date(startDate);
            const endDateObj = new Date(endDate);

            while (currentDate <= endDateObj) {
                dates.push(new Date(currentDate)); // Push a copy of the current date
                currentDate.setDate(currentDate.getDate() + 1); // Increment the date
            }

            return dates;
        }

        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            const events = availabilities.flatMap(av => {
                const dateRange = getDateRange(av.start_date, av.end_date);
                return dateRange.map(date => ({
                    title: `Adult: ${av.adult_price}<br>Child: ${av.child_price}<br>Max Guests: ${av.max_guest}`,
                    date: date.toISOString().split('T')[0], // Format date as YYYY-MM-DD
                    extendedProps: {
                        max_guest: av.max_guest,
                        min_adult: av.min_adult,
                        max_adult: av.max_adult,
                        adult_price: av.adult_price,
                        min_child: av.min_child,
                        max_child: av.max_child,
                        child_price: av.child_price,
                        available_for_booking: av.available_for_booking,
                        start_date: av.start_date,
                        end_date: av.end_date,
                    }
                }));
            });

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events,
                eventContent: function(arg) {
                    let contentHtml = '';
                    if (arg.event.extendedProps.available_for_booking === 0) {
                        contentHtml = '<span class="not-available">Not Available</span>';
                    } else {
                        contentHtml = `<span>${arg.event.title}</span>`;
                    }

                    return {
                        html: contentHtml
                    };
                },
                dateClick: function(info) {

                    let selectedDate = info.dateStr;
                    let clickedEvent = events.find(event => event.date === selectedDate);

                    $('#startDate').val(selectedDate);
                    $('#endDate').val(selectedDate);
                    if (clickedEvent) {
                        $('#maxGuest').val(clickedEvent.extendedProps.max_guest);
                        $('#adultMin').val(clickedEvent.extendedProps.min_adult);
                        $('#adultMax').val(clickedEvent.extendedProps.max_adult);
                        $('#adultPrice').val(clickedEvent.extendedProps.adult_price);
                        $('#childMin').val(clickedEvent.extendedProps.min_child);
                        $('#childMax').val(clickedEvent.extendedProps.max_child);
                        $('#childPrice').val(clickedEvent.extendedProps.child_price);
                        $('#available_for_booking').prop('checked', clickedEvent.extendedProps
                            .available_for_booking == 1);
                    } else {
                        // If there is no event, clear the fields or set default values
                        $('#maxGuest').val('');
                        $('#adultMin').val('');
                        $('#adultMax').val('');
                        $('#adultPrice').val('');
                        $('#childMin').val('');
                        $('#childMax').val('');
                        $('#childPrice').val('');
                        $('#available_for_booking').prop('checked', false);
                    }

                    $('#eventModal').modal('show');

                    $('.date-range-picker').daterangepicker({
                        startDate: selectedDate,
                        endDate: selectedDate,
                        locale: {
                            format: 'YYYY-MM-DD'
                        },
                        opens: 'left'
                    });

                    $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
                        $('#startDate').val(picker.startDate.format('YYYY-MM-DD'));
                        $('#endDate').val(picker.endDate.format('YYYY-MM-DD'));
                    });
                },

                eventClick: function(info) {
                    let selectedDate = new Date(info.event.start);
                    let year = selectedDate.getFullYear();
                    let month = (selectedDate.getMonth() + 1).toString().padStart(2, '0');
                    let day = selectedDate.getDate().toString().padStart(2, '0');

                    // Format the date in YYYY-MM-DD format
                    let formattedSelectedDate = `${year}-${month}-${day}`;
                    $('#startDate').val(formattedSelectedDate);
                    $('#endDate').val(formattedSelectedDate);
                    $('#maxGuest').val(info.event.extendedProps.max_guest);
                    $('#adultMin').val(info.event.extendedProps.min_adult);
                    $('#adultMax').val(info.event.extendedProps.max_adult);
                    $('#adultPrice').val(info.event.extendedProps.adult_price);
                    $('#childMin').val(info.event.extendedProps.min_child);
                    $('#childMax').val(info.event.extendedProps.max_child);
                    $('#childPrice').val(info.event.extendedProps.child_price);
                    $('#available_for_booking').prop('checked', info.event.extendedProps
                        .available_for_booking == 1);
                    $('#eventModal').modal('show');

                    $('.date-range-picker').daterangepicker({
                        startDate: formattedSelectedDate,
                        endDate: formattedSelectedDate,
                        locale: {
                            format: 'YYYY-MM-DD'
                        },
                        opens: 'left'
                    });

                    $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
                        $('#startDate').val(picker.startDate.format('YYYY-MM-DD'));
                        $('#endDate').val(picker.endDate.format('YYYY-MM-DD'));
                    });
                }
            });
            calendar.render();
        });
        $(document).ready(function() {
            // Clear all fields when the modal is closed
            $('#eventModal').on('hidden.bs.modal', function() {
                $('#available_for_booking').prop('checked', false);
                $('#max_guest').val('');
                $('input[name="adult[min]"]').val('');
                $('input[name="adult[max]"]').val('');
                $('input[name="adult[price]"]').val('');
                $('input[name="child[min]"]').val('');
                $('input[name="child[max]"]').val('');
                $('input[name="child[price]"]').val('');
                $('#startDate').val('');
                $('#endDate').val('');
            });
        });
    </script>
@endpush
