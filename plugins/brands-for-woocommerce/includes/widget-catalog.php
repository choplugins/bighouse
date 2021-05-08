<?php
class BeRocket_alphabet_brand_widget extends BeRocket_base_brand_Widget {

    public function __construct() {
        parent::__construct(
            "berocket_alphabet_brand_widget", 
            __( "WooCommerce Brand Catalog", 'brands-for-woocommerce' ),
            array( "description" => "" )
        );

        $this->defaults += array(
            'groupby' => 'alphabet',
            'style'   => 'vertical',
            'show_all' => 1,
            'column'   => 2,
        );

        $this->form_fields += array(
            'show_all' => array(
                'title' => __( 'Show "All" tab', 'brands-for-woocommerce' ),
                'type'  => 'checkbox',
                'class' => 'width100',
            ),
            'groupby' => array(
                'title'   => __( 'Group by:', 'brands-for-woocommerce' ),
                'type'    => 'select',
                'attributes' => array(
                    'options' => array(
                        'alphabet'  => __( 'Alphabet', 'brands-for-woocommerce' ),
                        'category'  => __( 'Category', 'brands-for-woocommerce' ),
                        'none'      => __( 'None', 'brands-for-woocommerce' ),
                    ),
                ),
                'class' => 'width100',
            ),
            'style' => array(
                'title'   => __( 'Layout:', 'brands-for-woocommerce' ),
                'type'    => 'select',
                'attributes' => array(
                    'options' => array(
                        'vertical' => __( 'Vertical', 'brands-for-woocommerce' ),
                        'horizontal' => __( 'Horizontal', 'brands-for-woocommerce' ),
                    ),
                ),
                'class' => 'width50 nobasis',
            ),
            'column' => array(
                'title' => __( 'Columns:', 'brands-for-woocommerce' ),
                'type'  => 'number',
                'attributes' => array(
                    'min' => 1,
                ),
                'class' => 'width50 nobasis',
            ),
        );
    }

    public function widget( $args, $instance ) {
        $args['template'] = 'catalog';
        parent::widget( $args, $instance );
    }

    private function br_get_brand_by_category( $term ) {
        return empty( $term->category ) ? array( __( 'Uncategorized', 'brands-for-woocommerce' ) ) : unserialize( $term->category );
    }

    private function br_get_brand_by_alphabet( $term ) {
        return array( mb_strtoupper( mb_substr( $term->name, 0, 1 ) ) );
    }

    private function br_get_brand_by_none( $term ) {
        return array( 0 );
    }

    protected function form_query( $atts ) {
        global $wpdb;
        $query = parent::form_query( $atts );
        $query['select'] .= ", tm_cat.meta_value as category";
        $query['from'] .= " LEFT JOIN {$wpdb->prefix}termmeta AS tm_cat ON t.term_id = tm_cat.term_id AND tm_cat.meta_key='br_brand_category'";
        return $query;
    }

    protected function sort_terms( $terms, $atts ) {
        if ( empty( $terms ) ) return;
        if ( empty( $atts['groupby'] ) ) $atts['groupby'] = 'alphabet';

        $function = "br_get_brand_by_{$atts['groupby']}";
        $ordered_terms = array();
        foreach ( $terms as $index => $term ) {
            $terms[$index] = $this->add_attributes( $term );

            $keys = $this->$function( $term );
            foreach ( $keys as $key ) {
                $ordered_terms[$key][] = $term;
            }
        }
        unset($ordered_terms['Uncategorized']);
        ksort( $ordered_terms );
        return $ordered_terms;
    }
}
