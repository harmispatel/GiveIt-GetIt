@extends('common.layout')

@section('title', 'Users')

@section('content')

    {{-- add new user modal start --}}
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_User_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        {{-- <div class="row"> --}}
                        <div class="my-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ old('name') }}">
                            <span class="text-danger error-text name_error"></span>

                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail"
                                value="{{ old('email') }}">
                            <span class="text-danger error-text email_error"></span>


                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="mobile" class="form-control" placeholder="Phone"
                                value="{{ old('mobile') }}">
                            <span class="text-danger error-text mobile_error"></span>


                        </div>
                        <div class="my-2">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="exampleFormControlTextarea4" rows="3"
                                placeholder="Enter Address" value="{{ old('address') }}"></textarea>
                            <span class="text-danger error-text address_error"></span>
                        </div>
                        <div class="my-2">
                            <label for="user-type">User_type</label>
                            <select class="form-control form-control-md form-select" name="user_type"
                                value="{{ old('user_type') }}">
                                <option value="">Select User</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                            <span class="text-danger error-text user_type_error"></span>
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
                        <div class="my-2">
                            <label for="password">password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password"  data-toggle="password"
                                value="{{ old('password') }}">

                            <span class="text-danger error-text password_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add new user modal end --}}

    {{-- edit user modal start --}}
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_User_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emp_id" id="emp_id">
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="my-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="E-mail">
                            <span class="text-danger error-text email_error"></span>


                        </div>
                        <div class="my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" name="mobile" id="mobile" class="form-control"
                                placeholder="Phone">
                            <span class="text-danger error-text mobile_error"></span>


                        </div>
                        <div class="my-2">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter Address"></textarea>
                            <span class="text-danger error-text address_error"></span>

                        </div>
                        <div class="my-2">
                            <label for="user-type">User_type</label>
                            <select class="form-control form-control-md form-select" id="user_type" name="user_type">
                                <option value="">Select User</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                            <span class="text-danger error-text user_type_error"></span>
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
                        <button type="submit" id="edit_employee_btn" class="btn btn-success">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit user modal end --}}

    <section class="user-section">
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="text-light">Manage User</h3>
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                                    class="bi-plus-circle me-2"></i>Add New User</button>
                        </div>
                        <div class="card-body" id="show_all_users">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
<script type="text/javascript">
      $("#password").password('toggle');
  
        // fetch all User ajax request
        fetchAlluses();

        function fetchAlluses() {
            $.ajax({
                url: '{{ route('user.fetchAll') }}',
                method: 'get',
                success: function(res) {
                    $("#show_all_users").html(res);
                    $("table").DataTable({
                        stateSave: true,
                        order: [1, 'ASC']
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
                        url: '{{ route('user.delete') }}',
                        method: 'post',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'User Deleted Successfully!.',
                                'success'
                            )
                            fetchAlluses();
                        }
                    });
                }
            });
        });
        // update user ajax request
        $("#edit_User_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('user.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(res) {
                    Swal.fire(
                        'Updated!',
                        'User Updated Successfully!',
                        'success'
                    )
                    fetchAlluses();

                    $("#edit_employee_btn").text('Update Employee');
                    $("#edit_User_form")[0].reset();
                    $("#editEmployeeModal").modal('hide');
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

        // Edit User ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('user.edit') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    $('#emp_id').val(res.id);
                    $('#name').val(res.name);
                    $('#email').val(res.email);
                    $('#mobile').val(res.mobile);
                    $('#address').val(res.address);
                    $('#user_type').val(res.user_type);
                    $('#status').val(res.status);
                },

            });
        });
        // Add new User ajax request 
        $("#add_User_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('user.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 1) {
                        Swal.fire(
                            'Added!',
                            'User Added Successfully!',
                            'success'
                        )
                        fetchAlluses();
                    }
                    $("#add_employee_btn").text('Add Employee');
                    $("#add_User_form")[0].reset();
                    $("#addEmployeeModal").modal('hide');
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(prefix, val) {
                        $('.' + prefix + '_error').text(val[0]);
                    });
                    setTimeout(() => {
                        $('.error-text').remove();
                    }, 5000);
                },

            });
        });
    </script>
@endsection
