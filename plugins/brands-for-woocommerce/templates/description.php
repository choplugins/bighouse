<?php
if ( !empty( $options['banner_display'] ) && !empty( $brand_banner ) ) {
	$banner_width  = empty( $options['banner_width'] ) ? '' : "width:{$options['banner_width']}{$options['banner_width_units']};";
	$banner_height = empty( $options['banner_height'] ) ? '' : "height:{$options['banner_height']}{$options['banner_height_units']};";
	$banner_fit	   = empty( $options['banner_fit'] ) ? '' : "object-fit:{$options['banner_fit']};";
	$banner_align  = empty( $options['banner_align'] ) ? '' : "float:{$options['banner_align']};";

    echo "<img class='br_brand_image br_brand_banner' src='$brand_banner' alt='{$brand_term->name}' style='$banner_width $banner_height $banner_align $banner_fit'>";
}

echo '<div class="berocket_brand_description">';
if ( !empty( $options['thumbnail_display'] ) && !empty( $brand_thumbnail ) ) {
	$thumbnail_width  = empty( $options['thumbnail_width'] ) ? '' : "width:{$options['thumbnail_width']}{$options['thumbnail_width_units']};";
	$thumbnail_height = empty( $options['thumbnail_height'] ) ? '' : "height:{$options['thumbnail_height']}{$options['thumbnail_height_units']};";
	$thumbnail_fit	   = empty( $options['thumbnail_fit'] ) ? '' : "object-fit:{$options['thumbnail_fit']};";
	$thumbnail_align  = empty( $options['thumbnail_align'] ) ? '' : "float:{$options['thumbnail_align']};";

    echo "<img class='br_brand_image br_brand_thumbnail {$tooltip['class']}' src='$brand_thumbnail' alt='{$brand_term->name}' style='$thumbnail_width $thumbnail_height $thumbnail_align $thumbnail_fit' {$tooltip['data']} />";
}

if( !empty( $options['display_description'] ) ) {
    echo '<div class="text">'. do_shortcode( term_description() ).'</div>';
}
if( !empty( $options['display_link'] ) && !empty( $brand_url ) ) {
	$target = empty( $options['link_open_in_new_tab'] ) ? '' : "target='_blank'";
    echo "<a class='br_brand_link' $target href=$brand_url>{$options['link_text']}</a>";
}
echo '</div>';
?>