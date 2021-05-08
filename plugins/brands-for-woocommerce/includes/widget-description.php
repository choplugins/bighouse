<?php
class BeRocket_product_brand_description_Widget extends WP_Widget 
{
    public static $defaults = array(
        'display_title'         => '',
        'thumbnail_display'     => '1',
        'display_description'   => '1',
        'thumbnail_width'       => '100%',
        'thumbnail_align'       => 'none',
    );
	public function __construct() {
        parent::__construct( 
            "berocket_product_brand_description_widget", 
            __( "WooCommerce Product Brands Description", 'brands-for-woocommerce' ),
            array( "description" => "" ) 
        );
    }
    /**
     * WordPress widget
     */
    public function widget($args, $instance)
    {
        $instance = $this->replace_deprecated_keys( $instance );
        if ( !is_tax( BeRocket_product_brand::$taxonomy_name ) || !get_query_var( 'term' ) ) {
			return;
        }
        $instance['display_title'] = apply_filters( 'widget_title', empty($instance['display_title']) ? '' : $instance['display_title'], $instance );

        $width = intval( $instance['thumbnail_width'] );
        $units = str_replace( $width, '', $instance['thumbnail_width'] );
        $instance['thumbnail_width'] = $width;
        $instance['thumbnail_width_units'] = empty( $units ) ? 'px' : $units;

        $instance = wp_parse_args( (array) $instance, self::$defaults );
        $term = get_term_by( 'slug', get_query_var( 'term' ), BeRocket_product_brand::$taxonomy_name );
        $image 	= get_term_meta( $term->term_id, 'brand_image_url', true );

        set_query_var( 'options', $instance );
        set_query_var( 'brand_term', $term );
        set_query_var( 'brand_banner', get_term_meta( $term->term_id, 'brand_banner_url', true ) );
        set_query_var( 'brand_thumbnail', get_term_meta( $term->term_id, 'brand_image_url', true ) );
        set_query_var( 'brand_url', get_term_meta( $term->term_id, 'br_brand_url', true ) );
        set_query_var( 'tooltip', BeRocket_product_brand::get_tooltip( $term->term_id ) );

        // set_query_var( 'display_thumbnail', @ $instance['display_thumbnail'] );
        // set_query_var( 'display_description', @ $instance['display_description'] );
        // set_query_var( 'width', @ $instance['width'] );
        // set_query_var( 'align', @ $instance['align'] );
        // set_query_var( 'brand_term', @ $term );
        // set_query_var( 'brand_image', @ $image );
        ob_start();
        $BeRocket_product_brand = BeRocket_product_brand::getInstance();
        $BeRocket_product_brand->br_get_template_part( 'description' );
        $content = ob_get_clean();
        if( $content ) {
            echo $args['before_widget'];
            if( @ $instance['display_title'] ) {
                echo $args['before_title'].$term->name.$args['after_title'];
            }
            echo $content;
            echo $args['after_widget'];
        }
	}
    /**
     * Update widget settings
     */
	public function update( $new_instance, $old_instance ) {
        // $instance = $old_instance;
        foreach ( array_keys( BeRocket_product_brand_description_Widget::$defaults ) as $name ) {
            $instance[$name] = empty( $new_instance[$name] ) ? '' : strip_tags( $new_instance[$name] );
        }
		return $instance;
	}
    /**
     * Widget settings form
     */
	public function form($instance)
	{
        $instance = wp_parse_args( (array) $instance, self::$defaults );
        $instance = $this->replace_deprecated_keys( $instance );
		?>
        <p>
            <label><input type="checkbox" value="1" name="<?php echo $this->get_field_name('display_title'); ?>"<?php if(@ $instance['display_title']) echo ' checked'; ?>><?php _e( 'Display title', 'brands-for-woocommerce' ); ?></label>
        </p>
        <p>
            <label><input type="checkbox" value="1" name="<?php echo $this->get_field_name('thumbnail_display'); ?>"<?php if(@ $instance['thumbnail_display']) echo ' checked'; ?>><?php _e( 'Display thumbnails', 'brands-for-woocommerce' ); ?></label>
        </p>
        <p>
            <label><input type="checkbox" value="1" name="<?php echo $this->get_field_name('display_description'); ?>"<?php if(@ $instance['display_description']) echo ' checked'; ?>><?php _e( 'Display description', 'brands-for-woocommerce' ); ?></label>
        </p>
        <p>
            <label><?php _e( 'Image width', 'brands-for-woocommerce' ); ?></label>
            <input type="text" value="<?php echo $instance['thumbnail_width']; ?>" name="<?php echo $this->get_field_name('thumbnail_width'); ?>">
        </p>
        <p>
            <label><?php _e( 'Image align', 'brands-for-woocommerce' ); ?></label>
            <select name="<?php echo $this->get_field_name('thumbnail_align'); ?>">
                <?php
                $align = array(
                    'none' => __( 'none', 'brands-for-woocommerce' ),
                    'left' => __( 'Left', 'brands-for-woocommerce' ),
                    'right' => __( 'Right', 'brands-for-woocommerce' ),
                );
                foreach($align as $align_id => $align_name) {
                    echo '<option value="', $align_id, '"', ($align_id == $instance['thumbnail_align'] ? 'selected' : ''), '>', $align_name, '</option>';
                }
                ?>
            </select>
        </p>
		<?php
	}
    private function replace_deprecated_keys( $instance ) {
        $replace_args = array(
            'thumbnail_display' => 'display_thumbnail',
            'thumbnail_width'   => 'width',
            'thumbnail_align'   => 'align',
        );
        foreach ( $replace_args as $new => $old ) {
            if ( !isset( $instance[ $new ] ) && isset( $instance[ $old ] ) ) {
                $instance[$new] = $instance[$old];
            }
        }
        return $instance;
    }

}
?>
