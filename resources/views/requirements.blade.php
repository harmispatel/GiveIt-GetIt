@extends('common.layout')

@section('title', 'Requirements')

@section('content')

    <div class="content-wrapper">
        <div style="padding-top: 25px">
            {{-- Success messege --}}
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            {{-- End Success messege --}}
            <div class="container">
                <div class="row post-grid">
                    <div class="col col-md-4">
                        <div>
                            <div class="form-outline">
                                {{-- <form action="" method="GET"> --}}
                                    <input type="search" id="search" name="search" class="form-control" placeholder="search category" />
                                    {{-- <button class="btn btn-primary" type="submit">Search</button> --}}
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col col-md-4">
                        <div class="form-group">
                            <select id="status" class="form-control form-control-md" name="filterStatus">
                                <option value="">All Status</option>
                                <option value="1">Pending</option>
                                <option value="2">Completed</option>
                            </select>
                        </div>
                    </div>

                    {{-- Add Requirement --}}
                    <div class="col col-md-4 ">
                        <div class="text-right mr-3 mb-2">
                            <a href="{{ route('requirement.create') }}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Requirement</a>
                        </div>
                    </div>  
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Requirements</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Media</th>
                                                <th>Category</th>
                                                <th>Person</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                {{-- <th>Is Active?</th> --}}
                                                <th colspan="2" class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody id="tableBody">
                                            {{-- Forelse --}}
                                            @forelse ($requirementsData as $requirement) 
                                                <tr>
                                                    <td>
                                                        <img src="{{ $requirement->media == null ? asset('/img/requirement/Noimage.jpg') : asset($requirement->media['path']) }}" alt="Image" width="100">
                                                    </td>
                                                    <td>{{$requirement->category->name}}</td>
                                                    {{-- <td>{!!html_entity_decode($requirement->requirements)!!}</td> --}}
                                                    <td>{{ $requirement['quantity'] }}</td>
                                                    <td>
                                                        <span class="{{ $requirement['type'] == 2 ? 'badge badge-danger' : 'badge badge-success' }}">
                                                            {{ $requirement['type'] == 2 ? 'Getit' : 'Giveit' }}
                                                        </span>
                                                    
                                                    </td>
                                                    <td>
                                                        <span class="{{ $requirement['status'] == 1 ? 'badge badge-success' : 'badge badge-danger' }}">
                                                                    {{ $requirement['status'] == 1 ? 'Pending' : 'Completed' }}
                                                        </span>
                                                    </td>
                                                    {{-- <td>
                                                        <span class="{{ $requirement['is_active'] == 1 ? 'badge badge-success' : 'badge badge-danger' }}">       
                                                                    {{ $requirement['is_active'] == 1 ? 'Active' : 'In Active' }}
                                                        </span>
                                                    </td> --}}
                                                    <td class="text-right">
                                                        <a href="{{ route('requirement.edit', $requirement->id) }}" class="mr-2" title="Edit"><i class="fas fa-edit"></i></a>
                                                        <i class="fa fa-trash text-danger deleteBtn" data-toggle="modal" style="cursor: pointer;" data-target="#exampleModal" data-target-id="{{route('requirement.destroy',$requirement->id)}}" title="Delete"></i>
                                                                    
                                                    </td>
                                                </tr>
                                                @empty
                                                  <p>No users</p>
                                            @endforelse
                                            {{-- End Forelse --}}
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
                                                    Are you sure to delete this requirement?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="" id="deleteForm" method="POST" class="d-inline">  
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                            
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {{--End model --}}
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        {{-- Ajax Call: Status --}}

        <script type="text/javascript">
            $(document).ready(function() {

                var app_url = '{{url('')}}';
                console.log('app url : ', app_url)

                $('#status').on('change', function() {
                    var status = $(this).val();
                    
                    $.ajax({
                        url: "{{ url('filterStatus') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'filterStatus': status,
                        },
                        success: function(data) {
                            console.log(data);
                            $('#tableBody').html('');

                            console.log(data.requirements.length);
                           
                            $.each(data.requirements, function( key, value ) 
                            {   

                                var img = app_url+value?.medias?.path;
                                var imges = value?.medias?.path;
                                var noimg = app_url+'/img/requirement/Noimage.jpg';

                                $("#tableBody").append('<tr>');
                                    if (imges == null || img == undefined) {
                                    
                                        $("#tableBody").append('<td><img width="100px" src="'+noimg+'"></td>');
                                    }
                                    else{
                                        
                                        $("#tableBody").append('<td><img width="100px" src="'+img+'"></td>');
                                    
                                    }
                                
                                
                                    $("#tableBody").append('<td>'+value.category.name+'</td>');
                                    $("#tableBody").append('<td>'+value['quantity']+'</td>');
                                    $("#tableBody").append(
                                                            
                                                        `
                                                            <td>
                                                                <span class="${value.type == '1' ? 'badge badge-success':'badge badge-danger  '}">
                                                                    ${value.type == '1' ? 'Giveit':'Getit'}
                                                                </span>
                                                        </td>
                                                        `
                                                            );                       
                                    $("#tableBody").append(
                                                        `
                                                            <td>
                                                                <span class="${value.status == 1 ? 'badge badge-success' : 'badge badge-danger'}">
                                                                    ${value.status == '1' ? 'Pending':'Completed'}
                                                                </span>
                                                            </td>
                                                        `
                                                    );
                                    
                                    $("#tableBody").append(
                                                        `
                                                        <td class="text-right">
                                                            <a href=""><i class="fas fa-edit "></i></a>&nbsp;&nbsp;
                                                            <a href=""><i class="fas fa-trash text-danger deleteBtn"></i><a>
                                                        </td>
                                                        `
                                                        
                                                    );
                                $("#tableBody").append('</tr>');
                            });
                        }
                    });

                });
   
            });
        </script>

        {{-- Ajax Call: Seraching --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $('#search').on('keyup', function() {
                    var searchString = $(this).val();
                   
                    $.ajax({
                        url: "{{ url('search') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'searchString': searchString
                        },
                        success: function(data) {
                            console.log(data);
                            $('#tableBody').html('');
                            $('#tableBody').append( data.output);

                        }
                    });
                });
            });
        </script>


        </body>       
    </html>        
@endsection
        


  







