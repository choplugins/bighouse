<?php 
if ( empty( $ordered_terms ) ) return;

$BeRocket_product_brand = BeRocket_product_brand::getInstance();
$options = $BeRocket_product_brand->get_option();
$widget_number = $atts['cache_key'];
$slider_class = '';

echo '<style>';
if ( !empty( $atts['slider'] ) && $atts['slider'] == 1 ) {
    $slider_class = 'br_slick_slider';
    wp_enqueue_script( 'berocket_slick');
    wp_enqueue_script( 'br_brands_slider');
    wp_localize_script( 'br_brands_slider', 'bdBrandSlider',
        array(
            'slider_infinite'       => $options['slider_infinite'],
            'slider_autoplay'       => $options['slider_autoplay'],
            'slider_autoplay_speed' => $options['slider_autoplay_speed'],
            'slider_change_speed'   => $options['slider_change_speed'],
            'slider_arrows'         => $options['slider_arrows'],
            'slider_stop_focus'     => $options['slider_stop_focus'],
            'slider_mode'           => $options['slider_mode'],
            'slider_ease'           => $options['slider_ease'],
            'slider_dots'           => $options['slider_dots'],
        )
    );
    wp_enqueue_style( 'berocket_slick' );
    wp_enqueue_style( 'font-awesome');

    $dots_color = $options['slider_dots_color'];
    $dots_darker_color = brfr_adjust_brightness( $dots_color, -0.5 );
    $dots_shadow_color = brfr_adjust_brightness( $dots_color, -0.8 );
    echo ".br_brand_$widget_number .slick-dots li.slick-active {
            background: linear-gradient($dots_color, $dots_darker_color);
            background: -webkit-gradient(linear, left top, left bottom, from($dots_color), to($dots_darker_color));
            background: -o-linear-gradient($dots_color, $dots_darker_color);
            box-shadow: inset 0 0 1px 1px $dots_shadow_color;
            -webkit-box-shadow: inset 0 0 1px 1px $dots_shadow_color;
        }";
    $list_style = 'slider';
} else {
    $brand_width = 100 / intval( $atts['per_row'] ) . '%';
    if ( !empty( $atts['margin'] ) ) {
        $brand_margin = $atts['margin'] * 2;
        $brand_width = "calc($brand_width - {$brand_margin}px)";
    }
    echo ".br_brand_$widget_number .br_widget_brand_element_slider {
            width: $brand_width;
        }";
    $list_style = 'list';
}

$border_style = !empty( $atts['border_color'] ) && !empty( $atts['border_width'] ) 
    ? "border: {$atts['border_width']}px solid {$atts['border_color']} !important;" : '';
$padding = empty( $atts['padding'] ) ? '' : "padding: {$atts['padding']}px;";
$margin  = empty( $atts['margin'] ) ? '' : "margin: {$atts['margin']}px;";
echo ".br_brand_$widget_number .br_widget_brand_element_slider {
        box-sizing: border-box;
        $padding
        $margin
        $border_style
    }";
echo '</style>';

$slider_col = $options['slider_mode'] == 'slide' ? $atts['per_row'] : 1;
$slider_scroll = max(min( intval(empty($options['slider_slides_scroll']) ? $slider_col : $options['slider_slides_scroll'] ), intval($slider_col)), 1);

echo "<div data-slick='{\"slidesToShow\":$slider_col,\"slidesToScroll\":$slider_scroll}' class='brcs_slider_brands br_brand_$widget_number $slider_class'>";

$show_name  = $atts['use_name'];
$show_count = !empty( $atts['count'] );
$show_image = !empty( $atts['img'] );
$img_align  = $atts['img_align'];

if ( empty( $atts['imgh'] ) ) {
    $height = '';    
    // $height = $line_height = '';    
} else {
    $height = "height:{$atts['imgh']}{$atts['imgh_units']};";
    // $line_height = ( $img_align == 'left' || $img_align == 'right' ) ? "line-height: {$atts['imgh']}{$atts['imgh_units']}" : '';
}

$width  = empty( $atts['imgw'] ) ? '' : "width:{$atts['imgw']}{$atts['imgw_units']};";
$fit    = $atts['img_fit'] == 'none' ? '' : "object-fit:{$atts['img_fit']};";

$align = $line_height = '';
$display_span = 'display: block;';
if ( $img_align == 'left' || $img_align == 'right' ) {
    $align = "float:$img_align;";
    $line_height = empty( $atts['imgh'] ) ? '' : "line-height: {$atts['imgh']}{$atts['imgh_units']};";
    $display_span = 'display: inline-block;';
}

foreach ( $ordered_terms as $term ) {
    $count = $show_count ? " <span class='br_brand_count'>({$term->count_posts})</span>" : '';
    $brand_link = $term->link;
    $brand_link = $term->link;
    if( is_wp_error( $brand_link ) ) {
        echo '<div id="message" class="error"><p>' . $brand_link->get_error_message() . '</p></div>';
        $brand_link = '#error_link';
    }

    $brand_name = $show_name ? "<span href='$brand_link' style='$line_height $display_span'>{$term->name}$count</span>" : '';
    $brand_image = ( $show_image && !empty( $term->image ) ) ? "<img src='{$term->image}' alt='{$term->name}'  style='$width $height $fit $align' />" : '';

    echo "<div class='br_widget_brand_element_slider $list_style {$term->tooltip['class']}' {$term->tooltip['data']}>
            <div class='brand_slider_image'>
                <a href='$brand_link'>";
    if ( $img_align == 'under' ) {
        echo "$brand_name $brand_image";
    } else {
        echo "$brand_image $brand_name";
    }
    echo '</a></div></div>';
}
echo '</div>';

// if ( !empty($atts['imgh']) ) {
//     $imgh = $atts['imgh'];
//     echo 
//         ".br_brand_$widget_number .br_widget_brand_element_slider .brand_slider_image {
//             height: {$imgh}px;
//             line-height: {$imgh}px;
//         }
//         '.br_brand_$widget_number .br_widget_brand_element_slider .brand_slider_image img {
//             max-height: {$imgh}px;
//         }";
// }

