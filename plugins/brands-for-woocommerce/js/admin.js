var br_saved_timeout;
var br_savin_ajax = false;

// function brand_widget_init() {
//     jQuery('.colorpicker_field_brand').each(function (i,o){
//         jQuery(o).css('backgroundColor', '#'+jQuery(o).data('color'));
//         jQuery(o).colpick({
//             layout: 'hex',
//             submit: 0,
//             color: '#'+jQuery(o).data('color'),
//             onChange: function(hsb,hex,rgb,el,bySetColor) {
//                 jQuery(el).css('backgroundColor', '#'+hex).next().val(hex).trigger('change');
//             }
//         })
//     });
// }

(function ($){
    function setColorPicker() {
        $('.br_brand_colorpicker').wpColorPicker( {
            change: function (event, ui) {
                var element = event.target;
                var color = ui.color.toString();
                $(event.target).val(color).trigger('change');
            }
        } );
    }

    $(document).ajaxComplete( setColorPicker );

    $(document).ready( function () {
        // brand_widget_init();
        setColorPicker();

        $(document).on('click', '.br_brand_image', function() {
            $(this).closest('.form-field').find('.berocket_aapf_upload_icon').trigger('focus');
        });

        $(document).on('click', '.br_brand_category_checklist', function() {
            $(this).closest('.form-field').find('.br_brand_product_categories > li:first-of-type input').trigger('focus');
        });

        $(document).on('click', '.br_shortcode_title', function() {
            $(this).closest('li').find('.br_shortcode_attributes').slideToggle();
            $(this).find('i').toggleClass('arrow-rotate');
        });

        $(document).on('change', '.br_has_dependent_options', function() {
            var self = $(this),
                dependent_element = $( '.' + self.attr('id') + '_dependent' );

            if ( self.prop('checked') ) {
                dependent_element.closest('tr').show();
            } else {
                dependent_element.closest('tr').hide();
            }
        });
        $('.br_has_dependent_options').trigger('change');

        $(document).on('click', '.br_brand_order', function() {
            var self = $(this), 
                input = self.closest('td').find('.br_brand_order_input'),
                order = parseInt( input.val() ),
                new_order = self.attr('href') == '#order-up' ? order+1 : Math.max(0, order-1);

            input.val( new_order );
        });

        $(document).on('click', '.br_brand_order_save', function() {
            var 
                self = $(this),
                parent = self.closest('.berocket_post_set_new_sortable_input'),
                save_button = parent.find('.br_brand_order_save'),
                waiting_title = parent.find('.br_brand_order_wait');

            waiting_title.show();
            save_button.hide();
            $.ajax({
                type: 'GET',
                url: brandsHelper.ajax_url,
                data: {
                    'action': 'br_brands_save_order',
                    'term_id': self.data('term_id'),
                    'order': parent.find('.br_brand_order_input').val(),
                },
                success: function(result){
                    waiting_title.hide();
                    save_button.show();
                    console.log(result);
                },
            });
        });

        $(".taxonomy-berocket_brand #the-list").sortable({
            cursor: 'move',
            handle: '.column-order',
            placeholder: 'brand-sortable-placeholder',
            start: function (event, ui) {
                ui.item.toggleClass('br-sortable-placeholder');
            },
            stop: function (event, ui) {
                // console.log('br-sortable-placeholder');
                ui.item.toggleClass('br-sortable-placeholder');
                $('html, body').css("cursor", "wait");
                let term_ids = $('#the-list tr').map( function(element) { return this.id; }).get();
                $.ajax({
                    type: 'GET',
                    url: brandsHelper.ajax_url,
                    data: {
                        'action': 'br_brands_save_all_orders',
                        'term_ids': term_ids,
                    },
                    success: function(result){
                        // console.log(result);
                        term_ids.forEach( function(id, order) {
                            $('#the-list #' + id + ' .br_brand_order_input').val(order);
                        });
                        $('html, body').css("cursor", "auto");
                    },
                    error: function(){
                        $('html, body').css("cursor", "auto");
                    },
                });

                // console.log( $('#the-list tr').map( function(element) {
                //   return this.id;
                // }).get() );

                // $('#the-list tr').each(function(index) {
                //     console.log( index, $(this).attr('id') );
                // });
            }
        }).disableSelection();

        $(document).on('change', '#br_brand_list_image', function(e) {
            var 
                self = $(this),
                options = self.closest('fieldset').find('p:not(:first)');

            if ( self.prop('checked') ) {
                console.log('show image options');
                options.removeClass('br_brand_hide_option');
            } else {
                console.log('hide image options');
                options.addClass('br_brand_hide_option');
            }
        });
        $('#br_brand_list_image').trigger('change');

        $(document).on('click', '#br_brands_clear_cache', function() {
            var self = $('#br_brands_clear_cache'),
                label = self.val(),
                process = self.data('process'),
                done = self.data('done');

            self.addClass('active').val(process);
            $.ajax({
                type: 'GET',
                url: brandsHelper.ajax_url,
                data: {
                    'action': 'br_brands_clear_cache'
                },
                success: function(result){
                    self.removeClass('active').val(done);
                    // setTimeout(function(){ self.val(label) }, 1000);
                    // console.log(result);
                },
            });
        });

        $(document).on('change', '.br_brands_display_options', function() {
            var 
                self = $(this),
                options = self.closest('td').find('label:not(:first), .br_line_delimiter');

            if ( self.prop('checked') ) {
                options.show();
            } else {
                options.hide();
            }
        });
        $('.br_brands_display_options').trigger('change');

        $(document).on('change', '.br_brand_display_options', function(){
            var 
                self = $(this),
                option_class = self.data('option_class');

            if ( self.prop('checked') ) {
                $(option_class).removeClass('br_brand_hide_option');
            } else {
                $(option_class).addClass('br_brand_hide_option');
            }
        });
        $('.br_brand_display_options').trigger('change');

        $(document).on('click', '.br_brands_image .berocket_aapf_upload_icon', function(e) {
            e.preventDefault();
            $p = $(this);
            var custom_uploader = wp.media({
                title: 'Select custom Icon',
                button: {
                    text: 'Set Icon'
                },
                multiple: false 
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $p.prevAll(".berocket_aapf_selected_icon_show").html('<i class="fa"><image src="'+attachment.url+'" alt=""></i>');
                $p.prevAll(".berocket_aapf_icon_text_value").val(attachment.url);
            }).open();
        });

        $(document).on('click', '.br_brands_image .berocket_aapf_remove_icon',function(event) {
            event.preventDefault();
            $(this).prevAll(".berocket_aapf_icon_text_value").val("");
            $(this).prevAll(".berocket_aapf_selected_icon_show").html("");
        });

        $(document).on('click', '.theme_default', function (event) {
            event.preventDefault();
            $(this).prev().prev().css('backgroundColor', '#000000').colpickSetColor('#000000');
            $(this).prev().val('');
        });

        $(document).on('change', '.br_brandw_perrow, .br_brandw_count', function() {
            var $parent = $(this).parents('.br_brandw_js');
            if( $parent.find('.br_brandw_count').val() && $parent.find('.br_brandw_perrow').val() ) {
                var count = parseInt($parent.find('.br_brandw_count').val());
                var perrow = parseInt($parent.find('.br_brandw_perrow').val());
                if( perrow > count ) {
                    $parent.find('.br_brandw_perrow').val(count);
                }
            }
        });

        function shop_display_brand() {
            if( $('.shop_display_brand').prop('checked') ) {
                $('.shop_display_brand_enabled').show();
            } else {
                $('.shop_display_brand_enabled').hide();
            }
        }
        $(document).on('change', '.shop_display_brand', shop_display_brand);
        shop_display_brand();

        function product_display_brand() {
            if( $('.product_display_brand').prop('checked') ) {
                $('.product_display_brand_enabled').show();
            } else {
                $('.product_display_brand_enabled').hide();
            }
        }
        $(document).on('change', '.product_display_brand', product_display_brand);
        product_display_brand();
    });
})(jQuery);
