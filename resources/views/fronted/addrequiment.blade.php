@extends('fronted.layout')

@section('title', 'Give It & Get It -AddRequirement')

@section('content')


    
<body>
    <div id="loader" style="display:block ; background: rgb(255, 255, 255);">
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
                            <h3>Add Requirement</h3>
                        </div>
                       
                        <hr>

                          
                            <form action="{{route('insertdata')}}" id="insertdata" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    {{-- Select Type --}}
                                    <div class="form-group">
                                        <label for="RequirementType" class="form-label">Requirement Type</label>
                                        <select class="form-control form-select type" name="Type"  onchange="OtherType()">
                                            <option value="#">Select Type</option>
                                            <option value="1">Giveit</option>                                           
                                            <option value="2">Getit</option>                                           
                                        </select> 
                                        @if ($errors->has('Type'))
                                        <span class="text-danger">{{ $errors->first('Type') }}</span>
                                    @endif
                                    </div>

                                {{-- Give Type --}}
                                    <div class="form-group">
                                        <div class="GiveType" style="display: none">
                                        <label for="GiveType" class="form-label">SubType</label>
                                        <select class="form-control form-select givetype" name="givetype"  onchange="OtherGivetype()">
                                            <option value="1">Donation</option>                                           
                                            <option value="2">Sell</option>                                           
                                            <option value="3">Rent</option>                                           
                                        </select>
                                        <br>
                                        </div>
                                        {{-- Get Type --}}
                                    <div class="form-group">
                                        <div class="GetType" style="display: none">
                                        <label for="GetType" class="form-label">SubType</label>
                                        <select class="form-control form-select gettype" name="gettype"  onchange="OtherGettype()">
                                            <option value="4">Need</option>                                           
                                            <option value="5">Buy</option>                                           
                                        </select>
                                        <br>
                                        </div>
                                        {{-- Sell Price --}}
                                        <div class="price" style="display: none">
                                            <label for="price" class="form-label">Add Price</label>
                                            <input type="text" class="form-control" name="sellprice"
                                            placeholder="Enter Price">
                                        </div>
                                    {{-- Rent Price --}}
                                        <div class="addprice" style="display: none">
                                            <label for="addprice" class="form-label">Add Price</label>
                                            <input type="text" class="form-control" name="rentprice"
                                            placeholder="Enter Price">
                                        </div>
                                        {{-- Month Year --}}
                                        <div class="date" style="display: none">
                                            <label for="addprice" class="form-label">Month/Year</label>
                                            <input type="month" class="form-control" name="rentdate" placeholder="Enter Month/Year"/>
                                        </div>
                                    </div>
 
                                    
                                        {{-- Buy Price --}}
                                        <div class="getaddprice" style="display: none">
                                            <label for="addprice" class="form-label">Add Price</label>
                                            <input type="text" class="form-control" name="price"
                                            placeholder="Enter Price">
                                        </div>
                                    </div>
                                    {{-- Category --}}
                                    <div class="form-group">
                                        <label for="Catgory" class="form-label">Category</label>
                                        <select class="form-control form-select category" name="category"
                                            onchange="OtherData()">
                                            @foreach ($categoryId as $item)
                                                <option value="{{ $item->id }}">
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
                                        </div>
                                        @if ($errors->has('Addcategory'))
                                            <span class="text-danger">{{ $errors->first('Addcategory') }}</span>
                                        @endif
                                    </div>
                                    {{-- Person --}}
                                    <div class="form-group">
                                        <label for="Person" class="form-label">Person</label>
                                        <input type="number" name="quantity"
                                            class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                                            placeholder="Enter Person" value="{{ old('quantity') }}">
                                        @if ($errors->has('quantity'))
                                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                {{-- Image --}}
                                    <div class="form-group">
                                        <label for="media" class="form-label">Media</label>
                                        <input type="file" name="media" class="form-control">
                                    </div>
                                    @if ($errors->has('media'))
                                            <span class="text-danger">{{ $errors->first('media') }}</span>
                                        @endif
                                        {{-- Requirement --}}
                                    <div class="form-group">
                                        <label for="Requirement" class="form-label">Requirement</label>
                                        <div class="mb-3">
                                            <textarea name="requirement" id="summernote"
                                                class="ckeditor form-control  {{ $errors->has('requirement') ? 'is-invalid' : '' }}" rows="3"
                                                placeholder="Enter requirement">{{ old('requirement') }}</textarea>
                                        </div>
                                        @if ($errors->has('requirement'))
                                            <span class="text-danger">{{ $errors->first('requirement') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a href="welcome" class="btn donate-bt">Back</a>
                                    <button type="submit" name="submit" class="btn donate-bt">Add</button>
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

<script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
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
            // alert('hello');
            $(".price").show();
        }else{
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
        }else{
            $(".getaddprice").hide();
        }
        
        
    } 


    
        
            $(document).ready(function(){
                setTimeout(() => {
                    $('.alert').hide()
                }, 3000);
            });

            $("#insertdata").validate({
                rules:{
                    requirement : {
                        required: true
                    },
                    
                    messages: {
                        requirement : {
                        required: "Requiewment is required",
                    },
                }
                         
                }
            });

</script>
@endsection

