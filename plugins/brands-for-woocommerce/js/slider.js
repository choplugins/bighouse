(function ($){
    $(document).ready( function() {
        // if ( bdBrandSlider.slider_infinite ) {
        //     $('.brcs_slider_brands:not(".slick-slider")').on('afterChange init', function(event, slick) {
        //         $(this).find('.slick-prev').show();
        //         $(this).find('.slick-next').show();
        //         if (slick.currentSlide === 0) {
        //             $(this).find('.slick-prev').hide();
        //         } else if($(this).find('.slick-slide').last().is('.slick-active')) {
        //             $(this).find('.slick-next').hide();
        //         }
        //     });
        // }

        $('.br_slick_slider:not(".slick-slider")').slick({
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
            autoplay: bdBrandSlider.slider_autoplay.length ? true : false,
            autoplaySpeed: bdBrandSlider.slider_autoplay_speed,
            speed: bdBrandSlider.slider_change_speed,
            infinite: bdBrandSlider.slider_infinite.length ? true : false,
            arrows: bdBrandSlider.slider_arrows.length ? true : false,
            pauseOnFocus: bdBrandSlider.slider_stop_focus.length ? true : false,
            pauseOnHover: bdBrandSlider.slider_stop_focus.length ? true : false,
            fade: bdBrandSlider.slider_mode == 'slide' ? false : true,
            cssEase: bdBrandSlider.slider_ease,
            dots: bdBrandSlider.slider_dots.length ? true : false,
        });
    }); 
})(jQuery);
