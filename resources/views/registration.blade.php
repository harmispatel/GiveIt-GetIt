<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
      .card{
        width: 50%;
      }
    </style>
</head>
<body>
  <div class="content-wrapper">
    <section class="content">   
    
        <div class="container-fluid">
            <div class="row">
                    <!-- Success Message -->
                    {{-- @if (session('success'))
                        <div class="d-flex justify-content-end">
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if (session('error'))
                        <div class="d-flex justify-content-end">
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif --}}
                <div class="col">
                    <div class="card align-center mt-5">
                        <div class="card-header">
                        Registration
                        </div>
                        <div class="card-body">
                            <form action="{{route('registration')}}" method="POST" id="register">
                                @csrf

                                <div class="form-group">
                                <label for="name">name</label>
                                    <input type="text" name="name" class="form-control"  placeholder="Enter name" value="{{old('name')}}">
                                        @if ($errors->has('name'))
                                            <p class="alert alert-danger">{{$errors->first('name')}}</p>                                    
                                        @endif
                                </div> 

                                <div class="form-group">
                                <label for="email">email</label>
                                    <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{old('email')}}">
                                        @if ($errors->has('email'))
                                            <p class="alert alert-danger">{{$errors->first('email')}}</p>                                    
                                        @endif
                                </div>

                                <div class="form-group">
                                <label for="mobile">mobile</label>
                                    <input type="text" name="mobile" class="form-control"  placeholder="Enter mobile" value="{{old('mobile')}}">
                                        @if ($errors->has('mobile'))
                                            <p class="alert alert-danger">{{$errors->first('mobile')}}</p>                                    
                                        @endif
                                </div>
                                
                                <div class="form-group purple-border">
                                <label for="address">address</label>
                                    <textarea class="form-control" name="address" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Address" value="{{old('address')}}"></textarea>
                                    @if ($errors->has('address'))
                                            <p class="alert alert-danger">{{$errors->first('address')}}</p>                                    
                                    @endif
                                </div>

                                {{-- <div class="form-group">
                                    <input type="text" name="address" class="form-control"  placeholder="Enter address">
                                        @if ($errors->has('address'))
                                            <p class="alert alert-danger">{{$errors->first('address')}}</p>                                    
                                        @endif
                                </div> --}}

                                <div class="form-group">
                                <label for="user_type">user_type</label>
                                    <select class="form-control form-control-md" name="user_type" value="{{old('user_type')}}">
                                        <option value="#">Select User</option>
                                        <option value="1">Trust</option>
                                        <option value="2">Donor</option>   
                                        <option value="3">Admin</option>   

                                    </select>
                                </div>

                                <div class="form-group">
                                <label for="password">password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                                        @if ($errors->has('password'))
                                            <p class="alert alert-danger">{{$errors->first('password')}}</p>                                    
                                        @endif
                                </div>
                                
                                <div class="form-check form-check-inline"><b> Status: </b>
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ (old('status') == '') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">In Active</label>
                                </div>
                                <hr>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-dark" href="{{route('user.index')}}"> Back </a>

                                </form>
                                <hr>                            
                                <div>
                                <p>If You Have An Account ? <a href="login">Login Now</a></p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    {{-- <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <script type="text/javascript">
      $("#password").password('toggle');
    </script> --}}


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script async src="https://docs.opencv.org/master/opencv.js" type="text/javascript"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script>
        $(document).readty(function(){
            setTimeout(() => {
                $('.alert').hide()
            }, 3000);
        });

        $('#register').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                address: {
                    required: true
                },
                user_type: {
                    required: true
                },
                password: {
                    required: true
                },
                status: {
                    required: true
                }

            },
            messages: {
                name: {
                    required: "Name is required."
                    
                },
                email: {
                    required: "Email is required.",
                    email: "Please Enter a valid email."
                },
                mobile: {
                    required: "Mobile no. is required."
                    minlength: 10,
                    maxlength: 10,
                    number: "Mobile No. is not valid."
                },
                address: {
                    required: "Address is required.";
                    address: "Please Enter a valid address."

                },
                user_type: {
                    required: "User type is required.",
                    user_type: "Please Enter a valid user type."
                },
                password: {
                    required: "Password is required."
                },
                status: {
                    required: "Status is required."
                }
            }
        })
    </script>
</body>
</html>
