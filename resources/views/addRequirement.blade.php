@extends('common.layout')

@section('title', 'Welcome Page')

@section('content')

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- summer note --}}
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
    {{-- End Summer note --}}

  </head>
    <body>
  
      <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col">
                <div class="card align-center mt-5">
                  <div class="card-header">
                    Add Requirement
                  </div>
                  <div class="card-body">
                    <form action="{{route('requirement.store')}}" method="POST" enctype="multipart/form-data" >
                      @csrf

                      {{-- Media --}}
                      <div class="form-group">
                        <label for="media">Media</label>
                        <input type="file" name="media" class="form-control" value="{{old('media')}}">
                          @if ($errors->has('media'))
                            <p class="alert alert-danger">{{$errors->first('media')}}</p>                                    
                          @endif
                      </div>  
                      
                      {{-- Category --}}
                      <div class="form-group">
                        <label for="category_id">Category</label>
                          <select class="form-control form-control-md" name="category_id" value="{{old('category_id')}}" id="category" onchange="OtherData()">
                              @foreach ($categoryId as $categoryValue)
                                <option value="{{$categoryValue->id}}">{{$categoryValue->name}}</option> 
                              @endforeach
                              <option value="0" class="bg-dark">Others</option> 
                          </select>
                      </div>
                                  
                      {{-- Add new Category --}}
                      <div id="addcatgory" style="display: none">
                        <input type="text" class="form-control" name="Addcategory" placeholder="Enter Category Name">                  
                          @if ($errors->has('Addcategory'))
                            <span class="text-danger">{{ $errors->first('Addcategory') }}</span>
                          @endif
                      </div>

                      {{-- Requirement --}}
                      <div class="form-group purple-border">
                        <label for="address">Requirement</label>
                          <textarea class="ckeditor form-control" name="requirement" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Requirement" value="{{old('requirement')}}"></textarea>
                      </div>
                                  
                      {{-- Person --}}
                      <div class="form-group">
                        <label for="quantity">Person</label>
                          <input type="text" name="quantity" class="form-control" placeholder=" Add quantity" value="{{old('quantity')}}">
                            @if ($errors->has('quantity'))
                              <p class="alert alert-danger">{{$errors->first('quantity')}}</p>                                    
                            @endif
                      </div>  

                      {{-- Type --}}
                      <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control form-control-md" name="type" value="{{old('type')}}">
                          <option value="#">Select Type</option>
                          <option value="0">Getit</option>
                          <option value="1">Giveit</option>    
                        </select>
                      </div>

                      {{-- Status --}}
                        <div class="form-group"><b> Status : </b>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">
                              <label class="form-check-label" for="inlineRadio1">Completed</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                              <label class="form-check-label" for="inlineRadio2">Pending</label>
                          </div>
                        </div>

                      {{-- Is Active? --}}
                      <div class="form-group">
                        <label for="is_active">Is Active</label>
                          <select name="is_active" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                      </div>
                              
                      <button type="submit" class="btn btn-primary">  Add </button>
                      <a class="btn btn-dark" href="{{route('requirement.index')}}"> Back </a>
                    </form>
                    <hr>                                                       
                  </div>
                </div>
              </div>
            </div>
        </section>
      </div>
      
      <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
      <script type="text/javascript">
          $(document).ready(function() {

            $('.ckeditor').ckeditor();

          });
      </script>

            {{-- Open Other Category Input Field --}}
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script>
              function OtherData() {
                  var selectVal = $('#category').val();
                  alert(selectVal);
                  if (selectVal == 0) {
                      $("#addcatgory").show().css('margin-bottom',10);
                  } else {
                      $("#addcatgory").hide();
                  }
              }
            </script>

  
    </body>
  </html>
@endsection