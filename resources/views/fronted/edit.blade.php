<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <title>EditRequirement</title>
</head>
<body>
    <div class="content-wrapper">
        <section class="content py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                       
                        <div class="card card-primary my-4">
                            <div class="card-header">
                                <h3 class="card-title text-center">Update Requirement</h3>
                            </div>
                            <form action="{{route('update', $RequiredData['id'])}}" id="quickForm" method="POST">
                                @csrf
                             
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Category">Category</label>
                                        <select class="form-control" name="category">
                                            @foreach ($categoryId as $item)
                                            <option value="{{$item->id}} " {{ ($item->id == $RequiredData->category_id) ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach 
                                        </select>
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
                                    <textarea name="requirement" class="form-control {{ $errors->has('requirement') ? 'is-invalid' : '' }}" rows="3" placeholder="Enter requirement">{{$RequiredData->requirements}}</textarea>
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
                                            {{-- @if({{($RequiredData->status) ? 'selected' : ''}}) --}}
                                            
                                            <option value="1"{{$RequiredData->status== 1 ? 'selected' : ''}}>Pending</option>
                                            <option value="2"{{$RequiredData->status == 2 ? 'selected' : ''}}>Complete</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                <div class="form-group">
                                     
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" {{$RequiredData->is_active== 1 ? 'checked' : ''}} >
                                        <label class="form-check-label" for="Active">Active</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2" {{$RequiredData->is_active== 2 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="InActive">InActive</label>
                                      </div>
                                
                                </div>
                            </div>
                                </div>
                                <div class="text-right">
                                    <a href="{{route('require')}}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
</body>
</html>