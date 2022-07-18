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
                        {{-- {{route('login')}} --}}
                        {{-- {{route('useget')}} --}}
                        <form action="{{route('useget')}}" method="POST" >
                          
                            @csrf
                            
                              <div class="form-group">
                                <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{old('email')}}">
                                @if ($errors->has('email'))
                                  <p class="alert alert-danger">{{$errors->first('email')}}</p>                                    
                                @endif
                              </div>
              
                              <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                                @if ($errors->has('password'))
                                  <p class="alert alert-danger">{{$errors->first('password')}}</p>                                    
                                @endif
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
        </div>
    </div>

</body>
</html>