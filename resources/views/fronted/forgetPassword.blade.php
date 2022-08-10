
    @include('fronted.css')

@section('title', 'Give It & Get It - Forgot Password')

@section('content')
<body>
    
    <div class="donation-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="donate-form">
                        <div class="form-title text-center">


                    <h3>Reset Password</h3>
                    <hr>
                    
    
                      @if (Session::has('message'))
                           <div class="alert alert-success" role="alert">
                              {{ Session::get('message') }}
                          </div>
                      @endif
    
                        <form action="{{ route('forget.password.post') }}" method="POST">
                           @csrf
                           <div class="row">
                            <div class="col-md-10">
                                <div class="mb-3 ml-5 ">
                                <label for="name" class="form-label">E-Mail Address</label>
                                    <input type="text" id="email_address" class="form-control" name="email">
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="text-center">
                                    <button type="submit" class="btn donate-bt bt-sm">Send Reset Link</button>
                                    <hr>    
                                </div>
                            </div>

                            </div>
                        </form>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

