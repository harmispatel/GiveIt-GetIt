@extends('fronted.layout')

@section('title', 'Give It & Get It -EditRequirement')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
           
            OtherType()
            OtherGivetype()
            OtherGettype()

        });


        function OtherData() {
            var selectVal = $('.category').val();

            if (selectVal == 0) {
                $(".addcatgory").show();
            } else {
                $(".addcatgory").hide();
            }
        }

        function OtherType() {
            var selectVal = $('.type').val();

            if (selectVal == 1) {

                $(".GiveType").show();
            } else {
                $(".GiveType").hide();
                $(".price").hide();
                $(".addprice").hide();
                $(".date").hide();
            }
            if (selectVal == 2) {

                $(".GetType").show();
            } else {
                $(".GetType").hide();
                $(".getaddprice").hide();
            }
        }

        function OtherGivetype() {
            var selectVal = $('.givetype').val();

            if (selectVal == 2) {
             
                $(".price").show();
            } else {
                $(".price").hide();
            }
            if (selectVal == 3) {
                $(".addprice").show();
                $(".date").show();

            } else {
                $(".addprice").hide();
                $(".date").hide();
            }

        }

        function OtherGettype() {
            var selectVal = $('.gettype').val();

            if (selectVal == 5) {

                $(".getaddprice").show();
            } else {
                $(".getaddprice").hide();
            }


        }
    </script>


    <body>
        @if (session()->has('mistake'))
            <div class="alert alert-warning mistake ">
                {{ session()->get('mistake') }}
            </div>
        @endif
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
                                    {{-- Select Type --}}
                                    <div class="form-group">
                                        <label for="RequirementType" class="form-label">Requirement Type</label>
                                        <select class="form-control form-select type" id="Type" name="Type"
                                            onchange="OtherType()">
                                            {{-- <option value="">Select Type</option> --}}
                                            <option value="1" {{ $RequiredData->type == 1 ? 'selected' : '' }}>Giveit
                                            </option>
                                            <option value="2" {{ $RequiredData->type == 2 ? 'selected' : '' }}>Getit
                                            </option>
                                        </select>
                                        @if ($errors->has('Type'))
                                            <span class="text-danger">{{ $errors->first('Type') }}</span>
                                        @endif
                                    </div>

                                    {{-- Give Type --}}
                                    <div class="form-group">
                                        <div class="GiveType" style="display: none">
                                            <label for="GiveType" class="form-label">SubType</label>
                                            <select class="form-control form-select givetype" name="givetype"
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
                                        {{-- Get Type --}}
                                        <div class="form-group">
                                            <div class="GetType" style="display: none">
                                                <label for="GetType" class="form-label">SubType</label>
                                                <select class="form-control form-select gettype" name="gettype"
                                                    onchange="OtherGettype()">
                                                    <option value="4"
                                                        {{ $RequiredData->subtype == 4 ? 'selected' : '' }}>Need</option>
                                                    <option value="5"
                                                        {{ $RequiredData->subtype == 5 ? 'selected' : '' }}>Buy</option>
                                                </select>
                                                <br>
                                            </div>
                                            {{-- Sell Price --}}
                                            <div class="price" style="display: none">
                                                <label for="price" class="form-label">Add Price</label>
                                                <input type="text" class="form-control" name="sellprice"
                                                    placeholder="Enter Price" value="{{ $RequiredData->price }}">
                                            </div>
                                            {{-- Rent Price --}}
                                            <div class="addprice" style="display: none">
                                                <label for="addprice" class="form-label">Add Price</label>
                                                <input type="text" class="form-control" name="rentprice"
                                                    placeholder="Enter Price" value="{{ $RequiredData->price }}">
                                            </div>
                                            {{-- Month Year --}}
                                            <div class="date" style="display: none">
                                                <label for="addprice" class="form-label">Month/Year</label>
                                                <input type="month" class="form-control" name="rentdate"
                                                    placeholder="Enter Month/Year"
                                                    value="{{ $RequiredData->rent_date }}" />
                                            </div>
                                        </div>


                                        {{-- Buy Price --}}
                                        <div class="getaddprice" style="display: none">
                                            <label for="addprice" class="form-label">Add Price</label>
                                            <input type="text" class="form-control" name="price"
                                                placeholder="Enter Price" value="{{ $RequiredData->price }}">
                                        </div>
                                    </div>
                                    {{-- Category --}}
                                    <div class="form-group">
                                        <label for="Catgory" class="form-label">Category</label>
                                        <select class="form-control form-select category" name="category"
                                            onchange="OtherData()">
                                            @foreach ($categoryId as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $RequiredData->category_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                            <option value="0">Others</option>
                                        </select>
                                        <br>
                                        {{-- New Category --}}
                                        <div class="addcatgory" style="display: none">
                                            <input type="text" class="form-control" name="Addcategory"
                                                placeholder="Enter Category Name">
                                            @if ($errors->has('Addcategory'))
                                                <span class="text-danger">{{ $errors->first('Addcategory') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- Person --}}
                                    <div class="form-group">
                                        <label for="Person" class="form-label">Person</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control"
                                            placeholder="Enter Person" value="{{ $RequiredData->quantity }}">
                                        @if ($errors->has('quantity'))
                                            <div style="color: red">{{ $errors->first('quantity') }}</div>
                                        @endif
                                    </div>
                                    {{-- Image --}}
                                    <div class="form-group">
                                        <label for="media" class="form-label">Image</label>
                                        <input type="file" id="media" name="media" class="form-control"
                                            value="{{ $RequiredData->media_id }}" onchange="validateTypeAndSize(this)" ><br>  
                                        <img src="{{ $RequiredData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($RequiredData->media['path']) }}"
                                            alt="Image" width="150">
                                    </div>
                                   <p><span id="spnMessage" class="error" style="display: none;"></span></p>
                                        @if ($errors->has('media'))
                                        <span class="text-danger">{{ $errors->first('media') }}</span>
                                    @endif
                                    {{-- Requirement --}}

                                    <div class="form-group">
                                        <label for="Requirement" class="form-label">Requirement</label>
                                        <div class="mb-3">
                                            <textarea name="requirement" id="requirement" class="ckeditor form-control" required="required" rows="3"
                                                placeholder="Enter requirement">{{ $RequiredData->requirements }}</textarea>
                                            <script>
                                                CKEDITOR.replace('requirement');
                                            </script>
                                            @if ($errors->has('requirement'))
                                                <span class="text-danger">{{ $errors->first('requirement') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                {{-- status --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="Status" class="form-label">Status</label>
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

    <script>
        function validateTypeAndSize(uploadCtrl) {
            var extension = $(uploadCtrl).val().split('.').pop().toLowerCase();
            var validFileExtensions = ['jpeg', 'jpg', 'png', 'svg','gif'];
            if ($.inArray(extension, validFileExtensions) == -1) {
                $('#spnMessage').text("Sorry!! Upload only jpg, jpeg, png, svg, gif image").show();
                $(uploadCtrl).replaceWith($(uploadCtrl).val('').clone(true));
                $('#btnSubmit').prop('disabled', true);
                $('#imgPreview').prop('src', '');
            }
            else {
                // Check and restrict the file size to 5 mb.
                if ($(uploadCtrl).get(0).files[0].size > (500000)) {
                    $('#spnMessage').text("Sorry!! Max allowed image size is 5 mb").show();
                    $(uploadCtrl).replaceWith($(uploadCtrl).val('').clone(true));
                    $('#btnSubmit').prop('disabled', true);
                }
                else {
                    $('#spnMessage').text('').hide();
                    $('#btnSubmit').prop('disabled', false);
                    previewImage(uploadCtrl);
                }
            }
        }
        setTimeout(() => {
            $('.mistake').remove();
        }, 3500);
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
                messages: {
                    requirement: {
                        required: "reuirement is required"
                    },
                    quantity: {
                        required: "Person is required",
                        min: "Select at least one person",
                        number: "Number is not valid"
                    },
                    Type: {
                        required: "Select at least one type",

                    }
                }
            });
        });
    </script>

@endsection
