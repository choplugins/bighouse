<?php
class BeRocket_base_brand_Widget extends WP_Widget {
    protected $defaults, $form_fields, $shortcode_args;

	public function __construct( $widget_name, $widget_title, $args ) {
	    $this->defaults = array(
	        'title'          => '',
	        'orderby'        => 'alphabet',
            'order'          => 'ASC',
	        'featured_first' => 1,
	        'count'          => 1,
	        'use_name'       => 1,
	        'img'            => 1,
	        'imgw'           => '',
	        'imgw_units'     => '%',
	        'imgh'           => 64,
	        'imgh_units'     => 'px',
	        'img_fit'        => 'cover',
	        'img_align'      => 'above',
	        'hide_empty'     => 1,
            'include'        => '',
            'exclude'        => '',
            'cache_key'      => '',
	    );

	    $this->form_fields = array(
	        'title' => array(
	        	'title' => __( 'Title:', 'brands-for-woocommerce' ),
	        	'type'  => 'text',
                'class' => 'width100',
	        ),
            'use_name' => array(
                'title' => __( 'Display text', 'brands-for-woocommerce' ),
                'type'  => 'checkbox',
                'class' => 'width100',
            ),
	        'img' => array(
	        	'title' => __( 'Image:', 'brands-for-woocommerce' ),
	        	'type'  => 'image',
                'class' => 'width100',
	        ),
            'orderby' => array(
                'title'   => __( 'Order by:', 'brands-for-woocommerce' ),
                'type'    => 'select',
                'attributes' => array(
                    'options' => array(
                        'alphabet' => __( 'Alphabet', 'brands-for-woocommerce' ),
                        'products' => __( 'Number of products', 'brands-for-woocommerce' ),
                        'order'    => __( 'Order', 'brands-for-woocommerce' ),
                        'random'   => __( 'Random', 'brands-for-woocommerce' ),
                    ),
                ),
                'class' => 'width50 nobasis',
            ),
            'order' => array(
                'title'   => __( '&nbsp;', 'brands-for-woocommerce' ),
                'type'    => 'select',
                'attributes' => array(
                    'options' => array(
                        'ASC'  => __( 'Asc', 'brands-for-woocommerce' ),
                        'DESC' => __( 'Desc', 'brands-for-woocommerce' ),
                    ),
                ),
                'class' => 'width50 nobasis',
            ),
            'count' => array(
                'title' => __( 'Show number of products', 'brands-for-woocommerce' ),
                'type'  => 'checkbox',
                'class' => 'width100',
            ),
	        'hide_empty' => array(
	        	'title' => __( 'Hide empty', 'brands-for-woocommerce' ),
	        	'type'  => 'checkbox',
                'class' => 'width100',
	        ),
            'featured_first' => array(
                'title' => __( 'Featured first', 'brands-for-woocommerce' ),
                'type'  => 'checkbox',
                'class' => 'width100',
            ),
	    );

        $this->shortcode_args = array(
            'use_image' => 'img',
            'image' => 'img',
            'text' => 'use_name',
        );

        parent::__construct( $widget_name, $widget_title, $args );

    }

    private function get_size( $side, $atts ) {
        if ( empty( $atts[$side] ) ) return $atts;
        $size = $atts[$side];

        if ( is_numeric( $size ) ) {
            if ( empty( $atts["{$side}_units"] ) ) {
                $atts["{$side}_units"] = 'px';
            }
        } else {
            $size_numeric = intval( $size );
            $atts["{$side}_units"] = str_replace( $size_numeric, '', $size );
            $atts[$side] = $size_numeric;
       }
        return $atts;
    }

    public function widget($args, $instance) {
        $instance = wp_parse_args( (array) $instance, $this->defaults );
        $instance = $this->replace_shortcode_keys( $instance );

        $instance['title'] = apply_filters( 'widget_title', $instance['title'], $instance );
        $BeRocket_product_brand = BeRocket_product_brand::getInstance();
        $options = $BeRocket_product_brand->get_option();
        $instance = shortcode_atts( $this->defaults, $instance );
        if ( empty( $instance['cache_key'] ) ) {
            $instance['cache_key'] = $this->id;
        }
        $ordered_terms = $this->get_brands( $instance );
        set_query_var( 'atts', $instance );
        set_query_var( 'ordered_terms', $ordered_terms );

        ob_start();
        $BeRocket_product_brand->br_get_template_part( $args['template'] );
        $content = ob_get_clean();
        if( $content ) {
            echo $args['before_widget'];
            if ( $instance['title'] ) echo $args['before_title'], $instance['title'], $args['after_title'];
            echo $content;
            echo $args['after_widget'];
        }
	}

	public function update( $new_instance, $old_instance ) {
		// $instance = $old_instance;
        foreach ( array_keys( $this->defaults ) as $name ) {
    		$instance[$name] = empty( $new_instance[$name] ) ? '' : strip_tags( $new_instance[$name] );
        }
        $BeRocket_product_brand = BeRocket_product_brand::getInstance();
        $options = $BeRocket_product_brand->get_option();
        if ( !empty( $options['use_cache'] ) ) {
            delete_transient( $this->id );
        }
		return $instance;
	}

    protected function form_query( $atts ) {
        // raw query to order taxonomy terms by multiple meta values
        global $wpdb;
        $hide_empty = empty( $atts['hide_empty'] ) ? '' : "AND tt.count <> ''";
        $match_id_list = '/^[0-9, .]*$/';
        $exclude = empty( $atts['exclude'] ) || !preg_match( $match_id_list, $atts['exclude'] ) ? '' : "AND t.term_id NOT IN ({$atts['exclude']})";
        $include = empty( $atts['include'] ) || !preg_match( $match_id_list, $atts['include'] ) ? '' : "AND t.term_id IN ({$atts['include']})";
        $order = $atts['order'] == 'DESC' ? 'DESC' : 'ASC';

        $taxonomy = BeRocket_product_brand::$taxonomy_name;
        $query = array(
            'select' => "SELECT t.slug, tt.description, t.term_id, t.name, tt.count, tm_image.meta_value as image, tm_tooltip.meta_value AS tooltip",
            'from' => "FROM {$wpdb->prefix}terms AS t
                LEFT JOIN {$wpdb->prefix}term_taxonomy AS tt ON t.term_id = tt.term_id
                LEFT JOIN {$wpdb->prefix}termmeta AS tm_image ON t.term_id = tm_image.term_id AND tm_image.meta_key='brand_image_url'
                LEFT JOIN {$wpdb->prefix}termmeta AS tm_tooltip ON t.term_id = tm_tooltip.term_id AND tm_tooltip.meta_key='br_brand_tooltip'",
            'orderby' => array(),
            'where' => "WHERE tt.taxonomy='$taxonomy' $include $exclude $hide_empty",
            'limit' => '',
        );

        if ( !empty( $atts['featured_first'] ) ) {
            $query['from'] .= " LEFT JOIN {$wpdb->prefix}termmeta AS tm_featured ON t.term_id = tm_featured.term_id AND tm_featured.meta_key='br_brand_featured'";
            $query['orderby'][] = "cast(tm_featured.meta_value AS unsigned) DESC";
        }

        switch ( $atts['orderby'] ) {
            case 'random':
                $query['orderby'] = array( "RAND()" );
                break;

            case 'order':
                $query['from'] .= " LEFT JOIN {$wpdb->prefix}termmeta AS tm_order ON t.term_id = tm_order.term_id AND tm_order.meta_key='br_brand_order'";
                $query['orderby'][] = "cast(tm_order.meta_value as unsigned) $order, t.name ASC";
                break;

            case 'count':
            case 'products':
                $query['orderby'][] = "tt.count $order, t.name ASC";
                break;

            case 'alphabet':
            case 'name':
                $query['orderby'][] = "t.name $order";
                break;

            case 'slug':
                $query['orderby'][] = "t.slug $order";
                break;

            case 'description':
                $query['orderby'][] = "tt.description $order";
                break;

            default:
                break;
        }
        return $query;
    }

    protected function add_attributes( $term ) {
        // $term->count = number of products not including child brands
        // if ( !empty( get_term_children( $term->term_id, BeRocket_product_brand::$taxonomy_name ) ) ) {
        //     $posts = get_posts( array(
        //         'post_type' => 'product',
        //         'numberposts' => -1,
        //         'tax_query' => array(
        //         array(
        //             'taxonomy' => BeRocket_product_brand::$taxonomy_name,
        //             'field' => 'term_id', 
        //             'terms' => $term->term_id,
        //             'include_children' => true
        //             )
        //     )));
        //     $term->count_posts = count( $posts );
        // } else {
        //     $term->count_posts = $term->count;
        // }
        $term->count_posts = $term->count;

        $term->link = get_term_link( (int)$term->term_id, BeRocket_product_brand::$taxonomy_name );
        $term->tooltip = BeRocket_product_brand::get_tooltip_data( $term->tooltip );
        return $term;
    }

    protected function sort_terms( $terms, $atts ) {
        foreach ( $terms as $index => $term ) {
            $terms[$index] = $this->add_attributes( $term );
        }
        return $terms;
    }

    protected function get_brands( $atts ) {
        $BeRocket_product_brand = BeRocket_product_brand::getInstance();
        $cached_terms = $BeRocket_product_brand->get_from_cache( $atts['cache_key'] );
        if( !empty( $cached_terms ) ) {
            return $cached_terms;
        }

        global $wpdb;
        $query = $this->form_query( $atts );
        $orderby = empty( $query['orderby'] ) ? '' : 'ORDER BY ' . implode( ', ', $query['orderby'] );
        $terms = $wpdb->get_results( "{$query['select']} {$query['from']} {$query['where']} $orderby {$query['limit']}" );
        if( empty( $terms ) || !is_array($terms) ) return array();

        $terms = $this->sort_terms( $terms, $atts );

        $BeRocket_product_brand->set_to_cache( $atts['cache_key'], $terms );
        return $terms;
    }

    // $args = array( 'attributes' => [ options for <select> as array( 'value' => 'title' ); or placeholder, min/max for <input> ] 
    private function form_field_text( $name, $title, $instance, $class = '', $args = array() ) {
    	$field_id = $this->get_field_id( $name );
    	$field_name = $this->get_field_name( $name );
    	$field_value = esc_attr( $instance[$name] );
        $attributes = $args['attributes'];
        $input_class = empty( $attributes['class'] ) ? '' : $attributes['class'];
        $placeholder = empty( $attributes['placeholder'] ) ? '' : "placeholder='{$attributes['placeholder']}'";

    	$html = "<input class='widefat $input_class' name='$field_name' type='text' value='$field_value' $placeholder />";

    	if ( empty( $title ) ) return $html;
    	return "<p class='$class'><label for='$field_id'>$title</label> $html</p>";
    }

    private function form_field_checkbox( $name, $title, $instance, $class = '', $args = array() ) {
    	$field_id = $this->get_field_id( $name );
    	$field_name = $this->get_field_name( $name );
    	$checked = $instance[$name] ? 'checked' : '';
        $input_class = empty( $args['attributes']['class'] ) ? '' : "class='{$args['attributes']['class']}'";

    	$html = "<input type='checkbox' value='1' $input_class name='$field_name' $checked />";

    	if ( empty( $title ) ) return $html;
        return "<p class='$class'>$html <label for='$field_id'>$title</label></p>";
    }

    private function form_field_select( $name, $title, $instance, $class = '', $args = array() ) {
    	$field_id = $this->get_field_id( $name );
    	$field_name = $this->get_field_name( $name );
    	$saved_value = $instance[$name];
        $select_class = empty( $args['attributes']['class'] ) ? '' : "class='{$args['attributes']['class']}'";

    	$html = "<select $select_class name='$field_name'>";
        foreach ( $args['attributes']['options'] as $option_value => $option_name ) {
            $selected = $option_value == $saved_value ? 'selected' : '';
            $html .= "<option value='$option_value' $selected>$option_name</option>";
        }
        $html .= '</select>';

    	if ( empty( $title ) ) return $html;
        return "<p class='$class'><label for='$field_id'>$title</label> $html</p>";
    }

    private function form_field_number( $name, $title, $instance, $class = '', $args = array() ) {
    	$field_id = $this->get_field_id( $name );
    	$field_name = $this->get_field_name( $name );
        $input_class = empty( $args['attributes']['class'] ) ? '' : $args['attributes']['class'];
        $placeholder = empty( $args['attributes']['placeholder'] ) ? '' : "placeholder='{$args['attributes']['placeholder']}'";
        $min = empty( $args['attributes']['min'] ) ? "min='0'" : "min='{$args['attributes']['min']}'";
        $max = empty( $args['attributes']['max'] ) ? '' : "max='{$args['attributes']['max']}'";

    	$html = "<input type='number' $min $max class='br_brand_number $input_class' value='{$instance[$name]}' name='$field_name' $placeholder />";

    	if ( empty( $title ) ) return $html;
        return "<p class='$class'><label for='$field_id'>$title</label> $html</p>";
    }

    private function form_field_size( $name, $title, $instance, $class = '', $args = array() ) {
        $field_id = $this->get_field_id( $name );
        $field_name = $this->get_field_name( $name );

    	$html = $this->form_field_number( $name, '', $instance );
    	$html .= $this->form_field_select( "{$name}_units", '', $instance, '', array( 
            'attributes' => array(
                'options' => array( 'px' => 'px', '%' => '%' ), 
            ),
        ) );

    	return "<p class='$class'><label for='$field_id'>$title</label> $html</p>";
	}

    private function form_field_image( $name, $title, $instance, $class = '', $args = array() ) {
    	$html = "<fieldset class='br_brand_fieldset br_brand_image_options'><legend>$title</legend>";

    	$html .= $this->form_field_checkbox( $name, __( 'Display', 'brands-for-woocommerce' ), $instance, 'width100' );
    	$html .= $this->form_field_size( "{$name}w", __( 'Width', 'brands-for-woocommerce' ), $instance, 'width50' );
    	$html .= $this->form_field_size( "{$name}h", __( 'Height', 'brands-for-woocommerce' ), $instance, 'width50' );
    	$html .= $this->form_field_select( "{$name}_fit", __( 'Fit', 'brands-for-woocommerce' ), $instance, 'width50', 
            array( 'attributes' => array( 'options' => array(
                "cover"   => __( 'Cover', 'brands-for-woocommerce' ),
                "contain" => __( 'Contain', 'brands-for-woocommerce' ),
                "fill"    => __( 'Fill', 'brands-for-woocommerce' ),
                "none"    => __( 'None', 'brands-for-woocommerce' ),
            ) ) ) );
    	$html .= $this->form_field_select( "{$name}_align", __( 'Align', 'brands-for-woocommerce' ), $instance, 'width50', 
            array( 'attributes' => array( 'options' => array(
                "above" => __( 'Above name', 'brands-for-woocommerce' ),
                "left"  => __( 'Left to name', 'brands-for-woocommerce' ),
                "right" => __( 'Right to name', 'brands-for-woocommerce' ),
                "under" => __( 'Under name', 'brands-for-woocommerce' ),
            ) ) ) );
        $html .= "</fieldset>";
    	return $html;
    }

    private function form_field_color( $name, $title, $instance, $class = '', $args = array() ) {
        $field_id = $this->get_field_id( $name );
        $field_name = $this->get_field_name( $name );

        return 
            "<p class='$class'>
                <label for='$field_id'>$title</label>
                <input class='widefat br_brand_colorpicker' id='$field_id' name='$field_name' type='text' value='{$instance['border_color']}' />
            </p>";
    }

	public function form($instance) {
        $instance = $this->replace_shortcode_keys( $instance );
        $instance = wp_parse_args( (array)$instance, $this->defaults );

        echo "<div class='br_brand_widget_oprions'>";
        foreach ( $this->form_fields as $name => $field ) {
        	$function = "form_field_{$field['type']}";
            $options = empty( $field['attributes'] ) ? array() : $field['attributes'];
        	echo $this->$function( $name, $field['title'], $instance, $field['class'], array( 'attributes' => $options ) );
        }
        echo "</div>";
	}

    private function replace_shortcode_keys( $instance ) {
        foreach ( $this->shortcode_args as $old => $new ) {
            if ( !isset( $instance[ $new ] )  && isset( $instance[ $old ] ) ) {
                $instance[ $new ] = $instance[ $old ];
            }
        }

        if ( !empty( $instance['border_color'] ) && strpos( $instance['border_color'], '#') === false ) {
            $instance['border_color'] = "#{$instance['border_color']}";
        }

        $instance = $this->get_size( 'imgw', $instance );
        $instance = $this->get_size( 'imgh', $instance );

        return $instance;
    }
}
?>
