@extends('common.layout')

@section('title', 'Edit User')

@section('content')

<div class="content-wrapper">
  <section class="content">
  
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card align-center mt-5">
                    <div class="card-header">
                      Edit User
                    </div>
                    <div class="card-body">
                      <form action="{{route('user.update',$edituser->id)}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                          <label for="name">name</label>
                          <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter name" value="{{$edituser->name}}">
                              @if ($errors->has('name'))
                                  <p class="alert alert-danger">{{$errors->first('name')}}</p>                                    
                              @endif
                        </div>
                        
                        <div class="form-group">
                          <label for="email">email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{$edituser->email}}">
                                @if ($errors->has('email'))
                                    <p class="alert alert-danger">{{$errors->first('email')}}</p>                                    
                                @endif
                        </div>
          
                        <div class="form-group">
                          <label for="mobile">mobile</label>
                          <input type="text" name="mobile" class="form-control" id="exampleInputMobile" placeholder="Enter mobile" value="{{$edituser->mobile}}">
                              @if ($errors->has('mobile'))
                                  <p class="alert alert-danger">{{$errors->first('mobile')}}</p>                                    
                              @endif
                        </div>
                        
                        <div class="form-group purple-border">
                          <label for="address">address</label>
                          <textarea class="form-control" name="address" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Address">{{$edituser->address}}</textarea>
                              @if ($errors->has('address'))
                                  <p class="alert alert-danger">{{$errors->first('address')}}</p>                                    
                              @endif
                      </div>
                        {{-- <div class="form-group">
                            <input type="text" name="address" class="form-control" id="exampleInputAddress" placeholder="Enter address" value="{{$edituser->address}}">
                        </div> --}}

                        {{-- <div class="form-group">
                            <input type="text" name="user_type" class="form-control" id="exampleInputUser_type" placeholder="Enter user_type" value="{{$edituser->user_type == 1 ? 'Trust' : 'Donor'}}">
                                @if ($errors->has('user_type'))
                                    <p class="alert alert-danger">{{$errors->first('user_type')}}</p>                                    
                                @endif
                        </div> --}}


                          {{-- <div class="form-group">
                            <input type="text" name="status" class="form-control" id="exampleInputStatus" placeholder="Status" value="{{$edituser->status == 1 ? 'Active' : 'In Active'}}">
                                @if ($errors->has('status'))
                                    <p class="alert alert-danger">{{$errors->first('status')}}</p>                                    
                                @endif
                          </div> --}}
          
                          <div class="form-group">
                          <label for="user_type ">user_type</label>
                            <select class="form-control form-control-md" name="user_type" >
                              <option value="#">Select Role</option>
                              <option value="1" {{ $edituser->user_type == 1 ? 'selected' : '' }}>Trust</option>
                              <option value="2" {{ $edituser->user_type == 2 ? 'selected' : '' }}>Donor</option>
                              <option value="3" {{ $edituser->user_type == 3 ? 'selected' : '' }}>Admin</option>
                            </select>
                          </div>

                          <div class="form-check form-check-inline"><b> Status: </b>
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ $edituser->status == '1' ? 'checked' : ''}}>
                            <label class="form-check-label" for="inlineRadio1">Active</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ $edituser->status == '0' ? 'checked' : ''}}>
                            <label class="form-check-label" for="inlineRadio2">In Active</label>
                          </div>
                          <hr>
                         
                          <button type="submit" name="sumbit" value="submit" class="btn btn-primary">Submit</button>
                          <a class="btn btn-dark" href="{{route('user.index')}}"> Back </a>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </section>
</div>

@endsection
