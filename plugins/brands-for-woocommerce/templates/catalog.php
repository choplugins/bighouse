<?php
$random_class = "berocket_letter_block_{$atts['cache_key']}";
$additional_class = " {$atts['style']} ";
$keys = array_keys( $ordered_terms );

if ( !wp_script_is( 'br_brands_catalog' ) ) {
    wp_enqueue_script( 'br_brands_catalog' );
}

$img_align  = $atts['img_align'];
// $show_name  = !empty( $atts['use_name'] );
$show_count = !empty( $atts['count'] );
// $show_image = !empty( $atts['img'] );
$is_grouped = $atts['groupby'] != 'none';

// if ( empty( $atts['imgh'] ) ) {
//     $height = $line_height = '';    
// } else {
//     $height = "height:{$atts['imgh']}{$atts['imgh_units']};";
//     $line_height = ( $img_align == 'left' || $img_align == 'right' ) ? "line-height: {$atts['imgh']}{$atts['imgh_units']}" : '';
// }

$width  = empty( $atts['imgw'] ) ? '' : "width:{$atts['imgw']}{$atts['imgw_units']};";
$fit    = $atts['img_fit'] == 'none' ? '' : "object-fit:{$atts['img_fit']};";
// $align  = ( $img_align == 'left' || $img_align == 'right' ) ? "float:$img_align;" : '';

echo "<div class='berocket_brand_list'>";

if ( $is_grouped ) {
    echo "<div class='berocket_brand_name_letters $additional_class'>";
    if( !empty( $atts['show_all'] ) ) {
        echo '<a data-href="#all" class="button">', __('All', 'brands-for-woocommerce'), '</a>';
    }

    foreach ( $keys as $index => $key ) {
        // data-href, not href - for Divi theme
        echo "<a data-href='#{$random_class}_$index' class='button'>$key</a>";
    }
    echo '</div>';
}

echo "<div class='berocket_letter_blocks $random_class'>";
foreach ( $keys as $index => $key ) {
    echo "<div id='{$random_class}_$index' class='br_brand_letter_block $additional_class'>";

    if ( $is_grouped ) {
        echo "<h3>$key</h3>";
    }
    foreach ( $ordered_terms[$key] as $term ) {
        $count = $show_count ? " <span class='br_brand_count'>({$term->count_posts})</span>" : '';
        $brand_link = $term->link;
        if( is_wp_error( $brand_link ) ) {
            echo '<div id="message" class="error"><p>' . $brand_link->get_error_message() . '</p></div>';
            $brand_link = '#error_link';
        }

        echo 
            "<div class='br_brand_letter_element $additional_class {$term->tooltip['class']}' {$term->tooltip['data']}>
                <a href='{$brand_link}'>";

        // $brand_name = empty( $atts['use_name'] ) ? '' : "<span class='br_brand_name' style='$line_height'> {$term->name}$count</span>";
        $brand_name = empty( $atts['use_name'] ) ? '' : "<span class='br_brand_name'> {$term->name}$count</span>";
        $brand_image = '';
        if ( !empty( $atts['img'] ) && !empty( $term->image ) ) {
            $height = empty( $atts['imgh'] ) ? '' : "height:{$atts['imgh']}{$atts['imgh_units']};";
            // $brand_image = "<img src='{$term->image}' class='align_$img_align' alt='{$term->name}' style='$width $height $fit $align' />";
            $brand_image = "<img src='{$term->image}' class='align_$img_align' alt='{$term->name}' style='$width $height $fit' />";
        }

        if ( $img_align == 'under' || $img_align == 'right' ) {
            echo "$brand_name $brand_image";
        } else {
            echo "$brand_image $brand_name";
        }
        echo "</a></div>";
    }
    echo '</div>';
}
echo '</div></div>';
$width = 100 / $atts['column'];
echo 
    "<style>
        .$random_class .br_brand_letter_block.horizontal {
            width: $width%;
            float: left;
        }
        .$random_class .br_brand_letter_element.vertical {
            width: $width%;
            float: left;
        }
        .$random_class .br_brand_letter_block.horizontal:nth-child({$atts['column']}n + 1) {
            clear: both;
        }
    </style>";
?>
