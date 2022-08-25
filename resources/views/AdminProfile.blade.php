@extends('common.layout')

@section('title', 'Profile Page')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            {{-- Success messege --}}
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            {{-- End Success messege --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card align-center mt-5">
                            <div class="card-header">
                            My Profile
                            </div>
                            <div class="card-body">
                                <form action="{{route('adminProfile.update', auth()->user()->id)}}" method="POST" >
                                    @csrf 
                                    @method('PUT')

                                    <div class="form-group">
                                    <label for="username">name</label>
                                        <input type="text" name="username" class="form-control"  placeholder="Enter name" value="{{ auth()->user()->name }}">
                                        {{-- @if(auth()->user()->name)
                                            {{ auth()->user()->name }}
                                        @endif  --}}
                                            @if ($errors->has('username'))
                                                <p class="alert alert-danger">{{$errors->first('username')}}</p>                                    
                                            @endif
                                    </div> 

                                    <div class="form-group">
                                    <label for="email">email</label>
                                        <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{ auth()->user()->email }}">
                                            @if ($errors->has('email'))
                                                <p class="alert alert-danger">{{$errors->first('email')}}</p>                                    
                                            @endif
                                    </div>

                                    <div class="form-group">
                                    <label for="number">mobile</label>
                                        <input type="text" name="number" class="form-control"  placeholder="Enter mobile" value="{{ auth()->user()->mobile }}">
                                            @if ($errors->has('number'))
                                                <p class="alert alert-danger">{{$errors->first('number')}}</p>                                    
                                            @endif
                                    </div>
                                    
                                    <div class="form-group purple-border">
                                    <label for="address">address</label>
                                        <textarea class="form-control" name="address" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Address" >{{ auth()->user()->address }}</textarea>
                                    </div>
                                    <hr>

                                    

                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a class="btn btn-primary changePwd" >Update Password</a>
                                    <a class="btn btn-dark" href="{{'home'}}" > Back </a>

                                </form>
                                <hr>
                                <div class="form-group changePassword" style="display: none">
                                    <form action="{{route('adminProfile.update', auth()->user()->id)}}" method="POST">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="password" class="mt-2">Password</label>
                                                    <input type="password" name="password" id="pwd" class="form-control"  placeholder="Enter password">
                                                        @if ($errors->has('password'))
                                                            <p class="alert alert-danger">{{$errors->first('password')}}</p>                                    
                                                        @endif
                                                </div>
                                                <div class="col-lg-6">   
                                                    <label for="confirmPassword" class="mt-2">Confirm Password</label>
                                                    <input type="password" name="confirmPassword" id="pwd" class="form-control"  placeholder="Enter confirm password">
                                                        @if ($errors->has('password'))
                                                            <p class="alert alert-danger">{{$errors->first('password')}}</p>                                    
                                                        @endif
                                                    </div>
                                                <button class="btn btn-primary mt-3 mb-3" type="submit" value="submit">Change Password</button> 
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>                          
                                
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.changePwd').click(function(){
                $('.changePassword').toggle();
            });
        });
    </script>



  {{-- <a class="btn btn-primary changePwd" href="{{route('adminProfile.create')}}">Change Password</a>  --}}