<?php
class BeRocket_product_brand_widget extends BeRocket_base_brand_Widget {
	public function __construct() {
        parent::__construct(
            "berocket_product_brand_widget", 
            __( "WooCommerce Brand List", 'brands-for-woocommerce' ),
            array( "description" => "" )
        );

        $this->defaults += array(
            'per_row'       => 3,
            'brands_number' => '',
            'slider'        => 1,
            'padding'       => 3,
            'margin'        => 3,
            'border_color'  => '#000000',
            'border_width'  => '',
        );

        $BeRocket_product_brand = BeRocket_product_brand::getInstance();
        $options = $BeRocket_product_brand->get_option();

        $this->form_fields += array(
            'slider' => array(
                'title' => __( 'Slider', 'brands-for-woocommerce' ),
                'type'  => 'checkbox',
                'class' => 'width100',
            ),
        );

        if ( $options['slider_mode'] == 'slide' ) {
            $this->form_fields += array(
                'per_row' => array(
                    'title' => __( 'Brands per row', 'brands-for-woocommerce' ),
                    'type'  => 'number',
                    'attributes' => array(
                        'min' => 1,
                    ),
                    'class' => 'width50',
                ),
            );
        }

        $this->form_fields += array(
            'brands_number' => array(
                'title' => __( 'Brands in list', 'brands-for-woocommerce' ),
                'type'  => 'number',
                'attributes' => array(
                    'placeholder' => __( 'All', 'brands-for-woocommerce' ),
                    'min' => 1,
                ),
                'class' => 'width50',
            ),
            'padding' => array(
                'title' => __( 'Padding, px', 'brands-for-woocommerce' ),
                'type'  => 'number',
                'class' => 'width50',
            ),
            'margin' => array(
                'title' => __( 'Margin, px', 'brands-for-woocommerce' ),
                'type'  => 'number',
                'class' => 'width50',
            ),
            'border_width' => array(
                'title' => __( 'Border width, px', 'brands-for-woocommerce' ),
                'type'  => 'number',
                'class' => 'width100 fixedlabelwidth',
            ),
            'border_color' => array(
                'title' => __( 'Border color', 'brands-for-woocommerce' ),
                'type'  => 'color',
                'class' => 'width100 fixedlabelwidth br_brand_colorpalette',
            ),
        );
    }

    protected function form_query( $atts ) {
        global $wpdb;
        $query = parent::form_query( $atts );
        $query['limit'] = empty( $atts['brands_number'] ) ? '' : $query['limit'] = "LIMIT {$atts['brands_number']}";
        return $query;
    }

    public function widget($args, $instance) {
        $args['template'] = 'list-template';
        parent::widget( $args, $instance );
	}
}
?>
