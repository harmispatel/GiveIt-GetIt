@extends('fronted.layout')

@section('title', 'Give It & Get It - Register')

@section('content')

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
        @if (session()->has('updatepassword'))
            <div class="alert alert-success updatepassword">
                {{ session()->get('updatepassword') }}
            </div>
        @endif
        @if (session()->has('mistake'))
        <div class="alert alert-warning mistake ">
            {{ session()->get('mistake') }}
        </div>
    @endif
    
    @if (session()->has('messagedelete'))
    <div class="alert alert-warning messagedelete ">
        {{ session()->get('messagedelete') }}
    </div>
@endif
        <div class="donation-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="donate-form">
                            <div class="form-title text-center">
                                <h3>My Profile</h3>
                            </div>
                            <hr>
                            <form action="{{ route('userupdateprofile') }}" id="userupdate" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Your Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                            id="name" value="{{ $user->name }}">
                                        </div>
                                        @if ($errors->has('username'))
                                        <p style="color:red">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Your Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <p style="color:red">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone-number" class="form-label">Your Phone Number</label>
                                                <input type="number" class="form-control" id="number" name="number"
                                                value="{{ $user->mobile }}">
                                        </div>
                                        @if ($errors->has('number'))
                                            <p style="color:red">{{ $errors->first('number') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Address</label>
                                            <textarea class="form-control" name="address" placeholder="Your Address" id="note" rows="5">{{ $user->address }}</textarea>
                                        </div>
                                        @if ($errors->has('address'))
                                            <p style="color:red">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn donate-bt">Update</button>
                                            <a class="btn donate-bt update">Update Password</a>
                                            {{-- <a href="{{route('changepassword')}}"> <i class="fa fa-key"style="cursor: pointer;"  title="Change Password"></i></a> --}}
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-8 text-center" style="text-align-last: end">
                                    </div>
                                </div>
                            </form>
                            <div class="changepassword" style="display: none">
                                <form action="{{ route('updatepassword') }}" id="cpassword" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control password" id="password"
                                                    data-toggle="password" name="password">
                                                <i class="bi bi-eye-slash eye_ic" id="togglePassword"></i>
                                            </div>
                                            @if ($errors->has('password'))
                                                <p style="color:red">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="comfomPassword" class="form-label">conform Password</label>
                                                <input type="password" class="form-control comform_password"
                                                    id="comforom_password" data-toggle="password"
                                                    name="password_confirmation">
                                                <i class="bi bi-eye-slash eye_ic" id="toggleCPassword"></i>
                                            </div>
                                            @if ($errors->has('password_confirmation'))
                                                <p style="color:red">{{ $errors->first('password_confirmation') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn donate-bt">Change Password</button>
                                        </div>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                            <div class="form-title row g-5">
                                <div class="col">
                                    <h3>My Requiement</h3>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('addform') }}" class="give_bt">Add Requirement</a>
                                </div>
                                <br>
                            </div>
                            <hr>
                            <section class="user-info-main">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Person</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($required as $item)
                                            <tr>
                                                <input type="hidden" class="serdelete_val_id"
                                                    value="{{ $item['id'] }}">
                                                <td>{{ $item->categories['name'] }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn" href="{{ route('edit', $item['id']) }}"><i
                                                                class="fa-solid fa-pen"></i></a>
                                                        <i class="fa fa-trash text-danger deleteBtn mt-2" data-toggle="modal" style="cursor: pointer;" data-target="#exampleModal" data-target-id="{{route('deleteRequirement',$item['id'])}}" title="Delete"></i>
                                                     
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <span>
                                    {!! $required->links() !!}

                                </span>
                                <style>
                                    .w-5 {
                                        display: none;
                                     }
                                </style>
                                {{-- model --}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete Requirement</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to delete this requirement?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="" id="deleteForm" method="POST" class="d-inline">  
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                        
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{--End model --}}

                                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                                <script type="text/javascript">
                                 $(function(){
                    $('.deleteBtn').click(function() {
                        var url = $(this).attr("data-target-id")
                        $("#deleteForm").attr('action', url);
                    });
                });
                                    setTimeout(() => {
                                        $('.updatepassword, .mistake, .messagedelete').remove();
                                    }, 3500);
                                </script>

                            </section>

                        </div>

                    </div>
                </div>
    </body>


@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".update").click(function() {
                $(".changepassword").toggle();
            });
        });


        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector(".password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const toggleCPassword = document.querySelector("#toggleCPassword");
        const comform_password = document.querySelector(".comform_password");

        toggleCPassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = comform_password.getAttribute("type") === "password" ? "text" : "password";
            comform_password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
        $(document).ready(function() {
            $("#cpassword").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Specify password",
                        minlength: "Password must be 6 length"
                    },
                    password_confirmation: {
                        required: "Password Confirmation is required",
                        minlength: "Password must be 6 length",
                        equalTo: "Password Confirmation does not match with Password"
                    }
                }

            });
        });
        $(document).ready(function() {
            $("#userupdate").validate({
                rules: {
                    username: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    number: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    address: {
                        required: true,
                    },
                },
                messages: {
                    username: {
                        required: "Name is required"
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address",
                    },
                    number: {
                        required: "Mobile No. is required",
                        minlength: "Mobile No. must be 10 digits",
                        maxlength: "Mobile No. must be 10 digits",
                        number: "Mobile No. is not valid"
                    },
                    address: {
                        required: "Address is required"
                    },
                },
            });
        });
    </script>
@endsection
