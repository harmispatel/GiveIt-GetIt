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
    @if (session()->has('msg'))
        <div class="alert alert-success msg">
            {{ session()->get('msg') }}
        </div>
    @endif
    @if (session()->has('loginwrong'))
        <div class="alert alert-danger loginwrong">
            {{ session()->get('loginwrong') }}
        </div>
    @endif
    @if (session()->has('logout'))
        <div class="alert alert-warning logout">
            {{ session()->get('logout') }}
        </div>
    @endif

    <div class="donation-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="donate-form">
                        <div class="form-title text-center">
                            <h3>Login</h3>
                        </div>
                        <hr>
                        
                        <form action="{{ route('useget') }}" method="POST">
                            
                            @csrf
                            
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Your Email Address</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ old('email') }}" name="email">
                                        @if ($errors->has('email'))
                                            <p class="alert alert-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3" position-reletive>
                                        <label for="password" class="form-label">Your Password</label>
                                        <input type="password" class="form-control " id="password"
                                            value="{{ old('password') }}" name="password">
                                        <i class="bi bi-eye-slash eye_ic" id="togglePassword"></i>
                                        @if ($errors->has('password'))
                                            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('forget.password.get') }}">Forgot your password?</a>


                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn donate-bt">Submit</button>
                                    </div>
                                    <hr>
                                    <div class="col-md-10 text-center"  style="text-align-last: end">
                                        <p>You Don't Have An Account ? <a href="{{ route('register') }}">Register
                                                Now</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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

                setTimeout(() => {
                    $('.logout').remove( );
                }, 3500);
                setTimeout(() =>{
                    $('.loginwrong').remove( );
                }, 3500);

            </script>
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
    @include('fronted.js')

</body>

</html>
@endsection