@extends('common.layout')

@section('title', 'Categories')

@section('content')
    {{-- add new employee modal start --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_Category_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        {{-- <div class="row"> --}}
                        <div class="my-2">
                            <label for="name">Category</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ old('name') }}">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="my-2">
                            <label for="user-type">Status</label>
                            <select class="form-control form-control-md form-select" name="status"
                                value="{{ old('status') }}">
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                            <span class="text-danger error-text status_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_Category_btn" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add new employee modal end --}}

    {{-- edit employee modal start --}}
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_Category_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="Cid" id="Cid">
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="my-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="user-type">Status</label>
                            <select class="form-control form-control-md form-select" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                            <span class="text-danger error-text status_error"></span>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_category_btn" class="btn btn-success">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit employee modal end --}}

    <section class="user-section">
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="text-light">Manage Category</h3>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i
                                    class="bi-plus-circle me-2"></i>Add New Category</button>
                        </div>
                        <div class="card-body" id="show_all_categories">
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
        // fetch all Category ajax request
        fetchAllcategory();

        function fetchAllcategory() {
            $.ajax({
                url: '{{ route('category.fetchAll') }}',
                method: 'get',
                success: function(res) {
                    $("#show_all_categories").html(res);
                    $("#dtable").DataTable({
                        stateSave: true,
                        order: [1 , 'ASC']
                    });

                }
            });
        }

        // delete User ajax request
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
                        url: '{{ route('category.delete') }}',
                        method: 'post',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'Category Deleted Successfully!.',
                                'success'
                            )
                            fetchAllcategory();
                        }
                    });
                }
            });
        });
        // Update  Category ajax request
        $("#edit_Category_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);

            $.ajax({
                url: '{{ route('category.update') }}',
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
                      fetchAllcategory();
                    $("#edit_category_btn").text('Update Employee');
                    $("#edit_Category_form")[0].reset();
                    $("#editCategoryModal").modal('hide');
                    // $("#dtable").DataTable().ajax.reload(null, false);
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
        // Edit Category ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('category.edit') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    $('#Cid').val(res.id);
                    $('#name').val(res.name);
                    $('#status').val(res.status);
                },
            });
        });
        // Add new Category ajax request 
        $("#add_Category_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('category.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 1) {
                        Swal.fire(
                            'Added!',
                            'Category Added Successfully!',
                            'success'
                        )
                        fetchAllcategory();
                    }
                    $("#add_Category_btn").text('Add Category');
                    $("#add_Category_form")[0].reset();
                    $("#addCategoryModal").modal('hide');
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
