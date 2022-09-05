@extends('common.layout')

@section('title', 'Edit Requiremet')

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

                        {{-- Type --}}
                        <div class="form-group">
                          <label for="type">Type</label>
                          <select class="form-control form-control-md" name="type" id="type" onchange="UserType()" >
                            <option value="#">Select Type</option>
                            <option value="1" {{ $editRequirementData->type == 1 ? 'selected' : '' }}>Giveit</option>    
                            <option value="2" {{ $editRequirementData->type == 2 ? 'selected' : '' }}>Getit</option>
                          </select>
                        </div>

                        {{-- Giveit: Subtype --}}
                        <div class="form-group" id="giveType" style="display: none">
                          <label for="giveItType">Sub Type</label>
                          <select class="form-control form-control-md" name="giveItType" id="giveItType" onchange="GiveItType()">
                            
                            <option value="1" {{ $editRequirementData->subtype == 1 ? 'selected' : '' }}>Donation</option>
                            <option value="2" {{ $editRequirementData->subtype == 2 ? 'selected' : '' }}>Sell</option>    
                            <option value="3" {{ $editRequirementData->subtype == 3 ? 'selected' : '' }}>Rent</option>    
                          </select>
                        </div>
 
                        {{-- Getit: Subtype --}}
                        <div class="form-group" id="getType" style="display: none">
                          <label for="getItType">Sub Type</label>
                          <select class="form-control form-control-md" name="getItType" id="getItType" onchange="GetItType()">
                            <option value="#">Select Sub Type</option>
                            <option value="4" {{ $editRequirementData->subtype == 4 ? 'selected' : '' }}>Need</option>
                            <option value="5" {{ $editRequirementData->subtype == 5 ? 'selected' : '' }}>Buy</option>       
                          </select>
                        </div>

                        {{-- Giveit: Subtype  --}}

                        {{-- Add Donation --}}
                        {{-- <div id="Adddonation" style="display: none">
                          <input type="text" class="form-control" name="Adddonation" placeholder="Add Donation" value="{{$editRequirementData->subtype}}">                  
                            @if ($errors->has('Adddonation'))
                              <span class="text-danger">{{ $errors->first('Adddonation') }}</span>
                            @endif
                        </div> --}}

                        {{-- Add Sell Price --}}
                        <div id="addSellPrice" style="display: none">
                          <input type="text" class="form-control" name="addSellPrice" placeholder="Enter Sell Price" value="{{$editRequirementData->price}}">                  
                            @if ($errors->has('addSellPrice'))
                              <span class="text-danger">{{ $errors->first('addSellPrice') }}</span>
                            @endif
                        </div>

                        {{-- Add Rent Price --}}
                        <div id="addRentPrice" style="display: none">
                          <input type="text" class="form-control" name="addRentPrice" placeholder="Enter Rent Price" value="{{$editRequirementData->price}}">                  
                            @if ($errors->has('addRentPrice'))
                              <span class="text-danger">{{ $errors->first('addRentPrice') }}</span>
                            @endif
                        </div>

                        {{-- Add Rent Date --}}
                        <div id="addRentDate" style="display: none">
                          <input type="month" class="form-control" name="addRentDate" placeholder="Enter Rent Date" value="{{$editRequirementData->rent_date}}">                  
                            @if ($errors->has('addRentDate'))
                              <span class="text-danger">{{ $errors->first('addRentDate') }}</span>
                            @endif
                        </div>

                        {{-- Getit: Subtype  --}}
                        {{-- Add Buy --}}
                        <div id="addBuy" style="display: none">
                          <input type="text" class="form-control" name="addBuy" placeholder="Enter Buy" value="{{$editRequirementData->price}}">                  
                            @if ($errors->has('addBuy'))
                              <span class="text-danger">{{ $errors->first('addBuy') }}</span>
                            @endif
                        </div>

                        {{-- Media --}}
                        <div class="form-group">
                          <label for="media">Media</label>
                          <input type="file" name="media" class="form-control" onchange="validateTypeAndSize(this)" value="{{$editRequirementData->media_id}}">
                            <img src="{{ $editRequirementData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($editRequirementData->media['path']) }}" alt="Image" width="100">
                            <p><span id="spnMessage" class="error text-danger" style="display: none;"></span></p>
                              @if ($errors->has('media'))
                                <p class="alert alert-danger">{{$errors->first('media')}}</p>                                    
                              @endif
                        </div> 

                        {{-- Category --}}
                        <div class="form-group">
                          <label for="requirementCategory">Category</label>
                          <select class="form-control form-control-md" name="requirementCategory" id="category" onchange="OtherData()" >    
                            @foreach ($categoryId as $editRequirements)
                              <option value="{{$editRequirements->id}}" {{($editRequirements->id == $editRequirementData->category_id) ? 'selected' : ''}}>{{$editRequirements->name}}</option> 
                            @endforeach 
                              <option value="0" class="bg-dark"><i class="fa fa-plus"></i> Other</option>                                              
                          </select>
                        </div>
                        
                        {{-- Add new Category --}}
                        <div id="addcatgory" style="display: none">
                          <input type="text" class="form-control" name="Addcategory" placeholder="Enter Category Name">                  
                            @if ($errors->has('Addcategory'))
                              <span class="text-danger">{{ $errors->first('Addcategory') }}</span>
                            @endif
                        </div>

                        {{-- Requirement --}}
                        <div class="form-group purple-border">
                          <label for="address">Requirement</label>
                          <textarea class="ckeditor form-control" name="requirement" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Requirement" value="{{old('requirement')}}">
                            {{$editRequirementData->requirements}}
                          </textarea>
                        </div>
                        
                        {{-- Person --}}
                        <div class="form-group">
                          <label for="quantity">Person</label>
                          <input type="text" name="quantity" class="form-control" placeholder=" Add quantity" value="{{$editRequirementData->quantity}}">
                            @if ($errors->has('quantity'))
                              <p class="alert alert-danger">{{$errors->first('quantity')}}</p>                                    
                            @endif
                        </div>
                        
                        
                        
                        {{-- Status --}}
                        <div class="form-check form-check-inline"><b> Status: </b>
                          <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="2" {{ $editRequirementData->status == '2' ? 'checked' : ''}}>
                            <label class="form-check-label" for="inlineRadio1">Completed</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1" {{ $editRequirementData->status == '1' ? 'checked' : ''}}>
                            <label class="form-check-label" for="inlineRadio2">Pending</label>
                        </div><br><br>

                        {{-- Is Active? --}}
                        <div class="form-group">
                          <label for="is_active">Is Active</label>
                            <select name="is_active" id="is_active" class="form-control">
                              <option value="2" {{ $editRequirementData->is_active == 2 ? 'selected' : '' }}>Active</option>
                              <option value="1" {{ $editRequirementData->is_active == 1 ? 'selected' : '' }}>In Active</option>
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

      {{-- Ck Editor --}}
      <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
      <script type="text/javascript">
          $(document).ready(function() {

            $('.ckeditor').ckeditor();

          });
      </script>

      {{-- Open Other Category Input Field --}}
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script type="text/javascript">

        
        $(document).ready(function() {
              UserType()
              GiveItType()
              GetItType()
          });
          // Open Other Category Input Field
        function OtherData() {
            var selectVal = $('#category').val();
            
            if (selectVal == 0) {
                $("#addcatgory").show().css('margin-bottom',10);
            } else {
                $("#addcatgory").hide();
            }
        }

        // User Type
        function UserType(){
          var selectVal = $('#type').val();
          // alert(selectVal);
          if (selectVal == 1) {
              $('#giveType').show().css('margin-bottom',10);
          }else{
              $("#giveType").hide();
              // $('#Adddonation').hide();
              $('#addSellPrice').hide();
              $('#addRentPrice').hide();
              $('#addRentDate').hide();
          }

          if (selectVal == 2) {
              $('#getType').show().css('margin-bottom',10);
          }else{
              $("#getType").hide();
              $('#addBuy').hide();
          }
        }

        // Giveit Sub Type
        function GiveItType(){
              var selectVal = $('#giveItType').val();
              

              // Donation show and hide
              // if (selectVal == 1) {
              //   $('#Adddonation').show().css('margin-bottom',10);
              // }else{
              //   $('#Adddonation').hide();
              // }

              // sell Price show and hide
              if (selectVal == 2) {
                $('#addSellPrice').show().css('margin-bottom',10);
              }else{
                $('#addSellPrice').hide();
              }

              // Rent Price,Date show and hide
              if (selectVal == 3) {
                $('#addRentPrice').show().css('margin-bottom',10);
                $('#addRentDate').show().css('margin-bottom',10);
              }else{
                $('#addRentPrice').hide();
                $('#addRentDate').hide();
              }
        }

        // Getit Sub Type
        function GetItType(){
              var selectVal = $('#getItType').val();
              // alert(selectVal);
              
              // Buy show and hide
              if (selectVal == 5) {
                $('#addBuy').show().css('margin-bottom',10);
              }else{
                $('#addBuy').hide();

              }
        }



        // Validation
        function validateTypeAndSize(uploadCtrl) 
            {
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
                        $('#spnMessage').text("Sorry!! Max allowed image size is 5mb").show();
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

            $(document).ready(function() {

              $("#formId").validate({
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
                      type: {
                          required: true,
                      },
                      // media: {
                      //     // required: true,
                      //     accept: "jpg|jpeg|png|gif|svg",
                      //     filesize: 1048576
                      // }, 


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
                      type:{
                          required: "Select at least one type",

                      }
                  }

              });
          });
      </script>
    </body>
  </html>
@endsection