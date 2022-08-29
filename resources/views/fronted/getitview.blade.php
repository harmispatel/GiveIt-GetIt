@extends('fronted.layout')

@section('title', 'Give It & Get It -ViewRequirement')

@section('content')
<div id="notifDiv"></div>
    <div class="main">
        @if (session()->has('success'))
            <div class="alert alert-success success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if (session()->has('warning'))
            <div class="alert alert-danger warning">
                {{ session()->get('warning') }}
            </div>
        @endif

        <section class="detail_main">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="details-slide position-relative">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img class="img-fluid"
                                            style="background-image: url('{{ $RequiredData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($RequiredData->media['path']) }}')" />
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
                            <p>{!! html_entity_decode($RequiredData->requirements) !!}</p>
                        </div>
                        <div class="releted_product-main">
                            <h2>Related Product</h2>
                            @foreach ($relatedData as $item)
                                <div class="releted_product_inr">
                                    <div class="product-img">
                                        <img src="{{ $item->media == null ? asset('/img/requirement/Noimage.jpg') : asset($item->media['path']) }}"
                                            class="w-100">
                                    </div>
                                    <div class="product-info">
                                        <h3>Name:{{ $item->categories['name'] }}</h3>
                                        <p>{!! html_entity_decode($item->requirements) !!}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="product-detail-right">
                            <div class="product-price-box">
                                <div class="price-box-header">
                                    <h3>₹{{ $RequiredData->price == null ? 00.0 : $RequiredData->price }}</h3>
                                    <div class="price-share">
                                        <button class="btn">  <i class="fa-solid fa-share-nodes" data-bs-toggle="modal" href="#exampleModalToggle" role="button"></i></button>
                                        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title"  id="exampleModalToggleLabel">Share</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="link-container">
                                                        <input type="text" class="form-control" id="copy_{{$url}}" value="{{$url}}" />
                                                        <button value="copy" class="btn copy-btn" onclick="copyToClipboard('copy_{{ $url}}')">Copy</button>
                                                    </div>

                                                    <div class="share-social">
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" role="button"><i class="fab fa-facebook-f fa-lg"></i></a>
                                                    
                                                        <a  href="https://twitter.com/intent/tweet?url={{url()->current()}}" role="button"><i class="fab fa-twitter fa-lg"></i></a></button>
                                                    
                                                        <a  href="https://www.instagram.com/?url={{url()->current()}}" role="button"><i class="fab fa-instagram fa-lg"></i></a>
                                                    
                                                        <a  href="https://wa.me/?text={{url()->current()}}" role="button"><i class="fab fa-whatsapp"></i></a>
                                                    
                                                        <a href="http://linkedin.com/?url={{url()->current()}}" role="button"><i class="fab fa-linkedin-in"></i></a>
                                                    </div>
                                                    
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        @auth

                                            
                                        @php $countWishlist = 0 @endphp
                                        @if(Auth::check())
                                        @php 
                                        $countWishlist = App\Models\Favorite::where('requirement_id', $RequiredData['id'])->where('user_id', Auth::user()->id)->get();
                                        @endphp
                                        @endif
                                        <button class="btn update_wishlist"  data-requirementid="{{ $RequiredData->id }}">
                                          @if (count($countWishlist) > 0)
                                          <i class="fas fa-heart" aria-hidden="true"></i>
                                          @else
                                          <i class="far fa-heart" aria-hidden="true"></i>

                                          @endif
                                                </button>
                                        @endauth
                                        @guest
                                            <button class="btn"><a href="{{ route('userlogin') }}"
                                                    class="far fa-heart"></a></button>
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
                                    <img
                                        src="{{ $RequiredData->media == null ? asset('/img/requirement/Noimage.jpg') : asset($RequiredData->media['path']) }}">
                                    <div class="seller-detail-inr">
                                        <div class="seller-name">
                                            <h3>{{ $RequiredData->user['name'] }}</h3>
                                            <p>{{ $RequiredData->user['created_at']->format('d/m/Y') }}</p>
                                        </div>
                                        <p><i class="fa-solid fa-angle-right"></i></p>
                                    </div>
                                </a>
                                <a href="tel:{{ $RequiredData->user['mobile'] }}"><button
                                        class="btn cht-seller">Contact</button></a>
                            </div>
                            <div class="location">
                                <h3>Location</h3>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.978134973966!2d72.50479681423971!3d23.024575022032625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b39f04f512b%3A0x248cc33c16c3c63b!2sIskcon%20Cross%20Rd%2C%20Ramdev%20Nagar%2C%20Ahmedabad%2C%20Gujarat%20380015!5e0!3m2!1sen!2sin!4v1659350252958!5m2!1sen!2sin"
                                    class="p-location" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script text type=text/javascript>
        var user_id = "{{ Auth::id() }}";
        $(document).ready(function() {
            $('.update_wishlist').click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var requirement_id = $(this).data('requirementid');
                $.ajax({
                    type: 'POST',
                    url: '/add-to-favorite',
                    data: {
                        requirement_id: requirement_id,
                        user_id: user_id
                    },
                    success: function(response) {
                        if (response.action == 'add') {
                            $('#notifDiv').fadeIn().css('background', 'green').text(response.message);
                            $('button[data-requirementid='+requirement_id+']').html(`<i class="fas fa-heart" aria-hidden="true"></i>`);
                        } else {
                            $('#notifDiv').fadeIn().css('background', 'red').text(response.message);
                            $('button[data-requirementid='+requirement_id+']').html(`<i class="far fa-heart" aria-hidden="true"></i>`);
                        }
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 3000);
                    }
                });
            });
        });
        function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
    }
    </script>
@endsection
