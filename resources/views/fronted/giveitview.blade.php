@extends('fronted.layout')

@section('title', 'Give It & Get It -ViewRequirement')

@section('content')

<div class="main">
    <section class="page-title">
        <div class="container">
            <h2>GET IT</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Details Page</a></li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="detail_main">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="details-slide position-relative">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="img-fluid" style="background-image:"src="{{ $RequiredData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($RequiredData->media['path']) }}"/>
                                </div>
                                {{-- <div class="swiper-slide">
                                    <img class="img-fluid" style="background-image:  url('./assets/image/book_img.jpg')"/>
                                </div> --}}
                            </div>
                            <div class="swiper-button-next">
                                <i class="fa-solid fa-angle-right csb"></i>
                            </div>
                            <div class="swiper-button-prev">
                                <i class="fa-solid fa-angle-left csb"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product-des">
                        <h3>Description</h3>
                        <p>{!!html_entity_decode($RequiredData->requirements)!!}</p>
                    </div>
                    <div class="releted_product-main">
                        <h2>Related Product</h2>
                        <div class="releted_product_inr">
                            <div class="product-img">
                                <img src="assets/image/book1.jpg" class="w-100">
                            </div>
                            <div class="product-info">
                                <h3>Name</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            </div>
                        </div>
                        <div class="releted_product_inr">
                            <div class="product-img">
                                <img src="assets/image/book1.jpg" class="w-100">
                            </div>
                            <div class="product-info">
                                <h3>Name</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            </div>
                        </div>
                        <div class="releted_product_inr">
                            <div class="product-img">
                                <img src="assets/image/book1.jpg" class="w-100">
                            </div>
                            <div class="product-info">
                                <h3>Name</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="product-detail-right">
                        <div class="product-price-box">
                            <div class="price-box-header">
                                <h3>₹ 500</h3>
                                <div class="price-share">
                                    <button class="btn"><i class="fa-solid fa-share-nodes"></i></button>
                                    <button class="btn"><i class="fa-solid fa-heart"></i></button>
                                </div>
                            </div>
                            <p class="mb-2">Product Name : {{ $RequiredData->categories['name'] }}</p>
                            <div class="adress-detail">
                                <p>address</p>
                                <span>Today</span>
                            </div>
                        </div>
                        <div class="seller-detail">
                            <h3 class="mb-2">Seller Description</h3>
                            <a href="#" class="seller-info">
                                <img src="{{ $RequiredData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($RequiredData->media['path']) }}">
                                <div class="seller-detail-inr">
                                    <div class="seller-name">
                                        <h3>{{$RequiredData->user['name']}}</h3>
                                        <p>{{$RequiredData->user['created_at']->format('d/m/Y')}}</p>
                                    </div>
                                    <p><i class="fa-solid fa-angle-right"></i></p>
                                </div>
                            </a>
                            <button class="btn cht-seller">Chat with Seller</button>
                        </div>
                        <div class="location">
                            <h3>Location</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.978134973966!2d72.50479681423971!3d23.024575022032625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b39f04f512b%3A0x248cc33c16c3c63b!2sIskcon%20Cross%20Rd%2C%20Ramdev%20Nagar%2C%20Ahmedabad%2C%20Gujarat%20380015!5e0!3m2!1sen!2sin!4v1659350252958!5m2!1sen!2sin" class="p-location" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




@endsection