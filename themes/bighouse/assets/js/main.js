(function($) {
    window.onload = function() {
        $(document).ready(function() {
            backToTop();
            menuMobile();
        });
    };
})(jQuery);

//back to top
function backToTop() {
    var backToTop = document.querySelector('.backToTop');

    if (backToTop == null) {
        return 0;
    } else {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 400) {
                backToTop.classList.add('show__backToTop')
            } else {
                backToTop.classList.remove('show__backToTop')
            }
        })
        backToTop.addEventListener('click', function() {
            window.scroll({
                top: 0,
                behavior: 'smooth'
            });
        })
    }
}
//menu mobile{
function menuMobile(){
    if ($(".nav-mb__toggle").length ||$(".menu-mobile").length ||$(".overlay").length ||$("#btn-form").length){
        $(".nav-mb__toggle").click(function () {
            $(".overlay").addClass("overlay-active");
            $(".menu-mobile").addClass("menu-mobile-active");
            $('.nav-mb__toggle').addClass("nav-mb__toggle-show");
    
        });
        $(".overlay").click(function () {
                $(".overlay").removeClass("overlay-active");
                $(".menu-mobile").removeClass("menu-mobile-active");
                $(".pop-form__box").removeClass("pop-form__box-show");
        });
        $("#btn-form").click(function(){
            $(".pop-form__box").addClass("pop-form__box-show");
            $(".overlay").addClass("overlay-active");
            
        });
        $("button.btn.btn-detail.btn-detail__notify").click(function(){
            $(".pop-form__box").addClass("pop-form__box-show");
            $(".overlay").addClass("overlay-active");
        })
        $(".pop-form__close").click(function(){
            $(".overlay").removeClass("overlay-active");
            $(".menu-mobile").removeClass("menu-mobile-active");
            $(".pop-form__box").removeClass("pop-form__box-show");
        })
    }
    
    $('.menu-mobile >ul >li').click(function(){
        if(!$('.menu-mobile >ul >li').hasClass('current-menu-item')){
            
        }else{
            $('.menu-mobile >ul >li').removeClass('current-menu-item')
            $(this).addClass('current-menu-item');
        }
    });
    $(".overlay").click(function () {
            $(".overlay").removeClass("overlay-active");
            $(".menu-mobile").removeClass("menu-mobile-active");
            $(".pop-form__box").removeClass("pop-form__box-show");
    });
}