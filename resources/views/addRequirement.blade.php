@extends('common.layout')

@section('title', 'Add Requirement')

@section('content')
  
      <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col">
                <div class="card align-center mt-5">
                  <div class="card-header">
                    Add Requirement
                  </div>
                  <div class="card-body">
                    <form action="{{route('requirement.store')}}" id="formId" method="POST" enctype="multipart/form-data" >
                      @csrf

                      {{-- Type --}}
                      <div class="form-group">
                        <label for="type">Requirement Type</label>
                        <select class="form-control form-control-md" name="type" value="{{old('type')}}" id="type" onchange="UserType()">
                          <option value="#">Select Type</option>
                          <option value="1">Giveit</option>
                          <option value="2">Getit</option>
                              
                        </select>
                      </div>

                      {{-- Giveit: Subtype --}}
                      <div class="form-group" id="giveType" style="display: none">
                        <label for="giveItType">Sub Type</label>
                        <select class="form-control form-control-md" name="giveItType" id="giveItType" onchange="GiveItType()">
                          <option value="#">Select Sub Type</option>
                          <option value="1">Donation</option>
                          <option value="2">Sell</option>    
                          <option value="3">Rent</option>    
                        </select>
                      </div>

                      {{-- Giveit: Subtype  --}}

                      {{-- Add Donation --}}
                      {{-- <div id="Adddonation" style="display: none">
                        <input type="text" class="form-control" name="Adddonation" placeholder="Add Donation">                  
                          @if ($errors->has('Adddonation'))
                            <span class="text-danger">{{ $errors->first('Adddonation') }}</span>
                          @endif
                      </div> --}}

                      {{-- Add Sell Price --}}
                      <div id="addSellPrice" style="display: none">
                        <input type="text" class="form-control" name="addSellPrice" placeholder="Enter Sell Price">                  
                          @if ($errors->has('addSellPrice'))
                            <span class="text-danger">{{ $errors->first('addSellPrice') }}</span>
                          @endif
                      </div>

                      {{-- Add Rent Price --}}
                      <div id="addRentPrice" style="display: none">
                        <input type="text" class="form-control" name="addRentPrice" placeholder="Enter Rent Price">                  
                          @if ($errors->has('addRentPrice'))
                            <span class="text-danger">{{ $errors->first('addRentPrice') }}</span>
                          @endif
                      </div>

                      {{-- Add Rent Date --}}
                      <div id="addRentDate" style="display: none">
                        <input type="month" class="form-control" name="addRentDate" placeholder="Enter Rent Date">                  
                          @if ($errors->has('addRentDate'))
                            <span class="text-danger">{{ $errors->first('addRentDate') }}</span>
                          @endif
                      </div>

                      {{-- Getit: Subtype --}}
                      <div class="form-group" id="getType" style="display: none">
                        <label for="getItType">Sub Type</label>
                        <select class="form-control form-control-md" name="getItType" id="getItType" onchange="GetItType()">
                          <option value="#">Select Sub Type</option>
                          <option value="4">Need</option>
                          <option value="5">Buy</option>       
                        </select>
                      </div>

                      {{-- Add Buy --}}
                      <div id="addBuy" style="display: none">
                        <input type="number" class="form-control" name="price" placeholder="Enter Price">                  
                          @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                          @endif
                      </div>

                      {{-- Media --}}
                      <div class="form-group">
                        <label for="media">Media</label>
                        <input type="file" name="media" class="form-control" value="{{old('media')}}">
                          @if ($errors->has('media'))
                            <p class="alert alert-danger">{{$errors->first('media')}}</p>                                    
                          @endif
                      </div>  
                      
                      {{-- Category --}}
                      <div class="form-group">
                        <label for="category_id">Category</label>
                          <select class="form-control form-control-md" name="category_id" id="category" onchange="OtherData()" >
                              @foreach ($categoryId as $categoryValue)
                                <option value="{{$categoryValue->id}}">{{$categoryValue->name}}</option> 
                              @endforeach
                              <option value="0" class="bg-dark"><i class="fa fa-plus"></i>Others</option> 
                          </select>
                      </div>
                                  
                      {{-- Add new Category --}}
                      <div id="Addcatgory" style="display: none">
                        <input type="text" class="form-control" name="Addcategory" placeholder="Enter Category Name">                  
                          @if ($errors->has('Addcategory'))
                            <span class="text-danger">{{ $errors->first('Addcategory') }}</span>
                          @endif
                      </div>

                      {{-- Requirement --}}
                      <div class="form-group purple-border">
                        <label for="address">Requirement</label>
                          <textarea class="ckeditor form-control" name="requirement" id="exampleFormControlTextarea4" rows="3" placeholder="Enter Requirement" value="{{old('requirement')}}"></textarea>
                          @if ($errors->has('requirement'))
                              <p class="alert alert-danger">{{$errors->first('requirement')}}</p>                                    
                            @endif
                      </div>
                                  
                      {{-- Person --}}
                      <div class="form-group">
                        <label for="quantity">Person</label>
                          <input type="text" name="quantity" class="form-control" placeholder=" Add quantity" value="{{old('quantity')}}">
                            @if ($errors->has('quantity'))
                              <p class="alert alert-danger">{{$errors->first('quantity')}}</p>                                    
                            @endif
                      </div>  

                      {{-- Status --}}
                        {{-- <div class="form-group"><b> Status : </b>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="2">
                              <label class="form-check-label" for="inlineRadio1">Completed</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1">
                              <label class="form-check-label" for="inlineRadio2">Pending</label>
                          </div>
                        </div> --}}

                      {{-- Is Active? --}}
                      {{-- <div class="form-group">
                        <label for="is_active">Is Active</label>
                          <select name="is_active" id="status" class="form-control">
                            <option value="2">Active</option>
                            <option value="1">Inactive</option>
                          </select>
                      </div> --}}
                              
                      <button type="submit" class="btn btn-primary">  Add </button>
                      <a class="btn btn-dark" href="{{route('requirement.index')}}"> Back </a>
                    </form>
                    <hr>                                                       
                  </div>
                </div>
              </div>
            </div>
        </section>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

        <script type="text/javascript">

            // CK editor
            $(document).ready(function() {
              $('.ckeditor').ckeditor();
            });

            // Open Other Category Input Field
            function OtherData() {
                var selectVal = $('#category').val();
                // alert(selectVal);
                if (selectVal == 0) {
                  $("#Addcatgory").show().css('margin-bottom',10);
                } else {
                  $("#Addcatgory").hide();
                }
            }

            // User Type
            function UserType(){
              var selectVal = $('#type').val();
              // alert(selectVal);
              if (selectVal == 1) {
                $("#giveType").show().css('margin-bottom',10);     
              }else{
                $("#giveType").hide(); 
                // $('#Adddonation').hide();  
                $('#addSellPrice').hide();
                $('#addRentPrice').hide();
                $('#addRentDate').hide(); 

              }

              if (selectVal == 2) {
                $("#getType").show().css('margin-bottom',10);    
              }else{
                $("#getType").hide();
                $('#addBuy').hide();
              }

            }

            // Giveit Sub Type
            function GiveItType(){
              var selectVal = $('#giveItType').val();
              // alert(selectVal);

              // Donation show and hide
              if (selectVal == 1) {
                $('#Adddonation').show().css('margin-bottom',10);
              }else{
                $('#Adddonation').hide();
              }

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
    
@endsection