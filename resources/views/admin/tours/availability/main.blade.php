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
                                    $selected_tour_id = null;
                                @endphp
                                @foreach ($tours as $tour)
                                    @php
                                        if (request('tour_id') == $tour->id || (!request('tour_id') && $loop->first)) {
                                            $selected_tour_id = $tour->id;
                                        }
                                    @endphp
                                    <li class="settings-item">
                                        <a href="{{ Request::url() . '?tour_id=' . $tour->id }}"
                                            data-tour-id="{{ $tour->id }}"
                                            class="settings-item__link 
                                               @if ($selected_tour_id == $tour->id) ) 
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
                        <input type="hidden" name="tour_id" id="tourId" value="{{ $selected_tour_id }}">
                        <input type="hidden" name="start_date" id="startDate">
                        <input type="hidden" name="end_date" id="endDate">
                        <div class="row align-items-center mt-3">
                            <div class="col-md-12">
                                <div class="form-fields">
                                    <label class="title">Date Range:</label>
                                    <input type="text" name="dates" class="field date-range-picker" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="available_for_booking"
                                        id="available_for_booking" checked value="1">
                                    <label class="form-check-label" for="available_for_booking">
                                        Available for booking?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-fields">
                                    <label class="title">Max Guest <span class="text-danger">*</span>:</label>
                                    <input type="number" min="0" name="max_guest" class="field" required="">
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
                                                    <input type="number" min="0" name="adult[min]" class="field">
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="adult[max]" class="field">
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" min="0" name="adult[price]"
                                                        class="field">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name="child[name]" class="field" value="child"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="child[min]"
                                                        class="field">
                                                </td>
                                                <td>
                                                    <input type="number" min="0" name="child[max]"
                                                        class="field">
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" min="0"
                                                        name="child[price]" class="field">
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
        function formatDate(date) {
            let dateClass = new Date(date);
            let formattedDate = dateClass.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            return formattedDate;
        }

        document.addEventListener('DOMContentLoaded', function() {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [{
                        title: 'Max Guests: 15',
                        date: '2024-10-10',
                        max_guest: 15
                    },
                    {
                        title: 'Max Guests: 20',
                        date: '2024-10-15',
                        max_guest: 20
                    }
                ],
                dateClick: function(info) {
                    let selectedDate = info.dateStr;

                    $('#startDate').val(selectedDate);
                    $('#endDate').val(selectedDate);
                    $('#eventModal').modal('show');

                    $('.date-range-picker').daterangepicker({
                        startDate: selectedDate,
                        endDate: selectedDate,
                        locale: {
                            format: 'YYYY-MM-DD'
                        },
                        opens: 'left'
                    });
                },
                eventClick: function(info) {
                    let selectedDate = info.event.start;
                    let formattedSelectedDate = selectedDate.toISOString().split('T')[0];

                    $('#startDate').val(formattedSelectedDate);
                    $('#endDate').val(formattedSelectedDate);
                    $('#eventModal').modal('show');

                    $('.date-range-picker').daterangepicker({
                        startDate: formattedSelectedDate,
                        endDate: formattedSelectedDate,
                        locale: {
                            format: 'YYYY-MM-DD'
                        },
                        opens: 'left'
                    });
                }
            });
            calendar.render();
        });

        $(document).ready(function() {
            $('.date-range-picker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                opens: 'left',
            });
        });
        $('.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
            console.log(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                'MM/DD/YYYY'))
        });
    </script>
@endpush
