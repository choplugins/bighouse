(function ($){
    function br_brands_regenerate_tooltip() {
        tippy('.br_brand_tippy', {
            content(reference) {
                const title = reference.getAttribute('data-tippy');
                return title;
            }
        });
    }

    $(document).ready( br_brands_regenerate_tooltip );
    $(document).on('berocket_ajax_products_loaded berocket_ajax_products_infinite_loaded', br_brands_regenerate_tooltip);
})(jQuery);
