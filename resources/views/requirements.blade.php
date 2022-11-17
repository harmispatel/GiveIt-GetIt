@extends('common.layout')

@section('title', 'Requirement')

@section('content')
    {{-- add new Requirement modal start --}}
    <div class="modal fade" id="addRequirementModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Requirement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_Requirement_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        {{-- <div class="row"> --}}
                        <div class="my-2">
                            <label for="requirement-type">Requirement Type</label>
                            <select class="form-control form-control-md form-select" name="type"
                                value="{{ old('type') }}" id="type" onchange="UserType()">
                                <option value="">Select Type</option>
                                <option value="1">Giveit</option>
                                <option value="2">Getit</option>
                            </select>
                            <span class="text-danger error-text type_error"></span>
                        </div>
                        {{-- Giveit: Subtype --}}
                        <div class="my-2" id="giveType" style="display: none">
                            <label for="giveItType">Sub Type</label>
                            <select class="form-control form-control-md form-select" name="giveItType" id="giveItType"
                                onchange="GiveItType()">
                                <option value="1">Donation</option>
                                <option value="2">Sell</option>
                                <option value="3">Rent</option>
                            </select>
                            <span class="text-danger error-text giveItType_error"></span>
                        </div>
                        {{-- Add sell price  --}}
                        <div class="my-2" id="addSellPrice" style="display: none">
                            <label for="sell-price">Price</label>
                            <input type="text" name="addsellPrice" class="form-control" placeholder="Enter Sell Price"
                                value="{{ old('addsellPrice') }}">
                            <span class="text-danger error-text addsellPrice_error"></span>
                        </div>
                        {{-- Add sell price  --}}
                        <div class="my-2" id="addRentPrice" style="display: none">
                            <label for="sell-price">Price</label>
                            <input type="text" name="addRentPrice" class="form-control" placeholder="Enter Rent Price"
                                value="{{ old('addRentPrice') }}">
                            <span class="text-danger error-text addRentPrice_error"></span>
                        </div>
                        {{-- Add Rent Date --}}
                        <div class="my-2" id="addRentDate" style="display: none">
                            <label for="rent-date">Rent Date</label>
                            <input type="text" onfocus="(this.type='month')" name="addRentDate" class="form-control"
                                placeholder="Enter Rent Date" min="2022-10" value="{{ old('addRentDate') }}">
                            <span class="text-danger error-text addRentDate_error"></span>
                        </div>

                        {{-- Getit: Subtype  --}}
                        <div class="my-2" id="getType" style="display: none">
                            <label for="getItType">Sub Type</label>
                            <select class="form-control form-control-md form-select" name="getItType" id="getItType"
                                onchange="GetItType()">
                                <option value="4">Need</option>
                                <option value="5">Buy</option>
                            </select>
                            <span class="text-danger error-text getItType_error"></span>
                        </div>
                        {{-- Add Buy price  --}}
                        <div class="my-2" id="addBuy" style="display: none">
                            <label for="buy-price">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Enter Buy Price"
                                value="{{ old('price') }}">
                            <span class="text-danger error-text price_error"></span>
                        </div>
                        {{-- Person --}}
                        <div class="my-2">
                            <label for="person">Person</label>
                            <input type="text" name="quantity" class="form-control" placeholder="Enter person"
                                value="{{ old('quantity') }}">

                            <span class="text-danger error-text quantity_error"></span>
                        </div>
                        {{-- Category --}}
                        <div class="my-2">
                            <label for="category_id">Category</label>
                            <select class="form-control form-control-md form-select" name="category" id="category"
                                onchange="OtherData()">
                                @foreach ($categoryName as $categoryValue)
                                    <option value="{{ $categoryValue->id }}">{{ $categoryValue->name }}</option>
                                @endforeach
                                <option value="0" class="bg-dark"><i class="fa fa-plus"></i>Others</option>
                            </select>
                            <span class="text-danger error-text category_error"></span>
                        </div>
                        {{-- Add new Category --}}
                        <div class="my-2" id="Addcatgory" style="display: none">
                            <label for="addnewcategory">Add New Category</label>
                            <input type="text" name="Addcategory" class="form-control" placeholder="Enter Category">
                            <span class="text-danger error-text Addcategory_error"></span>
                        </div>
                        {{-- IMAGE --}}
                        <div class="my-2">
                            <label for="media">Image</label>
                            <input type="file" name="media" class="form-control" value="{{ old('media') }}">
                            <span class="text-danger error-text media_error"></span>
                        </div>
                        {{-- Requirement --}}
                        <div class="my-2">
                            <label for="requirement">Requirement</label>
                            <textarea class="summernote form-control" name="requirement" id="addrequirement" cols="30" rows="10"
                                placeholder="Enter Requirement" value="{{ old('requirement') }}"></textarea>
                            <span class="text-danger error-text requirement_error"></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_requirement_btn" class="btn btn-primary">Add Requirement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add new Requirement modal end --}}

    {{-- edit Requirement modal start --}}
    <div class="modal fade" id="editRequirementModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Requirement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_requirement_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="Rid" id="Rid">
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="my-2">
                                <label for="type">Requirement Type</label>
                                <select class="form-control form-control-md form-select" name="type" id="etype"
                                    onchange="EuserType()">
                                    <option value="">Select Type</option>
                                    <option value="1">Giveit</option>
                                    <option value="2">Getit</option>
                                </select>
                                <span class="text-danger error-text type_error"></span>
                            </div>
                        </div>
                        {{-- Giveit: Subtype --}}
                        <div class="my-2" id="egiveType" style="display: none">
                            <label for="giveItType">Sub Type</label>
                            <select class="form-control form-control-md form-select" name="giveItType" id="egiveItType"
                                onchange="EgiveItType()">
                                <option value="1">Donation</option>
                                <option value="2">Sell</option>
                                <option value="3">Rent</option>
                            </select>
                            <span class="text-danger error-text giveItType_error"></span>
                        </div>
                        {{-- Add sell price  --}}
                        <div class="my-2" id="eaddSellPrice" style="display: none">
                            <label for="sell-price">Price</label>
                            <input type="text" name="addsellPrice" id="esellprice" class="form-control"
                                placeholder="Enter Sell Price">
                            <span class="text-danger error-text addsellPrice_error"></span>
                        </div>
                        {{-- Add sell price  --}}
                        <div class="my-2" id="eaddRentPrice" style="display: none">
                            <label for="sell-price">Price</label>
                            <input type="text" name="addRentPrice" id="eRentPrice" class="form-control"
                                placeholder="Enter Rent Price">
                            <span class="text-danger error-text addRentPrice_error"></span>
                        </div>
                        {{-- Add Rent Date --}}
                        <div class="my-2" id="eaddRentDate" style="display: none">
                            <label for="rent-date">Rent Date</label>
                            <input type="text" onfocus="(this.type='month')" name="addRentDate" id="eRentDate"
                                class="form-control" placeholder="Enter Rent Date" min="2022-10">
                            <span class="text-danger error-text addRentDate_error"></span>
                        </div>
                        <div class="my-2" id="egetType" style="display: none">
                            <label for="getItType">Sub Type</label>
                            <select class="form-control form-control-md form-select" name="getItType" id="egetItType"
                                onchange="EgetItType()">
                                <option value="4">Need</option>
                                <option value="5">Buy</option>
                            </select>
                            <span class="text-danger error-text getItType_error"></span>
                        </div>
                        {{-- Add Buy price  --}}
                        <div class="my-2" id="eaddBuy" style="display: none">
                            <label for="buy-price">Price</label>
                            <input type="text" name="price" id="eprice" class="form-control"
                                placeholder="Enter Buy Price">
                            <span class="text-danger error-text price_error"></span>
                        </div>
                        {{-- Person --}}
                        <div class="my-2">
                            <label for="person">Person</label>
                            <input type="text" name="quantity" id="equantity" class="form-control"
                                placeholder="Enter person">

                            <span class="text-danger error-text quantity_error"></span>
                        </div>

                        {{-- Category --}}
                        <div class="my-2">
                            <label for="category_id">Category</label>
                            <select class="form-control form-control-md form-select" name="category" id="ecategory"
                                onchange="EotherData()">
                                @foreach ($categoryName as $categoryValue)
                                    <option value="{{ $categoryValue->id }}">{{ $categoryValue->name }}</option>
                                @endforeach
                                <option value="0" class="bg-dark"><i class="fa fa-plus"></i>Others</option>
                            </select>
                            <span class="text-danger error-text category_error"></span>
                        </div>
                        {{-- Add new Category --}}
                        <div class="my-2" id="eAddcatgory" style="display: none">
                            <label for="addnewcategory">Add New Category</label>
                            <input type="text" name="Addcategory" class="form-control" placeholder="Enter Category">
                            <span class="text-danger error-text Addcategory_error"></span>
                        </div>
                        {{-- IMAGE --}}
                        <div class="my-2">
                            <label for="media">Image</label>
                            <input type="file" name="media" class="form-control">
                           <div  class="my-2" id="image" style="display: none"> 
                            <img src='' id="edit_image" width="180px;" height="120">
                           </div>
                           <div  class="my-2" id="imagenull" style="display: none">
                            <img id="nullimage" width="180px;" height="120">
                           </div>
                            <span class="text-danger error-text media_error"></span>
                        </div>
                        {{-- Requirement --}}
                        <div class="my-2">
                            <label for="requirement">Requirement</label>
                            <textarea class="form-control summernote" name="requirement" id="edit_requirement" cols="30" rows="10"
                                placeholder="Enter Requirement"></textarea>
                            <span class="text-danger error-text requirement_error"></span>
                        </div>
                        <div class="my-2">
                            <label for="getItType">Status</label>
                            <select class="form-control form-control-md form-select" name="status" id="estatus">
                                <option value="1">Pending</option>
                                <option value="2">Completed</option>
                            </select>
                            <span class="text-danger error-text status_error"></span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_requirement_btn" class="btn btn-success">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit Requirement modal end --}}

    <section class="user-section">
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="text-light">Manage Requirement</h3>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addRequirementModal"><i
                                    class="bi-plus-circle me-2"></i>Add New Requirement</button>
                        </div>
                        <div class="card-body" id="show_all_requirement">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
         $(document).ready(function() {
          $('.summernote').summernote();
        });
        $(document).ready(function() {
            EuserType()
            EgiveItType()
            EgetItType()
        });
        // Open Other Category Input Field
        function EotherData() {
            var selectVal = $('#ecategory').val();

            if (selectVal == 0) {
                $("#eAddcatgory").show().css('margin-bottom', 10);
            } else {
                $("#eAddcatgory").hide();
            }
        }

        // User Type
        function EuserType() {
            var selectVal = $('#etype').val();
            // alert(selectVal);
            if (selectVal == 1) {
                $('#egiveType').show().css('margin-bottom', 10);
            } else {
                $("#egiveType").hide();
                // $('#Adddonation').hide();
                $('#eaddSellPrice').hide();
                $('#eaddRentPrice').hide();
                $('#eaddRentDate').hide();
            }

            if (selectVal == 2) {
                $('#egetType').show().css('margin-bottom', 10);
            } else {
                $("#egetType").hide();
                $('#eaddBuy').hide();
            }
        }

        // Giveit Sub Type
        function EgiveItType() {
            var selectVal = $('#egiveItType').val();

            // sell Price show and hide
            if (selectVal == 2) {
                $('#eaddSellPrice').show().css('margin-bottom', 10);
            } else {
                $('#eaddSellPrice').hide();
            }

            // Rent Price,Date show and hide
            if (selectVal == 3) {
                $('#eaddRentPrice').show().css('margin-bottom', 10);
                $('#eaddRentDate').show().css('margin-bottom', 10);
            } else {
                $('#eaddRentPrice').hide();
                $('#eaddRentDate').hide();
            }
        }

        // Getit Sub Type
        function EgetItType() {
            var selectVal = $('#egetItType').val();
            // alert(selectVal);

            // Buy show and hide
            if (selectVal == 5) {
                $('#eaddBuy').show().css('margin-bottom', 10);
            } else {
                $('#eaddBuy').hide();

            }
        }

        // Open Other Category Input Field
        function OtherData() {
            var selectVal = $('#category').val();
            if (selectVal == 0) {
                $("#Addcatgory").show().css('margin-bottom', 10);
            } else {
                $("#Addcatgory").hide();
            }
        }

        // User Type
        function UserType() {
            var selectVal = $('#type').val();
            if (selectVal == 1) {
                $("#giveType").show().css('margin-bottom', 10);
            } else {
                $("#giveType").hide();
                $('#addSellPrice').hide();
                $('#addRentPrice').hide();
                $('#addRentDate').hide();

            }

            if (selectVal == 2) {
                $("#getType").show().css('margin-bottom', 10);
            } else {
                $("#getType").hide();
                $('#addBuy').hide();
            }

        }
        // Giveit Sub Type
        function GiveItType() {
            var selectVal = $('#giveItType').val();

            // Donation show and hide
            if (selectVal == 1) {
                $('#Adddonation').show().css('margin-bottom', 10);
            } else {
                $('#Adddonation').hide();
            }

            // sell Price show and hide
            if (selectVal == 2) {
                $('#addSellPrice').show().css('margin-bottom', 10);
            } else {
                $('#addSellPrice').hide();
            }

            // Rent Price,Date show and hide
            if (selectVal == 3) {
                $('#addRentPrice').show().css('margin-bottom', 10);
                $('#addRentDate').show().css('margin-bottom', 10);
            } else {
                $('#addRentPrice').hide();
                $('#addRentDate').hide();
            }
        }

        // Getit Sub Type
        function GetItType() {
            var selectVal = $('#getItType').val();

            // Buy show and hide
            if (selectVal == 5) {
                $('#addBuy').show().css('margin-bottom', 10);
            } else {
                $('#addBuy').hide();

            }
        }

        // fetch all Requirement ajax request
        fetchAllrequirement();

        function fetchAllrequirement() {
            $.ajax({
                url: '{{ route('requirement.fetchAll') }}',
                method: 'get',
                success: function(res) {
                    $("#show_all_requirement").html(res);
                    $("table").DataTable({
                        stateSave: true,
                        order: [1, 'ASC']
                    });
                }
            });
        }
        // delete Requirement ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('requirement.delete') }}',
                        method: 'post',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'Requirement Deleted Successfully!.',
                                'success'
                            )
                            fetchAllrequirement();
                        }
                    });
                }
            });
        });

        // Update Requirement ajax request
        $("#edit_requirement_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('requirement.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.error_text').text('');
                },
                success: function(res) {
                    Swal.fire(
                        'Updated!',
                        'Category Updated Successfully!',
                        'success'
                    )
                    fetchAllrequirement();

                    $("#edit_requirement_btn").text('Update Employee');
                    $("#edit_requirement_form")[0].reset();
                    $("#editRequirementModal").modal('hide');
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(prefix, val) {
                        $('.' + prefix + '_error').text(val[0]);
                    });
                    setTimeout(() => {
                        $('.error-text').hide();
                    }, 5000);
                },
            });
        });
        // Edit Requirement ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');

            $.ajax({
                url: '{{ route('requirement.edit') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.data['requirements']);
                    $("#Rid").val(res.data['id']);
                    $("#etype").val(res.data['type']);
                    $("#equantity").val(res.data['quantity']);
                    $("#ecategory").val(res.data['category_id']);
                    $("#estatus").val(res.data['status']);
                    $("#edit_requirement").html(res.data['requirements']);
                    $("#edit_requirement").css("display", "block");
                    if (res.data['type'] == 1) {
                        $("#egiveItType").val(res.data['subtype']);
                        $("#egiveType").css("display", "block");
                        $("#egetType").css("display", "none");
                        if (res.data['subtype'] == 1) {
                            $("#eaddSellPrice").css("display", "none");
                            $("#eaddRentDate").css("display", "none");
                            $("#eaddBuy").css("display", "none");
                        } else if (res.data['subtype'] == 2) {
                            $("#esellprice").val(res.data['price']);
                            $("#eaddSellPrice").css("display", "block");
                            $("#eaddRentDate").css("display", "none");
                        } else {
                            $("#eRentPrice").val(res.data['price']);
                            $("#eRentDate").val(res.data['rent_date']);
                            $("#eaddRentDate").css("display", "block");
                            $("#eaddRentPrice").css("display", "block");
                        }
                    } else {
                        $("#egetItType").val(res.data['subtype']);
                        $("#egetType").css("display", "block");
                        $("#egiveType").css("display", "none");
                        if (res.data['subtype'] == 4) {
                            $("#eaddBuy").css("display", "none");
                            $("#eaddRentDate").css("display", "none");
                            $("#eaddRentPrice").css("display", "none");
                        } else {
                            $("#eprice").val(res.data['price']);
                            $("#eaddBuy").css("display", "block");

                        }
                    }
                    if (res.media == null) {
                        $('#nullimage').attr('src','/img/requirement/Noimage.jpg');
                        $("#image").css("display", "none");
                        $("#imagenull").css("display", "block");
                      } else {
                          $("#edit_image").attr('src',res.media['path']);
                        $("#image").css("display", "block");
                        $("#imagenull").css("display", "none");
                      }
                },
            });
        });

        // Add new Requirement ajax request 
        $("#add_Requirement_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('requirement.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 1) {
                        Swal.fire(
                            'Added!',
                            'Requirement Added Successfully!',
                            'success'
                        )
                        fetchAllrequirement();
                    }
                    $("#add_requirement_btn").text('Add Category');
                    $("#add_Requirement_form")[0].reset();
                    $("#addRequirementModal").modal('hide');
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(prefix, val) {
                        $('.' + prefix + '_error').text(val[0]);
                    });
                },

            });
        });
    </script>
@endsection
