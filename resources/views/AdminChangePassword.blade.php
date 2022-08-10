@extends('common.layout')

@section('title', 'Profile Page')

@section('content')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        
          <div class="row">
              <div class="col">
                  <div class="card align-center mt-5">
                      <div class="card-header">
                        Create new Password
                      </div>
                      <div class="card-body">
                          <form action="{{route('adminProfile.update',auth()->user()->id)}}" method="POST" >
                              @csrf
                              {{ method_field('PUT') }}

                                <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" name="password" class="form-control"  placeholder="Enter password" value="{{old('password')}}">
                                    @if ($errors->has('password'))
                                      <p class="alert alert-danger">{{$errors->first('password')}}</p>                                    
                                    @endif
                                </div>
                              
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" name="confirmPassword" class="form-control"  placeholder="Enter password" value="{{old('confirmPassword')}}">
                                      @if ($errors->has('confirmPassword'))
                                        <p class="alert alert-danger">{{$errors->first('confirmPassword')}}</p>                                    
                                      @endif
                                  </div>

                                <button type="submit" name="submit" class="btn btn-primary"> Change Password </button>
                                <a class="btn btn-dark" href="{{route('adminProfile.index')}}"> Back </a>
                              </form>
                              <hr>                            
                           
                    </div>
              </div>
          </div>
      </div>
    </section>
  </div>

@endsection