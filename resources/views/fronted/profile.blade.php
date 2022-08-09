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
        <div class="donation-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="donate-form">
                            <div class="form-title text-center">
                                <h3>My Profile</h3>
                            </div>
                            <hr>
                            <form action="{{ route('userupdateprofile') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Your Username</label>
                                            <input type="text" name="username" class="form-control" id="name"
                                                value="{{ $user->name }}">
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
                                    {{-- <div class="col-md-6">
                                        <div class="mb-3 position-reletive">
                                            <label for="name" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                data-toggle="password" name="password" >
                                            <i class="bi bi-eye-slash eye_ic" id="togglePassword"></i>
                                        </div>
                                        @if ($errors->has('password'))
                                            <p style="color:red">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 position-reletive">
                                            <label for="email" class="form-label">Conform Password</label>
                                            <input type="password" class="form-control" id="comform_password"
                                                data-toggle="password" name="password_confirmation"
                                                >
                                            <i class="bi bi-eye-slash eye_ic" id="toggleCPassword"></i>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <p style="color:red">{{ $errors->first('password_confirmation') }}</p>
                                        @endif
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone-number" class="form-label">Your Phone Number</label>
                                            <input type="number" class="form-control" id="phone-number" name="number"
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
                                            <i class="fa fa-key" data-toggle="modal" style="cursor: pointer;" data-target="#exampleModal" title="Change Password"></i>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-8 text-center" style="text-align-last: end">
                                    </div>
                                </div>
                            </form>
                                {{-- model --}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="form-title text-center" id="exampleModalLabel">Change Password</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('updatepassword')}}" method="POST">
                                                    @csrf
                                                   
                                                    <div>
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" name="password">
                                                        @if ($errors->has('password'))
                                                        <p class="alert alert-danger">{{$errors->first('password')}}</p>                                    
                                                    @endif
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control" name="password_confirmation">
                                                        @if ($errors->has('password_confirmation'))
                                                        <p class="alert text-danger">{{$errors->first('password_confirmation')}}</p>                                    
                                                    @endif
                                                    </div>
                                                    <br>
                                                    <button type="button" class="btn  donate-bt" data-dismiss="modal">Close</button>
                                                    <button class="btn  donate-bt" type="submit">Change Password</button>
                                                </form>
                                                
                                                {{-- @if(auth()->user()->name)
                                                    {{ auth()->user()->password }}
                                                @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--End model --}}   

















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
                                                
                                                <input type="hidden" class="serdelete_val_id" value="{{ $item['id'] }}">
                                                <td>{{ $item->categories['name'] }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                  <div class="d-flex">                                                   
                                                        <a class="btn" href="{{ route('edit', $item['id']) }}"><i
                                                            class="fa-solid fa-pen"></i></a>
                                                    <form method="POST" action="{{ route('delete', $item['id']) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn  show_confirm ml-2"
                                                            data-toggle="tooltip" title='Delete'style=" color: #ff0000 "><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {!! $required->links() !!}
                                <div class="pagination">
                                    <ul class="pagination-ul">
                                        <li>
                                            <a href=""><i class="fa fa-chevron-left"></i></a>
                                        </li>
                                        <li>
                                            <a href="" >1</a>
                                        </li>
                                        <li>
                                            <a href="?page=1">2</a>
                                        </li>
                                        <li>
                                            <a href="">3</a>
                                        </li>
                                        <li>
                                            <a href="">....</a>
                                        </li>
                                        <li>
                                            <a href="">10</a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fa fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                                <script type="text/javascript">
                                    $('.show_confirm').click(function(event) {
                                        var form = $(this).closest("form");
                                        var name = $(this).data("name");
                                        event.preventDefault();
                                        swal({
                                                title: `Are you sure you want to delete this record?`,
                                                text: "If you delete this, it will be gone forever.",
                                                icon: "warning",
                                                buttons: true,
                                                dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    form.submit();
                                                }
                                            });
                                    });
                                    const togglePassword = document.querySelector("#togglePassword");
                            const password = document.querySelector("#password");

                            togglePassword.addEventListener("click", function() {
                                // toggle the type attribute
                                const type = password.getAttribute("type") === "password" ? "text" : "password";
                                password.setAttribute("type", type);

                                // toggle the icon
                                this.classList.toggle("bi-eye");
                            });

                            const toggleCPassword = document.querySelector("#toggleCPassword");
                            const comform_password = document.querySelector("#comform_password");

                            toggleCPassword.addEventListener("click", function() {
                                // toggle the type attribute
                                const type = comform_password.getAttribute("type") === "password" ? "text" : "password";
                                comform_password.setAttribute("type", type);

                                // toggle the icon
                                this.classList.toggle("bi-eye");
                            });


                                    
                                </script>
                            </section>
                            @include('fronted.js')

                        </div>

                    </div>
                </div>
    </body>


@endsection
