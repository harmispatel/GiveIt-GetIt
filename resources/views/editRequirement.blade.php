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
</head>
<body>
  
  <div class="content-wrapper">
    <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col">
                      <div class="card align-center mt-5">
                          <div class="card-header">
                            Edit Requirement
                          </div>
                          <div class="card-body">
                              <form action="{{route('requirement.update',$editRequirementData->id)}}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')

                                  <div class="form-group">
                                    <label for="media">Media</label>
                                      <input type="file" name="media" class="form-control" value="{{$editRequirementData->media_id}}">
                                      <img src="{{ $editRequirementData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($editRequirementData->media['path']) }}" alt="Image" width="100">
                                      @if ($errors->has('media'))
                                        <p class="alert alert-danger">{{$errors->first('media')}}</p>                                    
                                      @endif
                                  </div> 

                                    {{-- <div class="form-group">
                                      <label for="quantity">Media</label>
                                        <input type="file" name="media" class="form-control"  value="{{$editRequirementData->media_id}}">
                                        @if ($errors->has('media'))
                                          <p class="alert alert-danger">{{$errors->first('media')}}</p>                                    
                                        @endif
                                    </div> --}}
                                    <div class="form-group">
                                    <label for="requirementCategory">RequirementCategory</label>
                                      <select class="form-control form-control-md" name="requirementCategory" >
                                        <option value="">Select Category</option>
                                          @foreach ($categoryId as $editRequirements)
                                            <option value="{{$editRequirements->id}}" {{($editRequirements->id == $editRequirementData->category_id) ? 'selected' : ''}}>{{$editRequirements->name}}</option> 
                                          @endforeach 
                                      </select>
                                    </div>
  
                                    <div class="form-group purple-border">
                                      <label for="address">Requirement</label>
                                          <textarea class="ckeditor form-control" name="requirement" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Requirement" value="{{old('requirement')}}">{{$editRequirementData->requirements}}</textarea>
                                      </div>
                                    
                                    <div class="form-group">
                                    <label for="quantity">Person</label>
                                      <input type="text" name="quantity" class="form-control" placeholder=" Add quantity" value="{{$editRequirementData->quantity}}">
                                      @if ($errors->has('quantity'))
                                        <p class="alert alert-danger">{{$errors->first('quantity')}}</p>                                    
                                      @endif
                                    </div>
  
                                    <div class="form-group">
                                    <label for="type">Type</label>
                                      <select class="form-control form-control-md" name="type" value="{{old('type')}}" >
                                        <option value="#">Select Type</option>
                                        <option value="0" {{ $editRequirementData->is_active == 0 ? 'selected' : '' }}>Getit</option>
                                        <option value="1" {{ $editRequirementData->is_active == 1 ? 'selected' : '' }}>Giveit</option>    
                                      </select>
                                    </div>
  
                                    <div class="form-check form-check-inline"><b> Status: </b>
                                      <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ $editRequirementData->status == '1' ? 'checked' : ''}}>
                                      <label class="form-check-label" for="inlineRadio1">Completed</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ $editRequirementData->status == '0' ? 'checked' : ''}}>
                                      <label class="form-check-label" for="inlineRadio2">Pending</label>
                                  </div><br><br>
  
                                  <div class="form-group">
                                      <label for="is_active">Is Active</label>
                                      <select name="is_active" id="is_active" class="form-control" value="{{$editRequirementData->is_active}}">
                                          <option value="1" {{ $editRequirementData->is_active == 1 ? 'selected' : '' }}>Active</option>
                                          <option value="0" {{ $editRequirementData->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                      </select>
                                  </div>
  
                                    <button type="submit" name="submit" class="btn btn-primary">  Update </button>
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
</body>
</html>
@endsection