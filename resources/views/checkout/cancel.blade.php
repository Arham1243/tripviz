@extends('layouts.main')
@section('content')
    <div class="cart my-5 pb-5 pt-2">
        <div class="container">
            <div class="text-document text-center section-content my-5">
                <div class="container">
                    <lord-icon src="https://cdn.lordicon.com/zxvuvcnc.json" trigger="loop" delay="2000">
                    </lord-icon>
                    <h3 class="subHeading">Payment Was Cancelled</h3>
                    <p class="mt-3">It looks like your payment didn’t go through. Please try again or contact support if
                        you need assistance.</p>

                    <a href="{{ route('index') }}" class="app-btn themeBtn themeBtn--center mt-3">Back to Home</a>
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
