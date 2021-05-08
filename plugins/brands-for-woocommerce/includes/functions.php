<?php
function brfr_adjust_brightness($hexCode, $adjustPercent) {
    $hexCode = ltrim($hexCode, '#');

    if (strlen($hexCode) == 3) {
        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }

    $hexCode = array_map('hexdec', str_split($hexCode, 2));
    foreach ($hexCode as & $color) {
        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
        $adjustAmount = ceil($adjustableLimit * $adjustPercent);
        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexCode);
}

/*
args = array(
    'name' => string
    'label' => string
    'align_options' => array
    'defaults' => array
    'class' => string, optional
    'extra' => string, optional
    'tr_class' => string, optional
)
*/
function brfr_image_options( $args ) {
    $args = array_merge( array( 'class' => '', 'extra' => '', 'tr_class' => '' ), $args );
    $image_name = $args['name'];
    $defaults = $args['defaults'];
    return array(
        "label" => $args['label'],
        "tr_class" => "br_nowrap_label br_image_options {$args['tr_class']}",
        "items" => array(
            "{$image_name}_display" => array(
                "label_be_for" => __('Display', 'brands-for-woocommerce'),
                "type"         => "checkbox",
                "name"         => "{$image_name}_display",
                "extra"        => " id='br_brand_{$image_name}_display'",
                "class"        => "{$args['class']} br_brands_display_options",
                "extra"        => " {$args['extra']}",
                "value"        => 1,
            ),
            "{$image_name}_width" => array(
                "label_be_for" => __('Width', 'brands-for-woocommerce'),
                "type"         => "number",
                "class"        => "br_brand_number",
                "name"         => "{$image_name}_width",
                "value"        => $defaults["{$image_name}_width"],
            ),
            brfr_select_units( "{$image_name}_width", $defaults["{$image_name}_width_units"] ),
            "{$image_name}_height" => array(
                "label_be_for" => __('Height', 'brands-for-woocommerce'),
                "type"         => "number",
                "class"        => "br_brand_number",
                "name"         => "{$image_name}_height",
                "value"        => $defaults["{$image_name}_height"],
            ),
            brfr_select_units( "{$image_name}_height", $defaults["{$image_name}_height_units"] ),
            "{$image_name}_fit" => array(
                "label_be_for" => __('Fit', 'brands-for-woocommerce'),
                "type"         => "selectbox",
                "name"         => "{$image_name}_fit",
                "value"        => $defaults["{$image_name}_fit"],
                "options"      => array(
                    array("value" => "cover",   "text" => __( 'Cover', 'brands-for-woocommerce' )),
                    array("value" => "contain", "text" => __( 'Contain', 'brands-for-woocommerce' )),
                    array("value" => "fill",    "text" => __( 'Fill', 'brands-for-woocommerce' )),
                    array("value" => "none",    "text" => __( 'None', 'brands-for-woocommerce' )),
                ),
            ),
            "{$image_name}_align" => array(
                "label_be_for" => __('Align', 'brands-for-woocommerce'),
                "type"         => "selectbox",
                "name"         => "{$image_name}_align",
                "value"        => $defaults["{$image_name}_align"],
                "options"      => $args['align_options'],
            ),
        ),
    );
}

function brfr_select_units( $property, $default = 'px', $class = '', $extra = '' ) {
    $property_units = "{$property}_units";

    return array(
        "type"    => "selectbox",
        "options" => array(
            array( 'value' => 'px', 'text' => 'px' ),
            array( 'value' => '%', 'text' => '%' ),
        ),
        "extra" => " $extra",
        "name"  => $property_units,
        "class" => "br_brands_units $class",
        "value" => $default,
    );
}
