@extends('admin.login_layouts.main')
@section('content')
    <section class="green-back-2 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="card web-card">
                <div class="das-logo">
                    <img src="{{ asset($logo->img_path ?? 'admin/assets/images/placeholder-logo.png') }}" class="img-fluid"
                        alt="">
                </div>

                <div class="row justify-content-center">

                    <div class="col-lg-10">
                        <h4 class="dark-gren-36 text-center">Admin Login</h4>
                        <form method="POST" action="{{ route('admin.performLogin') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="py-2">Email Address:</label>
                                <input type="email" name="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}" required id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter Email Address">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="form-field">
                                    <label for="exampleInputEmail1" class="py-2">Password:</label>
                                    <div class="iconWrapper">
                                        <input type="password"
                                            class="site-input right-icon enter-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            placeholder="Enter Password" name="password" required id="">
                                        <i class="fa fa-eye-slash enter-icon right-icon" aria-hidden="true"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group form-check d-flex justify-content-between">
                                <!-- <input type="checkbox" class="form-check-input input-check" id="exampleCheck1"> -->
                                <!-- <label class="form-check-label" for="exampleCheck1">Remember Me</label> -->
                                <div class="">
                                    <!-- <a href="forget-password.php" class="black-txt">Forgot Password?</a>  -->
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn yellow-btn mt-0 mx-autp">Sign in</button>
                            </div>
                            <div class="text-center py-2">
                                <!-- <span>New Here? <a href="sign-up.php" class="orng-txt"> Register Your Account</a></span> -->
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('css')
    <style type="text/css">
        .green-back-2 {
            background: var(--color-primary-light);
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {
            /*in page css here*/
        })()
    </script>
@endsection
