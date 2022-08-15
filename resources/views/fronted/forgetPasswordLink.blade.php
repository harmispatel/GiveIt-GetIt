@include('fronted.css')

@section('title', 'Give It & Get It - Reset password')

@section('content')
<body>
    @if (session()->has('error'))
        <div class="alert alert-success error">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="donation-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="donate-form">
                        <div class="form-title text-center">


                            <h3>Reset Password</h3>
                            <hr>
                            <form action="{{ route('reset.password.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                        <input type="password"   class="form-control" name="password">
                                        <i class="bi bi-eye-slash eye_ic" id="togglePassword"></i>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-9">
                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">Confirm Password</label>
                                    
                                        <input type="password"   class="form-control" name="password_confirmation">
                                        <i class="bi bi-eye-slash eye_ic" id="toggleCPassword"></i>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                </div>
                            
                                <div class="col-md-11">
                                    <div class="text-center">
                                    <button type="submit" class="btn donate-bt bt-sm">
                                        Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                       
                    </div>
                    
        
                </div>
            </div>
        </div>
    </div>
    @include('fronted.js')
    <script>
        setTimeout(() => {
                    $('.error').remove( );
                }, 3500);
    </script>

</body>









{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <title>Reset password</title>
</head>
<body>
    

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
    
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
  

</body>
</html> --}}