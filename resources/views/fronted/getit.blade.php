@extends('fronted.layout')

@section('title', 'Give It & Get It - Get IT')

@section('content')

    <div class="main">
        <section class="page-title">
            <div class="container">
                <h2>GET IT</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="welcome">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="getit">GET IT</a></li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="categories get-info">
            <div class="container">
                <div class="get-slider">
                    <div class="sec-title">
                        <h2>Get IT</h2>
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-3">
                            <input type="text" class="form-control search" id="search" name="search"
                                placeholder="Search here" onkeyup="requirements()">
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <select class="form-select sortby" id="sortby" name="sortby" onchange="requirements()">
                                <option value="">select sortby</option>
                                <option value="1">ascending</option>
                                <option value="2">descending</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-12 mb-3">
                            @auth
                            {{-- {{$user->email}} --}}
                            @if ($user->email == null || $user->mobile == null)
                            <div class="text-end">
                                <a href="{{ route('editprofile') }}" class="give_bt">Add Requirement</a>
                            </div>
                            @else
                            <div class="text-end">
                          <a href="{{ route('addform') }}" class="give_bt">Add Requirement</a>
                      </div>
                            @endif                       
                            @endauth
                            @guest
                                <div class="text-end">
                                    <a href="{{ route('login') }}" class="give_bt">Add Requirement</a>
                                </div>
                            @endguest
                        </div>

                    </div>
                </div>
                <div class="row post-grid" id="post-data">

                    @forelse ($data as $items)
                        <div class="col-md-4 data" onscroll="requirements()" id="scroll">
                            <div class="get_detalis_inr">
                                <div class="get_detalis_img text-center">
                                    <div class="get_img">
                                        <a href="{{ route('getitview', $items['id']) }}">
                                            <img src="{{ $items->media == null ? asset('/img/requirement/Noimage.jpg') : asset($items->media['path']) }}"
                                                alt="Image">
                                    </div>
                                    </a>
                                </div>
                                {{-- <div class="get_detalis_info">

                                    <div style="height: 90px;
                                    overflow: hidden;">
                                        <p>{!! html_entity_decode($items->requirements) !!}</p>
                                    </div>
                                    <div class="text-end">
                                        <a href="{{ route('getitview', $items['id']) }}">Read more...</a>
                                    </div>

                                </div> --}}
                                <div class="get_detalis_info" style="height:80px">

                                    @if (strlen($items->requirements) > 79)
                                        <p>{!! substr(html_entity_decode($items->requirements), 0, 79) !!}</p>
                                        <div class="text-end">
                                            <a href="{{ route('giveviewdetail', $items['id']) }}">Read More..</a>
                                        </div>
                                    @else
                                        <p>{!! html_entity_decode($items->requirements) !!}</p>
                                    @endif


                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="post-wrap col-lg-12 col-md-12 text-center">
                            <span class="text-secondary">Empty Data</span>
                        </div>
                    @endforelse

                </div>
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
            <div class="row" style="justify-content: center;">
                <div class="ajax-load text-center d-none">
                    <p><img src="{{ asset('img/fronted/200w.gif') }}">Loading......</p>
                </div>
            </div>
            <div class="filter-message text-center mb-4">
                <span class="text-secondary">Empty Data</span>
            </div>
        </section>
    </div>
@endsection
@section('js')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
        var limit = 12;
        var start = 0;
        var page = 1;
        var total = {{ $totalRecords }};
        var recent = 0;
        $('.filter-message').hide();

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() && total != recent) {
                page++;
                limit += 12;
                requirements("scroll");
            }
        });

        function requirements(type = '') {
            if (type != "scroll") {
                page = 1;
                limit = 12;
                $('.post-grid').animate({
                    scrollTop: '0px'
                }, 1000);
            }
            $('.ajax-load').removeClass('d-none')
            var filterSortby = $('.sortby').val();
            var filterSearch = $('.search').val();
            var ajaxId = 1;
            document.getElementById('search').value = filterSearch;
            $.ajax({
                    type: "POST",
                    url: "/Getit-search",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "ajaxId": ajaxId,
                        "page": page,
                        "limit": limit,
                        "start": start,
                        "filterSearch": filterSearch,
                        "filterSortby": filterSortby,
                    },
                    dataType: 'json',

                    success: function(res) {
                        if (res == "") {
                            $('.ajax-load').removeClass('d-none')
                        } else {
                            recent = res.records;
                            total = res.total;
                            $('.ajax-load').addClass('d-none')
                            $('.post-grid').html('');
                            $('.post-grid').append(res.html);
                            if (recent == 0) {
                                $('.filter-message').show();
                            } else {
                                $('.filter-message').hide();
                            }

                            // jQuery(".post-grid").html(res.html);
                        }
                    }
                }

            );
        }
    </script>
@endsection
