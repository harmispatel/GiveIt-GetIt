@extends('common.layout')

@section('title', 'Add Category')

@section('content')

<div class="content-wrapper">
  <section class="content">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card align-center mt-5">
                    <div class="card-header">
                      Add Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.store')}}" method="POST" >
                            @csrf
                            
                              <div class="form-group">
                                <label for="categoryName">CategoryName</label>
                                <input type="text" name="categoryName" class="form-control"  placeholder="Add category name" value="{{old('categoryName')}}">
                                  @if ($errors->has('categoryName'))
                                    <p class="alert alert-danger">{{$errors->first('categoryName')}}</p>                                    
                                  @endif
                              </div>
                              
                              <div class="form-group"><b> Status : </b>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" >
                                  <label class="form-check-label" for="inlineRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                  <label class="form-check-label" for="inlineRadio2">In Active</label>
                                </div> 
                              </div>

                              {{-- <div class="form-group">
                                <input type="text" name="categoryStatus" class="form-control" placeholder=" Add status" value="{{old('categoryStatus')}}">
                                @if ($errors->has('status'))
                                  <p class="alert alert-danger">{{$errors->first('status')}}</p>                                    
                                @endif
                              </div> --}}
                            
                              <button type="submit" name="submit" class="btn btn-primary">  Add </button>
                              <a class="btn btn-dark" href="{{route('category.index')}}"> Back </a>
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