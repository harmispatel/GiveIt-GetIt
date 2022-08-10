@extends('fronted.layout')

@section('title', 'Give It & Get It - Login Form')

@section('content')

<body>
    <div class="donation-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="donate-form">
                        <div class="form-title text-center">
                            <h3>Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{route('updatepassword')}}" method="post">
                            @csrf
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-reletive">
                                        <label for="name" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password"
                                            data-toggle="password" name="password" >
                                        <i class="bi bi-eye-slash eye_ic" id="togglePassword"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                        <p style="color:red">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-reletive">
                                        <label for="email" class="form-label">Conform Password</label>
                                        <input type="password" class="form-control" id="comform_password"
                                            data-toggle="password" name="password_confirmation">
                                            
                                        <i class="bi bi-eye-slash eye_ic" id="toggleCPassword"></i>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <p style="color:red">{{ $errors->first('password_confirmation') }}</p>
                                    @endif

                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <a href="{{route('editprofile')}}" class="btn donate-bt mr-2">Back</a>
                                        <button type="submit" class="btn donate-bt">Submit</button>
                                       
                                        <hr>
                                    </div>
                                </div>
                               
                            </div>
                        </form>
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
            
                const toggleCPassword = document.querySelector("#toggleCPassword");
                const comform_password = document.querySelector("#comform_password");

                toggleCPassword.addEventListener("click", function() {
                    // toggle the type attribute
                    const type = comform_password.getAttribute("type") === "password" ? "text" : "password";
                    comform_password.setAttribute("type", type);

                    // toggle the icon
                    this.classList.toggle("bi-eye");
                });
            </script>




@endsection