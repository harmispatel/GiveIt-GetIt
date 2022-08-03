@extends('common.layout')

@section('title', 'Edit Category Page')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card align-center mt-5">
                    <div class="card-header">
                      Edit Category
                    </div>
                    <div class="card-body">
                        <form action="{{route('category.update',$editCategoryData->id)}}" method="POST" >
                            @csrf
                            @method('PUT')

                              {{-- <div class="form-group">
                                <option value="#">Select Category</option>      
                                  <select class="form-control form-control-md" name="categoryName">
                                     @foreach ($category as $categoryValue)                                    
                                        <option value="{{ $categoryValue->id }}" {{($categoryValue->id == $editCategoryData->id) ? 'selected' : ''}}>{{ $categoryValue->name }}</option> 
                                    @endforeach
                                    @if ($errors->has('categoryName'))
                                        <p class="alert alert-danger">{{$errors->first('categoryName')}}</p>                                    
                                    @endif 
                                  </select>
                              </div> --}}

                              <div class="form-group">
                                <label for="categoryName">categoryName</label>
                                <input type="text" name="categoryName" class="form-control"  placeholder="Enter category" value="{{$editCategoryData->name}}">
                                @if ($errors->has('categoryName'))
                                  <p class="alert alert-danger">{{$errors->first('categoryName')}}</p>                                    
                                @endif
                              </div>

                              <div class="form-group"><b> Status : </b>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ $editCategoryData->status == '1' ? 'checked' : ''}}>
                                  <label class="form-check-label" for="inlineRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ $editCategoryData->status == '0' ? 'checked' : ''}}>
                                  <label class="form-check-label" for="inlineRadio2">In Active</label>
                                </div> 
                              </div>
              
                              {{-- <div class="form-group">
                                <input type="text" name="status" class="form-control" placeholder="Status" value="{{$editCategoryData->status == 1 ? 'Active' : 'In Active'}}">
                                @if ($errors->has('status'))
                                  <p class="alert alert-danger">{{$errors->first('status')}}</p>                                
                                @endif
                              </div> --}}
                             
                              <button type="submit" name="submit" class="btn btn-primary">Update</button>
                              <a class="btn btn-dark" href="{{route('category.index')}}"> Back </a>

                            </form>
                            <hr>                            
                           
                  </div>
            </div>
        </div>
    </div>
  </section>
</div>

@endsection