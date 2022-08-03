@extends('fronted.layout')

@section('title', 'Give It & Get It - Register')

@section('content')

    <body>
        <div class="donation-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
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
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Select Type</label>
                                            <input class="form-control" name="user_type"
                                                value="{{ $user->user_type == '1' ? 'Give IT' : 'Get IT' }}">
                                        </div>
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
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-8 text-center" style="text-align-last: end">

                                    </div>
                                </div>
                            </form>
                            <div class="form-title text-center">
                                <h3>My Requiement</h3>
                            </div>
                            <hr>
                            <section class="user-info-main">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Person</th>
                                            <th>CreatedDate</th>
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
                                                <td><a href="{{ route('edit', $item['id']) }}"><i
                                                            class="fa-solid fa-pen"></i></a>
                                                    <form method="POST" action="{{ route('delete', $item['id']) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn  btn-flat show_confirm ml-2"
                                                            data-toggle="tooltip" title='Delete'
                                                            style="background-color: #ff0000;
                                                                color: #fff "><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
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
                                </script>
                            </section>
                            @include('fronted.js')

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
                        </div>
                    </div>
                </div>
    </body>


@endsection
