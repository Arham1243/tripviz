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
                                @foreach ($tours as $tour)
                                    <li class="settings-item">
                                        <button type="button" data-tour-id="{{ $tour->id }}"
                                            class="settings-item__link {{ $loop->first ? 'active' : '' }}">{{ $tour->title }}</button>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center gap-2">Date Information: <div id="selectedDateInfo"></div></h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        @csrf
                        <input type="hidden" name="date" id="tourDate">
                        <input type="hidden" name="tour_id" id="tourId" value="1">

                        <div id="dynamicFormFields"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="themeBtn bg-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveEvent" class="themeBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/fullcalendar.min.css" />
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
        let formFields = {
            max_guest: {
                label: 'Max Guest',
                type: 'number',
                placeholder: '',
                required: true
            }
        };

        function generateFormFields(fields) {
            let formContainer = $('#dynamicFormFields');
            formContainer.empty();
            let fieldHtml = ''
            for (const key in fields) {
                let field = fields[key];
                fieldHtml += `
        <div class="form-fields">
            <label class="title">${field.label} ${field.required ? '<span class="text-danger">*</span>' : ''}:</label>
            <input type="${field.type}" name="${key}" class="field" 
                placeholder="${field.placeholder}" ${field.required ? 'required' : ''}>
        </div>`;
            }
            formContainer.append(fieldHtml);
        }

        function fillFormFields(fields, data = {}) {
            for (const key in fields) {
                let fieldValue = data[key] || '';
                $(`input[name="${key}"]`).val(fieldValue);
            }
        }

        function formatDate(date) {
            let dateClass = new Date(date);

            let formattedDate = dateClass.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            return formattedDate
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
                    // Find if an event exists on the clicked date
                    let event = calendar.getEvents().find(e => e.startStr === info.dateStr);
                    $('#tourDate').val(info.dateStr); // Set the clicked date in the form

                    generateFormFields(formFields); // Generate fields dynamically

                    if (event) {
                        // If event exists, prefill form with event data
                        let data = {
                            max_guest: event.extendedProps.max_guest || '',
                            tour_duration: event.extendedProps.tour_duration || ''
                        };
                        fillFormFields(formFields, data); // Fill fields with event data
                    } else {
                        // If no event, clear form fields for a new entry
                        fillFormFields(formFields);
                    }

                    $('#selectedDateInfo').text(`${formatDate(info.dateStr)}`);


                    $('#eventModal').modal('show'); // Show modal for both cases
                },
                eventClick: function(info) {
                    let event = info.event;
                    let data = {
                        max_guest: event.extendedProps.max_guest || '',
                        tour_duration: event.extendedProps.tour_duration || ''
                    };
                    $('#selectedDateInfo').text(`${formatDate(event.startStr)}`);


                    $('#tourDate').val(event.startStr);
                    generateFormFields(formFields); // Generate fields dynamically
                    fillFormFields(formFields, data); // Fill fields with existing event data
                    $('#eventModal').modal('show');
                }
            });
            calendar.render();

            // Save button handler
            $('#saveEvent').on('click', function() {
                const date = $('#tourDate').val();
                const maxGuest = $('input[name="max_guest"]').val();
                const tourId = $('#tourId').val();

                // Handle save logic here

                $('#eventModal').modal('hide');
            });
        });
    </script>
@endpush
