@extends('fronted.layout')

@section('title', 'Give It & Get It - Give It')

@section('content')

    <div class="main">
        <section class="page-title">
            <div class="container">
                <h2>GIVE IT</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('giveit') }}">Give IT</a></li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="categories get-info">
            <div class="container">
                <div class="get-slider">
                    <div class="sec-title">
                        <h2>Give IT</h2>
                        <p>The one who gives charity is greater than, the one who talks about giving charity.</p>
                    </div>
                    <div class="categories-swiper">
                        <div class="swiper-button-next"><i class="fa fa-chevron-right"></i></div>
                        <div class="swiper-button-prev"><i class="fa fa-chevron-left"></i></div>
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <a class="swiper-slide" href="#">
                                    <div class="img">
                                        <img class="img-fluid" src="{{ asset('img/fronted/food_img.png') }}" />
                                    </div>
                                </a>
                                <a class="swiper-slide" href="#">
                                    <div class="img">
                                        <img class="img-fluid" src="{{ asset('img/fronted/book_img.png') }}" />
                                    </div>
                                </a>
                                <a class="swiper-slide" href="#">
                                    <div class="img">
                                        <img class="img-fluid" src="{{ asset('img/fronted/cloth-img.jpg') }}" />
                                    </div>
                                </a>
                                <a class="swiper-slide" href="#">
                                    <div class="img">
                                        <img class="img-fluid" src="{{ asset('img/fronted/toy_img.jpg') }}" />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="get_details">
            <div class="container">
                <div class="row" id="post-data">
                    @include('fronted.giveitdata')
                </div>
            </div>
            <div id="loader" style="display:block ; background: rgb(255, 255, 255);">
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
            <div class="ajax-load text-center" style="display:none">
                <p><img src="{{ asset('img/fronted/200w.gif') }}">Loading......</p>
            </div>
        @section('js')
            <script type="text/javascript">
                var page = 1;
                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                        page++;
                        loadMoreData(page);
                    }
                });
                function loadMoreData(page) {
                    $.ajax({
                            url: '?page=' + page,
                            type: "get",
                            beforeSend: function() {
                                $('.ajax-load').show();
                             }
                        })
                        .done(function(data) {
                            if (data.html == '') {
                                $('.ajax-load').html("");
                            } else {
                                $('.ajax-load').hide();
                                $("#post-data").append(data.html);
                            }
                        })
                        .fail(function(jqXHR, ajaxOptions, thrownError) {
                            alert('server not responding...');
                        });
                }
            </script>
        @endsection
    </section>
</div>

@endsection
