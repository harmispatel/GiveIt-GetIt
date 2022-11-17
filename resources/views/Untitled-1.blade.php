<div class="content-wrapper">
    <div style="padding-top: 25px">

        {{-- Success messege --}}
        @if(session()->has('message'))
            <div class="alert alert-success">
                 {{ session()->get('message') }}
            </div>
        @endif

        {{-- Success messege --}}
        @if(session()->has('msg'))
            <div class="alert alert-success">
                 {{ session()->get('msg') }}
            </div>
        @endif
        {{-- End Success messege --}}
        
        <div class="text-right mr-3 mb-2">
            <a href="{{route('user.create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add User</a>
        </div>
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>User type</th>
                        <th>Status</th>
                        
                        <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user['name']}}</td>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['mobile']}}</td>
                            <td>{{$user['address']}}</td>
                            <td>
                                @if ( $user['user_type'] == 0)
                                    <span>
                                        {{ $user['user_type'] =  'User'}}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="{{ $user['status'] == 0 ? 'badge badge-danger' : 'badge badge-success' }}">
                                    {{ $user['status'] == 0 ? 'Inactive' : 'Active' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{route('user.edit',$user->id)}}" class="mr-2" title="Edit"><i class="fas fa-edit"></i></a>
                                <i class="fa fa-trash text-danger deleteBtn" data-toggle="modal" style="cursor: pointer;" data-target="#exampleModal" data-target-id="{{route('user.destroy',$user->id)}}" title="Delete"></i>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    </table>
                    {{-- model --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete this user?
                                </div>
                                <div class="modal-footer">
                                    {{-- {{ route('propertie.destroy',$propertiesData->id) }} --}}
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="" id="deleteForm" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" name="delete" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- model --}}
            <span class="mb-3">
                {!! $users->links() !!} 
            </span>
            <style>
                .w-5 {
                    display:none;
                }
            </style>
                </div>
                </div>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(function(){
                    $('.deleteBtn').click(function() {
                        var url = $(this).attr("data-target-id")
                        $("#deleteForm").attr('action', url);
                    });
                });
            </script>
    </div>
</div>




public function store(UserRequest $request)
{
    // Insert Create User Data

    $createUser = new User();
    $createUser->name = $request->name;
    $createUser->email = $request->email;
    $createUser->mobile = $request->mobile;
    $createUser->address = $request->address;
    $createUser->user_type = $request->user_type;
    $createUser->password = $request->password;
    $createUser->status = $request->status;
    $createUser->save();

    return redirect()->route('user.index')->with('message', 'User added successfully!');
}