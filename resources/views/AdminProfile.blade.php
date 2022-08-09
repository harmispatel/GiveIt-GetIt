@extends('common.layout')

@section('title', 'Profile Page')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card align-center mt-5">
                            <div class="card-header">
                            My Profile
                            </div>
                            <div class="card-body">
                                <form action="{{route('adminProfile.update',auth()->user()->id)}}" method="POST" >
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                    <label for="username">name</label>
                                        <input type="text" name="username" class="form-control"  placeholder="Enter name" value="{{old('username')}} {{ auth()->user()->name }}">
                                        {{-- @if(auth()->user()->name)
                                            {{ auth()->user()->name }}
                                        @endif  --}}
                                            @if ($errors->has('username'))
                                                <p class="alert alert-danger">{{$errors->first('username')}}</p>                                    
                                            @endif
                                    </div> 

                                    <div class="form-group">
                                    <label for="email">email</label>
                                        <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{old('email')}} {{ auth()->user()->email }}">
                                            @if ($errors->has('email'))
                                                <p class="alert alert-danger">{{$errors->first('email')}}</p>                                    
                                            @endif
                                    </div>

                                    <div class="form-group">
                                    <label for="number">mobile</label>
                                        <input type="text" name="number" class="form-control"  placeholder="Enter mobile" value="{{old('number')}} {{ auth()->user()->mobile }}">
                                            @if ($errors->has('number'))
                                                <p class="alert alert-danger">{{$errors->first('number')}}</p>                                    
                                            @endif
                                    </div>
                                    
                                    <div class="form-group purple-border">
                                    <label for="address">address</label>
                                        <textarea class="form-control" name="address" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Address" value="{{old('address')}} ">{{ auth()->user()->address }}</textarea>
                                    </div>
                                    <hr>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                    {{-- <a class="btn btn-primary" href="{{route('adminProfile.')}}">Change Password</a> --}}
                                    <i class="btn btn-primary changeBtn" data-toggle="modal" style="cursor: pointer;" data-target="#exampleModal" title="Change Password">Change Password</i>
                                    <a class="btn btn-dark" href="{{route('user.index')}}" > Back </a>

                                    </form>
                                    <hr> 

                                    
                                    {{-- model --}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel" >Change Password</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('adminProfile.update',auth()->user()->id)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div>
                                                            <label for="password">Password</label>
                                                            <input type="password" name="password" value="{{auth()->user()->password}}">
                                                        </div>
                                                        <br>
                                                        <div>
                                                            <label for="confirmPassword">Confirm Password</label>
                                                            <input type="password" name="confirmPassword" value="">
                                                        </div>
                                                        <br>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-danger" type="submit">Change Password</button>
                                                    </form>
                                                    
                                                    {{-- @if(auth()->user()->name)
                                                        {{ auth()->user()->password }}
                                                    @endif --}}
                                                </div>
                                                
                                                    
                                                    {{-- <form action="" id="changePassword" method="POST" class="d-inline">  
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        
                                                            
                                                    </form> --}}
                                               

                                            </div>
                                        </div>
                                    </div>
                                    {{--End model --}}                           
                                
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(function(){
                    $('.changeBtn').click(function() {
                        var url = $(this).attr("data-target-id")
                        $("#changePassword").attr('action', url);
                    });
                });
            </script>
    </div>

@endsection