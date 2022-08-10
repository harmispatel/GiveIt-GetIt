@include('common.css');

        <div class="container login-container">
            <div class="row justify-content-center">
                <div class="col-md-6 login-form">
                    <div class="login_form_in">
                        <h1 class="auth_title text-left">Password Reset</h1>
                        
                        {{--  message --}}
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <form action="{{ route('submitForm') }}" method="POST">
                            @csrf
                            <div class="alert alert-success bg-soft-primary border-0" role="alert">
                                Enter your email address and we'll send you an email with instructions to reset your password.
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email Address">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-lg btn-block">Reset Password</button>
                                {{-- <button type="button" class="btn btn-primary btn-lg btn-block">Reset Password</button> --}}
                            </div>
                            {{-- <div class="form-group other_auth_links">
                                <a class="" href="https://procraft.studio">Login</a>
                                <a class="" href="https://procraft.studio">Register</a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
