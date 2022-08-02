@extends('common.layout')

@section('title', 'Welcome Page')

@section('content')

<div class="content-wrapper">
    <section class="content">
    
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card align-center mt-5">
                        <div class="card-header">
                        Create User
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.store')}}" method="POST" >
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
                                {{-- <div>
                                <p>You Don't Have An Account ? <a href="registration">Register Now</a></p>
                                </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection