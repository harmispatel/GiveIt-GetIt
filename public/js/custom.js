$(function () {

    // $(window).on('scroll', function () {
    //     if ($('.header').length) {
    //         var headerScrollPos = 100;
    //         var stricky = $('.header');
    //         if ($(window).scrollTop() > headerScrollPos) {
    //             stricky.addClass('header-sticky');
    //         } else if ($(this).scrollTop() <= headerScrollPos) {
    //             stricky.removeClass('header-sticky');
    //         }
    //     }
    //     if ($('.scroll-to-top').length) {
    //         var strickyScrollPos = 100;
    //         if ($(window).scrollTop() > strickyScrollPos) {
    //             $('.scroll-to-top').fadeIn(500);
    //         } else if ($(this).scrollTop() <= strickyScrollPos) {
    //             $('.scroll-to-top').fadeOut(500);
    //         }
    //     }
  
    // });



    $(window).load(function(){
       
            // $('#loader').css('display', "none");            
        setInterval(() => {
            $('#loader').css('display', "none");            
        }, 2000);
    });

    let homeSlideSwiper = new Swiper(".home-slide .swiper", {
        spaceBetween: 0,
        speed: 500,
        loop: true,
        // autoplay: {
        //     delay: 3500,
        //     disableOnInteraction: false,
        //     pauseOnMouseEnter: true
        // },
        navigation: {
            nextEl: ".home-slide .swiper .swiper-button-next",
            prevEl: ".home-slide .swiper .swiper-button-prev"
        },
        mousewheel: false,
        keyboard: false,
    })
    let bestCategoriesSwiper = new Swiper(".categories-swiper .swiper", {
        slidesPerView: 1,
        spaceBetween: 60,
        speed: 500,
        loop: false,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        navigation: {
            nextEl: ".categories-swiper .swiper-button-next",
            prevEl: ".categories-swiper .swiper-button-prev"
        },
        mousewheel: false,
        keyboard: false,
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            991: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            1199: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
        },
    })
    let getItSwiper = new Swiper(".get-slider .categories-swiper .swiper", {
        slidesPerView: 1,
        spaceBetween: 60,
        speed: 500,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        },
        navigation: {
            nextEl: ".categories-swiper .swiper-button-next",
            prevEl: ".categories-swiper .swiper-button-prev"
        },
        mousewheel: false,
        keyboard: false,
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            991: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1199: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
        },
    })
})