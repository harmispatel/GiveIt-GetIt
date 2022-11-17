@extends('fronted.layout')

@section('title', 'Give It & Get It - Home')

@section('content')


    <div class="main">
        {{-- @if (session()->has('userlogin'))
            <div class="alert text-success userlogin">
                {{ session()->get('userlogin') }}
            </div>
        @endif --}}
        <section class="home-slide">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <strong class="title text-uppercase">welcome</strong>
                        <strong class="sub-title text-capitalize">Don't delay. Give today!</strong>
                        <img class="img-fluid" style="background-image: url('{{ asset('img/fronted/toy_img.png') }}" />
                    </div>
                    <div class="swiper-slide">
                        <strong class="title text-uppercase">welcome to</strong>
                        <strong class="sub-title text-capitalize">A small donation can make a huge difference.</strong>
                        <p>Your help matters, no matter how big or small.</p>
                        <img class="img-fluid" style="background-image: url('{{ asset('img/fronted/cloth-img.jpg') }}" />
                    </div>
                </div>
                <div class="swiper-button-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                <div class="swiper-button-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
            </div>
        </section>
        <section class="work">
            <div class="container">
                <div class="work-inr">
                    <div class="sec-title">
                        <h2>How give IT. get IT. Works</h2>
                        <p>We understand that families without a personal computer - or the skills to use one - often
                            have limited job
                            marketability or unstable employment, which results in lower family incomes, and lower
                            literacy rates.
                        </p>
                        <p>We help people realize their potential by helping them obtain regular personal computer
                            access
                            and the skills needed to become capable users and makers.
                        </p>
                    </div>
                </div>
                <div class="work-info">
                    <div class="row align-items-center mb-4 give">
                        <div class="col-md-3">
                            <div class="categories-swiper">
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
                        <div class="col-md-9">
                            <div class="card">
                                <div class="work-info-inr">
                                    <h3 class="text-center"><strong>Give IT :</strong></h3>
                                    <h3>Do a good deed by giving to those in need.</h3>
                                    <p>If you want to donate, you should look in the Get it category to see what people
                                        needs.</p>
                                    @auth
                                @if ($user->email == null || $user->mobile == null)
                                <a href="{{ route('editprofile') }}" class="give_bt">Give IT</a>
                                @else
                                <a href="{{ route('addform') }}" class="give_bt">Give IT</a>
                                @endif
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}" class="give_bt">Give IT</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center get">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="work-info-inr">
                                    <h3><strong>Get IT :</strong></h3>
                                    <h3>We are all happy because of your donation.</h3>
                                    <p>If you are in need of any item, go to the Give it category and enter whatever
                                        item you need there.</p>
                                    @auth
                                    @if ($user->email == null || $user->mobile == null)
                                    <a href="{{ route('editprofile') }}" class="give_bt">Get IT</a>
                                    @else
                                    <a href="{{ route('addform') }}" class="give_bt">Get IT</a>
                                    @endif
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}" class="give_bt">Get IT</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="categories-swiper">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <a class="swiper-slide" href="#">
                                            <div class="img">
                                                <img class="img-fluid" src="{{ asset('img/fronted/book_img.png') }}" />
                                            </div>
                                        </a>
                                        <a class="swiper-slide" href="#">
                                            <div class="img">
                                                <img class="img-fluid" src="{{ asset('img/fronted/food_img.png') }}" />
                                            </div>
                                        </a>
                                        <a class="swiper-slide" href="#">
                                            <div class="img">
                                                <img class="img-fluid" src="{{ asset('img/fronted/toy_img.jpg') }}" />
                                            </div>
                                        </a>
                                        <a class="swiper-slide" href="#">
                                            <div class="img">
                                                <img class="img-fluid" src="{{ asset('img/fronted/cloth-img.jpg') }}" />
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="info-main">
            <div class="container">
                <div class="info-main-inr">
                    <div class="title text-center">
                        <h3>Give IT. Get IT Category</h3>
                        <p>We make a living by what we get, but we make a life by what we give.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="item-card">
                                <div class="item-card-img">
                                    <img src="{{ asset('img/fronted/food_img.png') }}" class="w-100" />
                                    <div class="img-text">
                                        <span>GET IT / GIVE IT</span>
                                    </div>
                                </div>
                                <div class="item-category text-center">
                                    <h2>Food</h2>
                                    <p>Give Food And Save their life.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-card">
                                <div class="item-card-img">
                                    <img src="{{ asset('img/fronted/toy_img.jpg') }}" class="w-100" />
                                    <div class="img-text">
                                        <span>GET IT / GIVE IT</span>
                                    </div>
                                </div>
                                <div class="item-category text-center">
                                    <h2>Toy</h2>
                                    <p>Give Toys And make their childhood enjoyfull.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-card">
                                <div class="item-card-img">
                                    <img src="{{ asset('img/fronted/book_img.png') }}" class="w-100" />
                                    <div class="img-text">
                                        <span>GET IT / GIVE IT</span>
                                    </div>
                                </div>
                                <div class="item-category text-center">
                                    <h2>Book</h2>
                                    <p>Give Books And make their future bright.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-card">
                                <div class="item-card-img">
                                    <img src="{{ asset('img/fronted/cloth-img.jpg') }}" class="w-100" />
                                    <div class="img-text">
                                        <span>GET IT / GIVE IT</span>
                                    </div>
                                </div>
                                <div class="item-category text-center">
                                    <h2>Clothes</h2>
                                    <p>Give Clothes And Protect their Body.</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
        </section>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        // setTimeout(() => {
        //     $('.userlogin').remove();
        // }, 3500);
        @if(Session::has('userlogin'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('userlogin') }}");
  @endif
    </script>
@endsection
