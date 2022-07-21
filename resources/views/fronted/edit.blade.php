<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <title>EditRequirement</title>

    <style>
        select.form-control{
            height:34px !important;
        }
    </style>
    <script type="text/javascript">
        function OtherData() {
            var selectVal = $('#category').val();
                   
            if (selectVal == 0) {
                $("#addcatgory").show();
            } else {
                $("#addcatgory").hide();
            }
        }
    </script>
</head>
<body>
    <div class="content-wrapper">
        <section class="content py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                       
                        <div class="card card-primary my-4">
                            <div class="card-header d-flex justify-content-between ">
                                <h3 class="card-title">Update Requirement</h3>
                                <div class="text-right">
                                     <form method="POST" action="{{route('userlogout') }}">
                                        @csrf
                                    <button type="submit" class="btn btn-dark" name="submit">Logout</button>
                                </form> 
                                </div>
                            </div>
                            <form action="{{route('update', $RequiredData['id'])}}" id="quickForm" method="POST">
                                @csrf
                             
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Category">Category</label>
                                        <select class="form-control" name="category" id="category" onchange="OtherData()">
                                            @foreach ($categoryId as $item)
                                            <option value="{{$item->id}} " {{ ($item->id == $RequiredData->category_id) ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach 
                                        <option value="0">Others</option>
                                        </select>
                                       <div id ="addcatgory" style="display: none;margin-top:10px;">
                                            <input type="text" class="form-control" name="Addcategory" placeholder="Enter Category Name"> 
                                        </div> 
                                        @if ($errors->has('Addcategory'))
                                        <span class="text-danger">{{ $errors->first('Addcategory') }}</span>
                                    @endif
                                   
                                    </div>
                                </div>
                                <div class="card-body">
                                <div class="form-group">
                                    <label for="Person">Person</label>
                                    <input type="number" name="quantity" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" placeholder="Enter Person" value="{{$RequiredData->quantity}}">
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Requirement">Requirement</label>
                                    <div class="mb-3">
                                    <textarea name="requirement" class="ckeditor form-control {{ $errors->has('requirement') ? 'is-invalid' : '' }}" rows="3" placeholder="Enter requirement">{{$RequiredData->requirements}}</textarea>
                                    </div>
                                    @if ($errors->has('requirement'))
                                        <span class="text-danger">{{ $errors->first('requirement') }}</span>
                                    @endif
                                </div>
                            </div>
                          
                                
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                        <select class="form-control" name="status">
                                           
                                            
                                            <option value="1"{{$RequiredData->status== 1 ? 'selected' : ''}}>Pending</option>
                                            <option value="2"{{$RequiredData->status == 2 ? 'selected' : ''}}>Completed</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="card-body">
                                <div class="form-group">
                                     
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" {{$RequiredData->is_active== 1 ? 'checked' : ''}} >
                                        <label class="form-check-label" for="Active">Active</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2" {{$RequiredData->is_active== 2 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="Inactive">Inactive</label>
                                      </div>
                                
                                </div>
                            </div> --}}
                                </div>
                                <div class="text-right">
                                    <a href="{{route('required')}}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
    </div>
    
</body>
</html>