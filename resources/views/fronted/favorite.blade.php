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



        <div class="main">

    </section>
    <section class="get_details">
        <div class="container">
            <div class="row">
                @if (!$data->isEmpty())
                @foreach ($data as $item)
                    <div class="col-md-4">
                        <input type="hidden" class="serdelete_val_id" value="{{ $item['id'] }}">
                        <div class="get_detalis_inr">
                            <div class="get_detalis_img text-center">
                                <div class="get_img">
                                    <img
                                        src="{{ $item->requirement->media == null
                                            ? asset('/img/requirement/Noimage.jpg')
                                            : asset($item->requirement->media['path']) }}">
                                </div>
                            </div>
                            <div class="get_detalis_info">
                                {{-- <label>{{ $item->user['name'] }}</label> --}}
                                    {{-- <p>Category: {{ $item->requirement->categories['name'] }}</p> --}}
                                    <p>{!!html_entity_decode($item->requirement['requirements'])!!}</p>
                                {{-- <p>MO : {{ $item->user['mobile'] }}</p>
                                <p>Email : <a href="mailto:{{ $item->user['email'] }}">{{ $item->user['email'] }}</a></p> --}}

                                <div class="d-flex">
                                    <form method="POST" action="{{ route('delete', $item['id']) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn  show_confirm ml-2" data-toggle="tooltip"
                                            title='Delete'style=" color: #ff0000 "><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p style="text-align: center;FONT-SIZE: large">No Data Whishlist Recode</p>
                    @endif
              
            </div>
        </div>
    </section>
    </div>
    {{-- {{$data}} --}}


    {{-- <div class="d-flex">
                     <form method="POST" action="{{ route('delete', $item['id']) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn  show_confirm ml-2"
                                    data-toggle="tooltip"
                                    title='Delete'style=" color: #ff0000 "><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div> --}}

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
