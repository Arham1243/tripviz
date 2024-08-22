@extends('layouts.main')
@section('content')
    <div class="cart my-5 pb-3 pt-2">
        <div class="container">
            <div class="text-document text-center section-content my-5">
                <div class="container">
                    <lord-icon src="https://cdn.lordicon.com/lomfljuq.json" trigger="loop" delay="2000">
                    </lord-icon>
                    <h3 class="subHeading">Payment Completed Successfully!</h3>
                    <p class="mt-3">Congratulations! Your payment was processed successfully, and your booking is
                        confirmed. We look forward to seeing you on your tour!</p>

                    <a href="{{ route('index') }}" class="app-btn themeBtn themeBtn--center mt-3">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <style type="text/css">
        lord-icon {
            height: 90px;
            width: 80px;
        }
    </style>
@endsection
@section('js')
    <script></script>
@endsection
