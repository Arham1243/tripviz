@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="row align-items-center mc-b-3">
                <div class="col-lg-6 col-12">
                    <div class="primary-heading color-dark">
                        <h2>Contact / Social Info</h2>
                    </div>
                </div>

            </div>
            <form action="{{ route('admin.saveSocialInfo') }}" method="POST" class="main-form">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <h6><strong>Social Media</strong></h6>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Facebook:</label>
                            <input type="url" name="FACEBOOK" class="form-control"
                                value="{{ $config['FACEBOOK'] ?? '' }} " placeholder="Enter Facebook Address">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Instagram:</label>
                            <input type="url" name="INSTAGRAM" class="form-control"
                                value="{{ $config['INSTAGRAM'] ?? '' }}" placeholder="Enter Instagram Address">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Twitter:</label>
                            <input type="url" name="TWITTER" class="form-control" value="{{ $config['TWITTER'] ?? '' }}"
                                placeholder="Enter Twitter Address">
                        </div>
                    </div>

                    {{-- <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Youtube:</label>
                            <div class="relative-div">
                                <input type="url" name="YOUTUBE"  class="form-control"
                                    value="{{ $config['YOUTUBE'] ?? '' }}" placeholder="Enter Youtube link">
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <h6><strong>Contact Infomartion</strong></h6>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Phone:</label>
                            <div class="relative-div">
                                <input type="text" name="COMPANYPHONE" class="form-control"
                                    value="{{ $config['COMPANYPHONE'] ?? '' }}" placeholder="Enter Phone Number">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Phone 2:</label>
                            <div class="relative-div">
                                <input type="text" name="COMPANYPHONE2"  class="form-control"
                                    value="{{ $config['COMPANYPHONE2'] ?? '' }}" placeholder="Enter Phone Number">
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Email:</label>
                            <div class="relative-div">
                                <input type="email" name="COMPANYEMAIL" class="form-control"
                                    value="{{ $config['COMPANYEMAIL'] ?? '' }}" placeholder="Enter Email Address">
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Address:</label>
                            <div class="relative-div">
                                <input type="text" name="COMPANYADDRESS"  class="form-control"
                                    value="{{ $config['COMPANYADDRESS'] ?? '' }}" placeholder="Enter Address">
                            </div>
                        </div>
                    </div> --}}


                    <div class="col-lg-12 col-12">
                        <div class="text-center">
                            <button type="submit" class="primary-btn primary-bg">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <style type="text/css">

    </style>
@endsection
@section('js')
@endsection
