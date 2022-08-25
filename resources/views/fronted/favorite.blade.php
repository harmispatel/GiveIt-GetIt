@extends('fronted.layout')

@section('title', 'Give It & Get It -ViewRequirement')

@section('content')

<section class="user-info-main">
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
    @if (session()->has('messagedelete'))
    <div class="alert alert-danger messagedelete">
        {{ session()->get('messagedelete') }}
    </div>
@endif

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Requiement</th>
             
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- {{$data}} --}}
            @foreach ($data as $item)
                <tr>
                    {{-- {{$item}} --}}
                    {{-- <img src="{{ $item->requirement->media == null ? asset('/img/requirement/Noimage.jpg') : asset($item->requirement->media['path']) }}" > --}}
                    <input type="hidden" class="serdelete_val_id"
                    value="{{ $item['id'] }}">
                    <td><img src="{{ $item->requirement->media == null ? asset('/img/requirement/Noimage.jpg') : asset($item->requirement->media['path']) }}" >
                    </td>
                    <td>{!!html_entity_decode($item->requirement['requirements'])!!}</td>
                    <td>{{$item->requirement['quantity']}}</td>
                    <td>
                        <div class="d-flex">
                     <form method="POST" action="{{ route('delete', $item['id']) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn  show_confirm ml-2"
                                    data-toggle="tooltip"
                                    title='Delete'style=" color: #ff0000 "><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
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
                                    setTimeout(() => {
                                        $('.messagedelete').remove();
                                    }, 3500);
    </script>
</section>
@endsection
