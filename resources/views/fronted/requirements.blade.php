<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap User Management Data Table</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 15px;
    background: #299be4;
    color: #fff;
    padding: 16px 30px;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}
.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}
.table-title .btn {
    color: #566787;
    float: right;
    font-size: 13px;
    background: #fff;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}
.table-title .btn:hover, .table-title .btn:focus {
    color: #566787;
    background: #f2f2f2;
}
.table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
}
.table-title .btn span {
    float: left;
    margin-top: 2px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}
table.table tr th:first-child {
    width: 60px;
}
table.table tr th:last-child {
    width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}	
table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
}
table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
}
table.table td a:hover {
    color: #2196F3;
}
table.table td a.settings {
    color: #2196F3;
}
table.table td a.delete {
    color: #F44336;
}
table.table td i {
    font-size: 19px;
}
table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
}
.status {
    font-size: 30px;
    margin: 2px 2px 0 0;
    display: inline-block;
    vertical-align: middle;
    line-height: 10px;
}
.text-success {
    color: #10c469;
}
.text-info {
    color: #62c9e8;
}
.text-warning {
    color: #FFC107;
}
.text-danger {
    color: #ff5b5b;
}
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 13px;
    min-width: 30px;
    min-height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 2px !important;
    text-align: center;
    padding: 0 6px;
}
.pagination li a:hover {
    color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}
.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}
</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
@if(session()->has('userlogin'))
<div class="alert alert-success">
    {{ session()->get('userlogin') }}
</div>
@endif
<body>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if(session()->has('updatedata'))
<div class="alert alert-success">
    {{ session()->get('updatedata') }}
</div>
@endif

@if(session()->has('messagedelete'))
<div class="alert alert-danger">
    {{ session()->get('messagedelete') }}
</div>
@endif
<div class="container-xl">
  
    <div class="table-responsive">
        <div class="table-wrapper text-center">
            <div class="table-title">
                <h2>Requirement <b>list</b></h2>
                <div class="row">
                    <div class="col-sm-4">
                        <form class="form-inline">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            
                            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
                              aria-label="Search">
                          </form>
                    </div>
                    <div class="col-sm-2">
                       
                        <select id='checkstatus' class="form-control" style="width: 150px"  name="checkstatus">
                            <option value=" ">--Select Status--</option>
                            <option value="1">Pending</option>
                            <option value="0">Completed</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                       
                       
                    </div>
                    <div class="col-sm-4">

                        <form method="POST" action="{{route('userlogout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary" name="submit">Logout</button>
                        </form>
                       					
                        <a href="{{route('insertform')}}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Requirement</span></a>
                    </div>
                </div>
                    </div>
                    <div class="col-sm-7">
                        

                       
                       
            </div>
            {{-- <div>
                <img src="{{ asset('/img/requirement/1658993514_p8.jpg') }}" alt="TEST">
            </div> --}}
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>

                        <th>Category</th>
                        <th>Requirement</th>
                        <th>Type</th>						
                        <th>Quantity</th>
                        <th>status</th>
                        
                        <th style="width: 30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                       
                    @foreach($data as $items)
                    <tr>
                       <input type="hidden" class="serdelete_val_id" value="{{$items['id']}}">
                       <td>
                        <img src="{{ $items->media == null ? asset('/img/requirement/Noimage.jpg') : asset($items->media['path']) }}" alt="Image" width="150">
                       </td>
                        <td>{{$items->categories['name']}}</td>
                        <td>{!!html_entity_decode($items->requirements)!!}</td>
                        <td>{{$items->type == '1' ? 'Give IT' : 'Get IT' }}</td>
                        <td>{{$items->quantity}}</td>                        
                        <td>{{$items->status  == '1' ? 'Pending' : 'Completed' }}</td>
                        {{-- <td>
                            <span class="status {{ $items->is_active == '1' ? 'text-success' : 'text-danger' }}">
                                &bull;
                            </span>
                            {{$items->is_active  == '1' ? 'Active' : 'Inactive' }}
                        </td>
                        <td> --}}
  
                            
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('edit', $items['id'])}}" class="btn btn-sm btn-warning" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i><span></span></a>
                            
                                    <form method="POST" action="{{ route('delete', $items['id']) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm ml-2" data-toggle="tooltip" title='Delete'><i class="material-icons">&#xE872;</i></button>
                                    </form>
                                </div>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  {{-- Delete warning message --}}
  <script type="text/javascript">
 
    $('.show_confirm').click(function(event) {
         var form =  $(this).closest("form");
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
     function Status() {
            var selectVal = $('#checkstatus :selected').val();
            alert(selectVal)
                   
            if (selectVal == 0) {
        //         .show();
            } else {
        //         $("#addcatgory").hide();
            }
        }
       
</script>
{{-- <script>
$(document).ready(function(){
    $("#checkstatus").on('change',function(){
         var checkstatus = $(this).val();
         $.ajax({
            url: "{{ route('filter')}}",
            type:"GET",
            data: {'checkstatus' :checkstatus}
            success:function(data){
                console.log(data);
            }
         });
    });
});

</script> --}}
 

</div>     
</body>
</html>