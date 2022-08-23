@extends('fronted.layout')

@section('title', 'Give It & Get It -ViewRequirement')

@section('content')

<div class="main">
   
    <section class="detail_main">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="details-slide position-relative">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="img-fluid" style="background-image:url('{{ $RequiredData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($RequiredData->media['path']) }}')"/>
                                </div>
                                {{-- <div class="swiper-slide">
                                    <img class="img-fluid" style="background-image:  url('./assets/image/book_img.jpg')"/>
                                </div> --}}
                            </div>
                            {{-- <div class="swiper-button-next">
                                <i class="fa-solid fa-angle-right csb"></i>
                            </div>
                            <div class="swiper-button-prev">
                                <i class="fa-solid fa-angle-left csb"></i>
                            </div> --}}
                        </div>
                    </div>
                    <div class="product-des">
                        <h3>Description</h3>
                        <p>{!!html_entity_decode($RequiredData->requirements)!!}</p>
                    </div>
                    <div class="releted_product-main">
                        <h2>Related Product</h2>
                        @foreach ($relatedData as $item)
                        <div class="releted_product_inr">
                            {{-- @php
                             echo"<pre>"; print_r($relatedData->toArray());exit;   
                            @endphp --}}
                            
                            <div class="product-img">
                                <img src="{{ $item->media == null ? asset('/img/requirement/Noimage.jpg') : asset($item->media['path']) }}" class="w-100">
                            </div>
                            <div class="product-info">
                                <h3>Name:{{$item->categories['name']}}</h3>
                                <p>{!!html_entity_decode($item->requirements)!!}</p>
                            </div>
                        </div>
                        @endforeach
                       
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="product-detail-right">
                        <div class="product-price-box">
                            <div class="price-box-header">
                                <h3>₹{{$RequiredData->price == null ? 00.00 : $RequiredData->price }}</h3>
                                <div class="price-share">
                                    <button class="btn"><i class="fa-solid fa-share-nodes"></i></button>
                                    @auth
                                    <button class="btn"><i class="fa-solid fa-heart" href="#"></i></button>
                                    {{-- <a href="{{route('addform')}}" class="give_bt">Get IT</a> --}}
                                    @endauth
                                    @guest
                                    <button class="btn"><a href="{{route('userlogin')}}" class="fa-solid fa-heart"></a></button>
                                    @endguest

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
                            <a href="tel:{{$RequiredData->user['mobile']}}"><button class="btn cht-seller">Contact</button></a>
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