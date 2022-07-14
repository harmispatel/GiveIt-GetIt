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
    <title>Requirement</title>
</head>
<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary my-4">
                            <div class="card-header">
                                <h3 class="card-title">Add Requirement</h3>
                            </div>
                            <form action="{{route('insertdata')}}" id="quickForm" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputStatus">Category</label>
                                        <select class="form-control" name="category">
                                            @foreach ($categoryId as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Quantity</label>
                                    <input type="number" name="quantity" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" placeholder="Enter Quantity">
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail">Requirement</label>
                                    <input type="text" name="requirement" class="form-control {{ $errors->has('requirement') ? 'is-invalid' : '' }}" placeholder="Enter requirement">
                                    @if ($errors->has('requirement'))
                                        <span class="text-danger">{{ $errors->first('requirement') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputGender">Role_Type</label>
                                    <div class="form-check">
                                        <label class="form-check-label" for="radio1">
                                        <input type="radio" class="form-check-input {{ $errors->has('type') ? 'is-invalid' : '' }}" id="radio1" name="gender" value="Female"> Giveit <br>
                                        <input type="radio" class="form-check-input {{ $errors->has('type') ? 'is-invalid' : '' }}" id="radio1" name="gender" value="Male">Getit
                                        </label><br>
                                    </div>
                                        @if ($errors->has('type'))
                                            <span class="text-danger">{{ $errors->first('type') }}</span>
                                        @endif
                                </div>
                            </div> --}}
                            {{-- <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputStatus">Role_type</label>
                                    <select class="form-control" name="role">
                                        <option value="1">Giveit</option>
                                        <option value="2">Getit</option>
                                    </select>
                                </div>
                            </div> --}}
                                
                                {{-- <div class="form-group">
                                    <label for="exampleInputStatus">Role</label>
                                    <select class="form-control" name="role">
                                        {{-- @foreach ($roleIdData as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach --}}
                                    {{-- </select>
                                </div>  --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputStatus">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Process</option>
                                            {{-- <option value="2">Done</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                <div class="form-group">
                                     
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                        <label class="form-check-label" for="inlineRadio1">Active</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">InActive</label>
                                      </div>
                                
                                </div>
                            </div>
                                </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Add</button>
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