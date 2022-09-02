@extends('fronted.layout')

@section('title', 'Give It & Get It - Login Form')

@section('content')





    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('Login')</title>
        <link rel="icon" type="image/png" href="{{ asset('img/fronted/favicon.png') }}">
        @include('fronted.css')
    </head>



    <body>

        @if (session()->has('mistake'))
            <div class="alert alert-warning mistake ">
                {{ session()->get('mistake') }}
            </div>
        @endif
        @if (session()->has('msg'))
            <div class="alert alert-success msg reg">
                {{ session()->get('msg') }}
            </div>
        @endif
        @if (session()->has('logout'))
            <div class="alert alert-warning logout">
                {{ session()->get('logout') }}
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success message">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="donation-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="donate-form">
                            <div class="form-title text-center">
                                <h3>Register</h3>
                            </div>
                            <hr>
                            <form action="{{ route('Regitser.insertdata') }}" id="regiter" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Your Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                value="{{ old('username') }}">
                                            {{-- <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}"> --}}
                                        </div>
                                        @if ($errors->has('username'))
                                            <p style="color:red">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Your Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <p style="color:red">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="phone-number" class="form-label">Your Phone Number</label>
                                            <input type="number" class="form-control" id="number" name="number"
                                                value="{{ old('number') }}">
                                        </div>
                                        @if ($errors->has('number'))
                                            <p style="color:red">{{ $errors->first('number') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Address</label>
                                            <textarea class="form-control" name="address" placeholder="Your Address" id="address" rows="5">{{ old('address') }}</textarea>
                                        </div>
                                        @if ($errors->has('address'))
                                            <p style="color:red">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3 position-reletive">
                                            <label for="name" class="form-label">Password</label>
                                            <input type="password" class="form-control password" id="password"
                                                data-toggle="password" name="password" value="{{ old('password') }}">
                                            <i class="bi bi-eye-slash eye_ic" id="togglePassword"></i>
                                        </div>
                                        @if ($errors->has('password'))
                                            <p style="color:red">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3 position-reletive">
                                            <label for="email" class="form-label">Conform Password</label>
                                            <input type="password" class="form-control comform_password"
                                                id="comform_password" data-toggle="password" name="password_confirmation"
                                                value="{{ old('password_confirmation') }}">
                                            <i class="bi bi-eye-slash eye_ic" id="toggleCPassword"></i>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <p style="color:red">{{ $errors->first('password_confirmation') }}</p>
                                        @endif

                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn donate-bt">Submit</button>
                                            <hr>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 text-center">
                                    <p>Have an account? <a href="{{ route('userlogin') }}">Log In</a>
                                    </p>
                                </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="donate-form">
                            <div class="form-title text-center">
                                <h3>Login</h3>
                            </div>
                            <hr>
                            <form action="{{ route('useget') }}" id="loginForm" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Your Email Address</label>
                                            <input type="email" class="form-control" id="email"
                                                value="{{ old('email') }}" name="email">
                                            @if ($errors->has('email'))
                                                <p class="alert text-danger">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3  position-relative">
                                            <label for="password" class="form-label">Your Password</label>
                                            <input type="password" class="form-control loginpassword" id="loginpassword"
                                                value="{{ old('password') }}" name="password">
                                            <i class="bi bi-eye-slash eye_ic" id="toggleloginPassword"></i>
                                            @if ($errors->has('password'))
                                                <p class="alert text-danger">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-end mb-3">
                                        <a href="{{ route('forget.password.get') }}">Forgot your password?</a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn donate-bt">Submit</button>
                                            {{-- <button></button> --}}
                                        </div>
                                        <hr>
                                        {{-- <div class="col-md-12 text-center" >
                                        <p>You Don't Have An Account ? <a href="{{ route('register') }}">Register
                                                Now</a>
                                        </p>
                                    </div> --}}
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="loader" style="display: block; background: rgb(255, 254, 254);">
            <div id="square">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div id="laoding_text">
                <span>Loading...</span>
            </div>
        </div>
        </div>
        </div>

    </body>

    </html>
@endsection
@section('js')
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
        const toggleCPassword = document.querySelector("#toggleCPassword");
        const comform_password = document.querySelector(".comform_password");

        toggleCPassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = comform_password.getAttribute("type") === "password" ? "text" : "password";
            comform_password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
        const toggleloginPassword = document.querySelector("#toggleloginPassword");
        const loginpassword = document.querySelector(".loginpassword");

        toggleloginPassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = loginpassword.getAttribute("type") === "password" ? "text" : "password";
            loginpassword.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        setTimeout(() => {
            $('.logout, .reg, .message, .mistake').remove();
        }, 3500);

        $(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6


                    }
                },
                messages: {
                    email: {
                        required: "Specify email",
                        email: "Please enter a Specify valid email address"
                    },
                    password: {
                        required: "Specify password",
                        minlength: "Password must be 6 length"
                    }
                }

            });
        });
        $(document).ready(function() {
            $("#regiter").validate({
                rules: {
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    number: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    address: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }

                },
                messages: {
                    username: {
                        required: "Name  is required",
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address",
                    },
                    number: {
                        required: "Mobile No. is required",
                        minlength: "Mobile No. must be 10 digits",
                        maxlength: "Mobile No. must be 10 digits",
                        number: "Mobile No. is not valid"
                    },
                    address: {
                        required: "Address is required"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be 6 length"
                    },
                    password_confirmation: {
                        required: "Password Confirmation is required",
                        minlength: "Password must be 6 length",
                        equalTo: "Password Confirmation does not match with Password"
                    }

                }
            });

        });
    </script>

@endsection
