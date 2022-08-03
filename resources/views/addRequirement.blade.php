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

                                <div class="form-group">
                                  <label for="media">Media</label>
                                    <input type="file" name="media" class="form-control" value="{{old('media')}}">
                                    @if ($errors->has('media'))
                                      <p class="alert alert-danger">{{$errors->first('media')}}</p>                                    
                                    @endif
                                </div>  
                                
                                <div class="form-group">
                                  <label for="category_id">Category</label>
                                  <select class="form-control form-control-md" name="category_id" value="{{old('category_id')}}">
                                    <option value="#">Select Category</option>
                                      @foreach ($categoryId as $categoryValue)
                                        <option value="{{$categoryValue->id}}">{{$categoryValue->name}}</option> 
                                      @endforeach
                                      <option value="#">Others</option> 
                                  </select>
                                </div>
                                 
                                <div class="form-group purple-border">
                                  <label for="address">Requirement</label>
                                      <textarea class="ckeditor form-control" name="requirement" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Requirement" value="{{old('requirement')}}"></textarea>
                                  </div>

                                {{-- <div class="form-group">
                                  <label for="requirement">Requirement</label>
                                  <input id="requireSummer" type="text" name="requirement" class="form-control" placeholder=" Add requirement" value="{{old('requirement')}}">
                                  @if ($errors->has('requirement'))
                                    <p class="alert alert-danger">{{$errors->first('requirement')}}</p>                                    
                                  @endif
                              </div> --}}

                                <div class="form-group">
                                  <label for="quantity">Person</label>
                                    <input type="text" name="quantity" class="form-control" placeholder=" Add quantity" value="{{old('quantity')}}">
                                    @if ($errors->has('quantity'))
                                      <p class="alert alert-danger">{{$errors->first('quantity')}}</p>                                    
                                    @endif
                                </div>  

                                <div class="form-group">
                                  <label for="type">Type</label>
                                  <select class="form-control form-control-md" name="type" value="{{old('type')}}">
                                    <option value="#">Select Type</option>
                                    <option value="0">Getit</option>
                                    <option value="1">Giveit</option>    
                                  </select>
                                </div>

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

                                {{-- <div class="form-group">
                                    <input type="text" name="status" class="form-control" placeholder=" Add status" value="{{old('status')}}">
                                    @if ($errors->has('status'))
                                      <p class="alert alert-danger">{{$errors->first('status')}}</p>                                    
                                    @endif
                                </div> --}}

                                <div class="form-group">
                                  <label for="is_active">Is Active</label>
                                  <select name="is_active" id="status" class="form-control">
                                      <option value="1">Active</option>
                                      <option value="0">Inactive</option>
                                  </select>
                              </div>

                                {{-- <div class="form-group">
                                    <input type="text" name="is_active" class="form-control" placeholder=" Add is_active" value="{{old('is_active')}}">
                                    @if ($errors->has('is_active'))
                                      <p class="alert alert-danger">{{$errors->first('is_active')}}</p>                                    
                                    @endif
                                </div> --}}
                                  

                                 
                                  <button type="submit" name="submit" class="btn btn-primary">  Add </button>
                                  <a class="btn btn-dark" href="{{route('requirement.index')}}"> Back </a>

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
    
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

       $('.ckeditor').ckeditor();

    });
</script>

  
</body>
</html>
@endsection