<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
    <style>
      .body{
      
      }
      
    </style>
</head>
<body>
  @if(session()->has('msg'))
    <div class="alert alert-success">
        {{ session()->get('msg') }}
    </div>
@endif
@if(session()->has('loginwrong'))
<div class="alert alert-danger">
    {{ session()->get('loginwrong') }}
</div>
@endif
@if(session()->has('logout'))
<div class="alert alert-warning">
    {{ session()->get('logout') }}
</div>
@endif
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                      Login fronted
                    </div>
                    <div class="card-body">
                      
                        <form action="{{route('useget')}}" method="POST" >
                          
                            @csrf
                            
                              <div class="form-group">
                                <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{old('email')}}">
                                @if ($errors->has('email'))
                                  <p class="alert alert-danger">{{$errors->first('email')}}</p>                                    
                                @endif
                              </div>
              
                              <div class="form-group">
                                <input type="password" name="password" class="form-control" data-toggle="password" placeholder="Password" value="{{old('password')}}">
                                @if ($errors->has('password'))
                                  <p class="alert alert-danger">{{$errors->first('password')}}</p>                                    
                                @endif
                              </div>
                              <div class="form-group text-right">
                                <a href="{{ route('forget.password.get') }}">Forgot your password?</a>

                              </div>
                             
                              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                              <hr>                            
                              <div>
                                <p>You Don't Have An Account ? <a href="{{route('register')}}">Register Now</a></p>
                              </div>
                      </div>
                            </form>
                    </div>
                  </div>
            </div>
            <script type="text/javascript">
              $("#password").password('toggle');
            </script>
        </div>
    </div>

</body>
</html>