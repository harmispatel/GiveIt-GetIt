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
    
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card align-center mt-5">
                    <div class="card-header">
                      Login backed
                    </div>
                    <div class="card-body">
                        <form action="{{route('login')}}" method="POST" >
                            @csrf
                            
                              <div class="form-group">
                                <input type="email" name="email" class="form-control"  placeholder="Enter email">
                                @if ($errors->has('email'))
                                  <p class="alert alert-danger">{{$errors->first('email')}}</p>                                    
                                @endif
                              </div>
              
                              <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                @if ($errors->has('password'))
                                  <p class="alert alert-danger">{{$errors->first('password')}}</p>                                    
                                @endif
                              </div>
                             
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <hr>                            
                            <div>
                              <p>You Don't Have An Account ? <a href="registration">Register Now</a></p>
                            </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

</body>

</html>