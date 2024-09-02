@extends('admin.dash_layouts.main')
@section('content')
    @include('admin.dash_layouts.sidebar')
    <div class="main-sec">
        <div class="main-wrapper">
            <div class="quick-stats-wrapper">
                <div class="row align-items-center mc-b-3">
                    <div class="col-lg-6 col-12">
                        <div class="primary-heading color-dark">
                            <h2>Quick Links</h2>
                        </div>
                    </div>
                    
                </div>
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-12">
                        <a href="{{ route('admin.showLogo') }}">
                            <div class="status-thumbnail">
                                <div class="status-img">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </div>
                                <div class="status-content">
                                    <h3>LOGO MANAGEMENT</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <a href="{{ route('admin.socialInfo') }}">
                            <div class="status-thumbnail">
                                <div class="status-img">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </div>
                                <div class="status-content">
                                    <h3>Contact/Social Info</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>


        </div>
    </div>
    </div>

   
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
    </style>
@endsection
@section('js')
    <script data-cfasync="false" defer type="text/javascript"
        src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script data-cfasync="false" defer type="text/javascript"
        src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#user-table').DataTable();
        });
    </script>
    <script type="text/javascript">
        (() => {

            /*in page css here*/
        })()
    </script>
@endsection
