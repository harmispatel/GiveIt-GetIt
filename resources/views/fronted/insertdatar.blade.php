<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <title>Requirement</title>
    <script type="text/javascript">
        function OtherData() {
            var selectVal = $('#category').val();
                    // alert(selectVal);
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

                            <div class="card-header">
                                <h3 class="card-title text-center">Add Requirement</h3>
                            </div>
                            <form action="{{ route('insertdata') }}" id="quickForm" method="POST">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Catgory">Category</label>
                                        <select class="form-control" name="category" id="category"
                                            onchange="OtherData()">
                                            @foreach ($categoryId as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                            <option value="0">Others</option>
                                        </select>
                                    </div>
                                    <div id ="addcatgory" style="display: none">
                                        <input type="text" class="form-control" name="Addcategory" placeholder="Enter Category Name"> 
                                    </div> 
                                    @if ($errors->has('Addcategory'))
                                    <span class="text-danger">{{ $errors->first('Addcategory') }}</span>
                                @endif
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Person">Person</label>
                                        <input type="number" name="quantity"
                                            class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                                            placeholder="Enter Person" value="{{ old('quantity') }}">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Requirement">Requirement</label>
                                        <div class="mb-3">

                                            <textarea name="requirement" class="form-control  {{ $errors->has('requirement') ? 'is-invalid' : '' }}"
                                                rows="3" placeholder="Enter requirement">{{ old('requirement') }}</textarea>
                                        </div>
                                        {{-- <input type="text" name="requirement" class="form-control {{ $errors->has('requirement') ? 'is-invalid' : '' }}" placeholder="Enter requirement"> --}}
                                        @if ($errors->has('requirement'))
                                            <span class="text-danger">{{ $errors->first('requirement') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Pending</option>
                                            <option value="2">Complete</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio1" value="1" checked>
                                            <label class="form-check-label" for="Active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="InActive">InActive</label>
                                        </div>

                                    </div>
                                </div>
                        </div>
                        
                        
                        <div class="text-right">
                            <a href="{{ route('require') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" name="submit" class="btn btn-primary">Add</button>

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
