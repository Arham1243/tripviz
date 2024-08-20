@extends('layouts.main')
@section('content')
    <div class="container"></div>
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <form action="{{ route('set_new_password') }}" method="POST" class="my-5 w-100 static-form loginSignup-popup">
                @csrf
                <input type="hidden" name="token" value="{{ request()->query('token') }}">
                <h3>Reset Password</h3>



                <div class="loginSignup-popup__email">
                    <div class="password-field">
                        <input type="password" placeholder="New password" class="check-fields" name="password" required>
                        <button type="button" class="password-field__show">
                            <i class='bx bxs-show'></i>
                        </button>
                    </div>
                </div>

                <div class="loginSignup-popup__email">
                    <div class="password-field">
                        <input type="password" placeholder="Confirm new password" class="check-fields"
                            name="password_confirmation" required>
                        <button type="button" class="password-field__show">
                            <i class='bx bxs-show'></i>
                        </button>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button class="loginSignup-popup__btn">Set New Password</button>
            </form>


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
    <script type="text/javascript">
        /*in page js here*/
    </script>
@endsection
