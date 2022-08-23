@extends('common.layout')

@section('title', 'Categories')

@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            .card {
                width: 100%;
            }
        </style>

    </head>

    <body>

        <div class="content-wrapper">
            <div style="padding-top: 25px">

                {{-- Success messege --}}
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                {{-- End Success messege --}}

                <div class="text-right mr-3 mb-2">
                    <a href="{{ route('category.create') }}" class="btn btn-primary"> <i class="fa fa-plus"
                            aria-hidden="true"></i> Add Category</a>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header text-right">
                                        <h3 class="card-title">Categories</h3>
                                        <a class="btn btn-danger" href="">Delete</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-right">Checked</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th colspan="2" class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr id="tr_{{$category->id}}">
                                                        {{-- <td>
                                                        class="form-check-input"
                                                                <input class="form-check-input" type="checkbox" id="checkboxNoLabel" value="" aria-label="..." />
                                                            
                                                        </td> --}}
                                                        <td class="text-right">
                                                            <input type="checkbox" name="deleteCategory[]" class="sub_chk" data-id="{{$category->id}}">
                                                        </td>
                                                        <td>{{ $category->name }}</td>
                                                        {{-- <td>{{$category->status}}</td> --}}
                                                        <td>
                                                            <span
                                                                class="{{ $category['status'] == 0 ? 'badge badge-danger' : 'badge badge-success' }}">
                                                                {{ $category['status'] == 0 ? 'Inactive' : 'Active' }}
                                                            </span>
                                                        </td>
                                                        <td class="text-right">
                                                            <a href="{{ route('category.edit', $category->id) }}"class="mr-2" title="Edit"><i class="fas fa-edit"></i></a>       
                                                            <i class="fa fa-trash text-danger deleteBtn"  data-toggle="modal" style="cursor: pointer;" data-target="#exampleModal" data-target-id="{{route('category.destroy',$category->id)}}" title="Delete"></i>
                                                            {{-- <a class="btn btn-danger" role="button"  data-toggle="modal" data-target="#exampleModal">Delete</a> --}}

                                                            {{-- <a href="{{route('category.destroy',$category->id)}}">
                                                                Delete
                                                            </a> --}}
                                                        </td>
                                                    </tr>
                                                    {{-- model --}}
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure to delete this category?
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
                                                    {{-- End model --}}
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
    </body>

    </html>


@endsection
