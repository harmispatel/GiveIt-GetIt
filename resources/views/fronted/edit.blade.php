@extends('fronted.layout')

@section('title', 'Give It & Get It -EditRequirement')

@section('content')


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

<body>
    <div class="donation-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="donate-form">
                        <div class="form-title text-center">
                            <h3>Edit Requirement</h3>
                        </div>
                       
                        <hr>

                          
                            <form action="{{route('update', $RequiredData['id'])}}" id="quickForm" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Catgory" class="form-label">Category</label>
                                        <select class="form-control" name="category" id="category"
                                            onchange="OtherData()">
                                            @foreach ($categoryId as $item)
                                                <option value="{{$item->id}}"{{ ($item->id == $RequiredData->category_id) ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option> 
                                             @endforeach
                                            <option value="0">Others</option>
                                        </select>

                                        <br>
                                        <div id="addcatgory" style="display: none">
                                            <input type="text" class="form-control" name="Addcategory"
                                                placeholder="Enter Category Name">
                                        </div>
                                        @if ($errors->has('Addcategory'))
                                            <span class="text-danger">{{ $errors->first('Addcategory') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="Person" class="form-label">Person</label>
                                        <input type="number" name="quantity"
                                            class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                                            placeholder="Enter Person" value="{{$RequiredData->quantity}}">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="Price" class="form-label">Price</label>
                                        <input type="text" name="price"
                                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            placeholder="Enter Price" value="{{$RequiredData->price}}">
                                        @if ($errors->has('price'))
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="media" class="form-label">Media</label>
                                        <input type="file" name="media" class="form-control" value="{{$RequiredData->media_id}}">
                                        <img src="{{ $RequiredData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($RequiredData->media['path']) }}" alt="Image" width="150">
                                    </div>
                                    @if ($errors->has('media'))
                                            <span class="text-danger">{{ $errors->first('media') }}</span>
                                        @endif
                                    <div class="form-group">
                                        <label for="Requirement" class="form-label">Requirement</label>
                                        <div class="mb-3">

                                            <textarea name="requirement" id="summernote"
                                                class="ckeditor form-control  {{ $errors->has('requirement') ? 'is-invalid' : '' }}" rows="3"
                                                placeholder="Enter requirement">{{$RequiredData->requirements}}</textarea>
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
                                <div class="text-right">
                                    <a href="{{route('editprofile')}}" class="btn donate-bt">Back</a>
                                    <button type="submit" name="submit" class="btn donate-bt">UPDATE</button>
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
@endsection

















