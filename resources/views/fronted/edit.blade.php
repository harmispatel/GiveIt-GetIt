@extends('fronted.layout')

@section('title', 'Give It & Get It -EditRequirement')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <body>
        <div id="loader" style="display: block; background: rgb(255, 254, 254);">
            <div id="square">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div id="laoding_text">
                <span>Loading...</span>
            </div>
        </div>
        <div class="donation-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="donate-form">
                            <div class="form-title text-center">
                                <h3>Edit Requirement</h3>
                            </div>
                            <hr>
                            <form action="{{ route('update', $RequiredData['id']) }}" id="quickForm" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <select class="form-control form-select" name="Type" id="Type"
                                            onchange="OtherType()">
                                            <option value="1"{{ $RequiredData->type == 1 ? 'selected' : '' }}>Giveit
                                            </option>
                                            <option value="2"{{ $RequiredData->type == 2 ? 'selected' : '' }}>Getit
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div id="GiveType" style="display:none">
                                            <label for="GiveType" class="form-label">SubType</label>
                                            <select class="form-control form-select" name="givetype" id="givetype"
                                                onchange="OtherGivetype()">
                                                <option value="1" {{ $RequiredData->subtype == 1 ? 'selected' : '' }}>
                                                    Donation</option>
                                                <option value="2" {{ $RequiredData->subtype == 2 ? 'selected' : '' }}>
                                                    Sell</option>
                                                <option value="3" {{ $RequiredData->subtype == 3 ? 'selected' : '' }}>
                                                    Rent</option>
                                            </select>
                                            <br>
                                        </div>
                                        <div id="price" style="display:none">
                                            <label for="price" class="form-label">Add Price</label>
                                            <input type="text" class="form-control" name="sellprice"
                                                placeholder="Enter Price" value="{{ $RequiredData->price }}">
                                        </div>

                                        <div id="addprice" style="display:none">
                                            <label for="addprice" class="form-label">Add Price</label>
                                            <input type="text" class="form-control" name="rentprice"
                                                placeholder="Enter Price" value="{{ $RequiredData->price }}">
                                        </div>
                                        <div id="date" style="display:none">
                                            <label for="addprice" class="form-label">Month/Year</label>
                                            <input type="month" class="form-control" name="rentdate"
                                                placeholder="Enter Month/Year" value="{{ $RequiredData->rent_date }}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="GetType" style="display:none">
                                            <label for="GetType" class="form-label" style="display:none">SubType</label>
                                            <select class="form-control form-select" name="gettype" id="gettype"
                                                onchange="OtherGettype()">
                                                <option value="4" {{ $RequiredData->subtype == 4 ? 'selected' : '' }}>
                                                    Need</option>
                                                <option value="5" {{ $RequiredData->subtype == 5 ? 'selected' : '' }}>
                                                    Buy</option>
                                            </select>
                                            <br>
                                        </div>
                                        <div id="getaddprice" style="display:none">
                                            <label for="addprice" class="form-label">Add Price</label>
                                            <input type="text" class="form-control" name="price"
                                                placeholder="Enter Price" value="{{ $RequiredData->price }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Catgory" class="form-label">Category</label>
                                        <select class="form-control form-select" name="category" id="category"
                                            onchange="OtherData()">
                                            @foreach ($categoryId as $item)
                                                <option
                                                    value="{{ $item->id }}"{{ $item->id == $RequiredData->category_id ? 'selected' : '' }}>
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
                                        <input type="number" name="quantity" id="quantity"
                                            class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                                            placeholder="Enter Person" value="{{ $RequiredData->quantity }}">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="media" class="form-label">Media</label>
                                        <input type="file" name="media" class="form-control"
                                            value="{{ $RequiredData->media_id }}"><br>
                                        <img src="{{ $RequiredData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($RequiredData->media['path']) }}"
                                            alt="Image" width="150">
                                    </div>
                                    @if ($errors->has('media'))
                                        <span class="text-danger">{{ $errors->first('media') }}</span>
                                    @endif
                                    <div class="form-group">
                                        <label for="Requirement" class="form-label">Requirement</label>
                                        <div class="mb-3">
                                            <script>
                                                CKEDITOR.replace('requirement');
                                            </script>
                                            <textarea name="requirement" required="required" class="ckeditor form-control " rows="3"
                                                placeholder="Enter requirement">{{ $RequiredData->requirements }}</textarea>
                                            <script>
                                                CKEDITOR.replace('requirement');
                                            </script>
                                        </div>
                                        @if ($errors->has('requirement'))
                                            <span class="text-danger">{{ $errors->first('requirement') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                        <select class="form-control form-select" name="status">
                                            <option value="1"{{ $RequiredData->status == 1 ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="2"{{ $RequiredData->status == 2 ? 'selected' : '' }}>
                                                Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('editprofile') }}" class="btn donate-bt mr-2">Back</a>
                                    <button type="submit" name="submit" class="btn donate-bt">Update</button>
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
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            OtherType()
            OtherGettype()
            OtherGivetype()
        });

        function OtherData() {
            var selectVal = $('#category').val();

            if (selectVal == 0) {
                $("#addcatgory").show();
            } else {
                $("#addcatgory").hide();
            }
        }

        function OtherType() {
            var selectVal = $('#type').val();

            if (selectVal == 1) {

                $("#GiveType").show();
            } else {
                $("#GiveType").hide();
                $(".price").hide();
                $(".addprice").hide();
                $(".date").hide();
            }
            if (selectVal == 2) {

                $("#GetType").show();
            } else {
                $("#GetType").hide();
                $(".getaddprice").hide();
            }
        }

        function OtherGivetype() {
            var selectVal = $('#givetype').val();

            if (selectVal == 2) {
                // alert('hello');
                $("#price").show();
            } else {
                $("#price").hide();
            }
            if (selectVal == 3) {
                $("#addprice").show();
                $("#date").show();

            } else {
                $("#addprice").hide();
                $("#date").hide();
            }

        }

        function OtherGettype() {
            var selectVal = $('#gettype').val();

            if (selectVal == 5) {

                $("#getaddprice").show();
            } else {
                $("#getaddprice").hide();
            }


        }
        $(document).ready(function() {
            $("#quickForm").validate({
                ignore: [],
                rules: {
                    requirement: {
                        required: function() {
                            CKEDITOR.instances.requirement.updateElement();
                        }
                    },
                    quantity: {
                        required: true,
                        min: 1,
                        number: true
                    },
                    Type: {
                        required: true,
                    }
                },
            });
        });
    </script>

@endsection
