@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-6 col-12">
                    <div class="primary-heading color-dark">
                        <h2>View User Details</h2>
                    </div>
                </div>

            </div>
            <form action="#" method="POST" enctype="multipart/form-data" class="main-form">



                <div class="row">
                    <div class="col-lg-8 col-md-8 col-12 col-center">
                        <div class="user-img-wrapper mc-b-3">
                            <figure class="">
                                <a href="{{ $user->avatar ?? asset('admin/assets/images/placeholder.png') }}"
                                    data-fancybox="gallery">
                                    <img src="{{ $user->profile_img ?? asset('admin/assets/images/placeholder.png') }}"
                                        class="user-details-img" alt="user-img">
                                </a>
                            </figure>
                            <!--<label for="user-img" class="user-img-btn"><i class="fa fa-camera"></i></label> -->
                            <!--<input type="file" onchange="readURL(this);" name="profile_img" id="user-img" class="d-none"-->
                            <!--    accept="image/jpeg, image/png">-->

                        </div>

                    </div>
                    @php
                        $columns_to_ignore = [
                            'avatar',
                            'social_id',
                            'social_token',
                            'email_verified',
                            'is_active',
                            'email_verification_token',
                        ];
                        $files_columns = [];
                    @endphp

                    @foreach ($fields as $field)
                        @if (!in_array($field, $columns_to_ignore) && $user->$field != null)
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                    <input type="text" name="{{ $field }}"
                                        value="{{ old($field, $user->$field) }}" class="form-control"
                                        placeholder="Enter {{ ucwords(str_replace('_', ' ', $field)) }}" readonly>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if ($user->signup_method == 'email')
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Email Verified:</label>
                                <input type="text" name="email_verified"
                                    value="{{ $user->email_verified == 1 ? 'Yes' : 'No' }}" class="form-control"
                                    placeholder="" readonly>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12 mt-3 mb-5">
                        <div class=" d-flex justify-content-center" style="gap: 1rem">
                            @foreach ($files_columns as $field)
                                @if ($user->$field != null)
                                    <a href="{{ asset($user->$field) }}" class="links" target="_blank">View
                                        {{ ucwords(str_replace('_', ' ', $field)) }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>




                    <div class="col-lg-12 col-12">
                        <div class="text-center">
                            <a href="{{ route('admin.dashboard') }}" class="primary-btn primary-bg">Go Back</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>

    </div>
@endsection
@section('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style type="text/css">
        /*in page css here*/
        .img-fluid {
            max-width: 113px;
            height: 113px;
        }

        .datepicker-inline {
            position: absolute;
            left: 0;
            top: 80%;
            z-index: 100;
            background: #fff;
            width: 100%;
            margin: auto;
            box-shadow: 0 0 15px 5px #00000020;
            padding: 1rem;
        }

        .table-condensed {
            width: 100%;
        }
    </style>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var calendarVisible = false;

            $("#calendarContainer").datepicker({
                minViewMode: "years", // Change to years for year input
                format: "yyyy", // Use 'yyyy' format for year
                autoclose: true,
            });

            $("#calendarContainer").hide();

            $("#yearInput").click(function() { // Change to 'yearInput'
                if (calendarVisible) {
                    $("#calendarContainer").hide();
                    calendarVisible = false;
                } else {
                    $("#calendarContainer").show();
                    calendarVisible = true;
                }
            });

            $(document).click(function(event) {
                if (!$(event.target).closest("#calendarContainer, #yearInput").length) {
                    $("#calendarContainer").hide();
                    calendarVisible = false;
                }
            });

            $("#calendarContainer")
                .datepicker()
                .on("changeDate", function(event) {
                    var selectedYear = event.date.getFullYear();
                    $("#yearInput").val(selectedYear); // Change to 'yearInput'
                    $("#calendarContainer").hide();
                    calendarVisible = false;
                });


        });




        (() => {

            /*in page css here*/
        })()
    </script>
@endsection
