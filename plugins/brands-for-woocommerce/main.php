<?php
define( "BeRocket_product_brand_domain", 'brands-for-woocommerce'); 
define( "product_brand_TEMPLATE_PATH", plugin_dir_path( __FILE__ ) . "templates/" );
load_plugin_textdomain('brands-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
require_once(plugin_dir_path( __FILE__ ).'berocket/framework.php');
foreach ( glob( __DIR__ . "/includes/*.php" ) as $filename ) {
    include_once($filename);
}

class BeRocket_product_brand extends BeRocket_Framework {
    public static $settings_name = 'br-product_brand-options', $taxonomy_name = 'berocket_brand';
    protected static $instance;
    protected $plugin_version_capability = 15;
    public $info, $defaults, $values;
    private $attributes;

    private $cache_key = 'br_brands_cache_', $cache_time = 60*60*24, $cache_list = 'br_brands_cache_list';

    function __construct () {
        global $berocket_unique_value;
        $berocket_unique_value = 1;

        $this->info = array(
            'id'          => 19,
            'version'     => BeRocket_product_brand_version,
            'plugin'      => '',
            'slug'        => '',
            'key'         => '',
            'name'        => '',
            'plugin_name' => 'product_brand',
            'full_name'   => 'Brands for WooCommerce',
            'norm_name'   => 'Brands',
            'price'       => '24',
            'domain'      => 'brands-for-woocommerce',
            'templates'   => product_brand_TEMPLATE_PATH,
            'plugin_file' => BeRocket_product_brand_file,
            'plugin_dir'  => __DIR__,
        );

        $this->defaults = array(
            'use_cache'                   => 1,
            'thumbnail_display'          => 1,
            'thumbnail_align'            => 'left',
            'thumbnail_fit'              => 'cover',
            'thumbnail_height'           => '',
            'thumbnail_height_units'     => 'px',
            'thumbnail_width'            => 10,
            'thumbnail_width_units'      => '%',
            'banner_display'             => '',
            'banner_align'               => 'none',
            'banner_fit'                 => 'cover',
            'banner_height'              => '',
            'banner_height_units'        => 'px',
            'banner_width'               => 100,
            'banner_width_units'         => '%',
            'display_description'        => 1,
            'display_link'               => 1,
            'link_text'                  => __( 'Go to the brand website >>', 'brands-for-woocommerce' ),
            'link_open_in_new_tab'       => 1,
            'slider_autoplay'             => 1,
            'slider_autoplay_speed'       => 5000,
            'slider_change_speed'         => 1000,
            'slider_infinite'             => 1,
            'slider_arrows'               => 1,
            'slider_slides_scroll'        => 1,
            'slider_mode'                 => 'slide',
            'slider_ease'                 => 'linear',
            'slider_stop_focus'           => 1,
            'slider_dots'                 => '',
            'slider_dots_color'           => '#00CFFF',
            'custom_css'                  => '',
            'global_font_awesome_disable' => 1,
            'global_fontawesome_version'  => '',
            'script'                      => array(
                'js_page_load' => '',
            ),
            'fontawesome_frontend_disable' => '',
            'fontawesome_frontend_version' => '',
        );

        $this->attributes = array(
            'brand_image_url' => array(
                'type' => 'image',
                'label' => __( 'Thumbnail', 'brands-for-woocommerce' ),
                'image_name' => 'br_brand_image',
            ),
            'brand_banner_url' => array(
                'type' => 'image',
                'label' => __( 'Banner', 'brands-for-woocommerce' ),
                'image_name' => 'br_brand_banner',
            ),
            'br_brand_category' => array(
                'type' => 'category_checklist',
                'label' => __( 'Categories', 'brands-for-woocommerce' ),
                'description' => __( 'Product categories', 'brands-for-woocommerce' ),
                'default' => false,
            ),
            'br_brand_tooltip' => array(
                'type' => 'text',
                'label' => __( 'Tooltip', 'brands-for-woocommerce' ),
                'description' => __( 'Optional message to pop up on hover or on click', 'brands-for-woocommerce' ),
            ),
            'br_brand_order' => array(
                'type' => 'hidden',
                'label' => '',
                'default' => 0,
            ),
            // 'br_brand_order' => array(
            //     'type' => 'number',
            //     'attributes' => array(
            //         'min' => '0',
            //     ),
            //     'label' => __( 'Order', 'brands-for-woocommerce' ),
            //     'description' => __( 'Order for output the brand ', 'brands-for-woocommerce' ),
            //     'default' => 0,
            // ),
            'br_brand_featured' => array(
                'type' => 'checkbox',
                'label' => __( 'Featured', 'brands-for-woocommerce' ),
                'description' => __( 'Featured brands can be output first or you may select to show featured brands only', 'brands-for-woocommerce' ),
            ),
            'br_brand_url' => array(
                'type' => 'url',
                'label' => __( 'URL', 'brands-for-woocommerce' ),
                'description' => __( 'Link to the brand page or to the external website', 'brands-for-woocommerce' ),
            ),
            // 'br_brand_color' => array(
            //     'type' => 'color',
            //     'label' => __( 'Color', 'brands-for-woocommerce' ),
            //     'default' => '#000000',
            // ),
        );

        $this->values = array(
            'settings_name' => 'br-product_brand-options',
            'option_page'   => 'br-product_brand',
            'premium_slug'  => 'woocommerce-brands',
            'free_slug'     => 'brands-for-woocommerce',
        );

        // List of the features missed in free version of the plugin
        $this->feature_list = array();
        $this->framework_data['fontawesome_frontend'] = true;

        $this->active_libraries = array('addons', 'popup');
        parent::__construct( $this );

        if ( $this->init_validation() ) {
            add_action ( 'init', array( $this, 'register_taxonomy' ) );
            $options = $this->get_option();

            add_filter( 'br_brands_options_to_update', array($this, 'options_to_update'), 10 );
            
            $last_version = get_option('berocket_version_'.$this->info['plugin_name']);
            if( $last_version === FALSE ) $last_version = 0;
            if ( version_compare($last_version, $this->info['version'], '<') ) {
                $this->update_from_older ( $last_version );
            }
            $this->plugin_version_check();

            add_filter( 'berocket_framework_item_content_ajax_button', array( $this, 'ajax_button' ), 10, 6 );

            add_action( "wp_ajax_br_brands_clear_cache", array ( $this, 'clear_cache_ajax' ) );
            add_action( "wp_ajax_nopriv_br_brands_clear_cache", array ( $this, 'clear_cache_ajax' ) );
            add_action( "wp_ajax_br_brands_save_order", array ( $this, 'save_order' ) );
            add_action( "wp_ajax_nopriv_br_brands_save_order", array ( $this, 'save_order' ) );
            add_action( "wp_ajax_br_brands_save_all_orders", array ( $this, 'save_all_orders' ) );
            add_action( "wp_ajax_nopriv_br_brands_save_all_orders", array ( $this, 'save_all_orders' ) );

            add_action( "wp_ajax_br_product_brand_settings_save", array ( $this, 'save_settings' ) );
            add_action( "woocommerce_archive_description", array ( $this, 'description' ), 5 );
            add_action ( "widgets_init", array ( $this, 'widgets_init' ) );

            add_action ( "woocommerce_duplicate_product", array ( $this, 'woocommerce_duplicate_product' ), 10, 2 );

            // add_filter( 'woocommerce_product_export_column_names', array ( $this, 'brand_product_export_column_names' ) );
            add_filter( 'woocommerce_product_export_product_default_columns', array ( $this, 'brand_product_export_column_names' ) );
            $taxonimy_name = self::$taxonomy_name;
            add_filter( "woocommerce_product_export_product_column_$taxonimy_name", array ( $this, 'brand_export_product_column_brand_taxonomy' ), 10, 2 );

            add_filter( 'woocommerce_csv_product_import_mapping_options', array ( $this, 'brand_product_export_column_names' ) );
            add_filter( 'woocommerce_csv_product_import_mapping_default_columns', array ( $this, 'brand_product_import_mapping_default_columns' ) );
            add_filter( 'woocommerce_product_importer_parsed_data', array ( $this, 'brand_product_importer_parsed_data' ), 10, 2 );
            add_filter( 'woocommerce_product_import_inserted_product_object', array ( $this, 'brand_product_import_inserted_product_object' ), 10, 2 );
            // add_action ( "import_end", array ( $this, 'set_default_meta_values' ) );

            add_shortcode( 'brands_product_thumbnail', array( $this, 'shortcode_brands_product_thumbnail' ) );
            add_shortcode( 'brands_info', array( $this, 'shortcode_brands_info' ) );
            add_shortcode( 'product_brands_info', array( $this, 'shortcode_product_brands_info' ) );
            add_shortcode( 'brands_products', array( $this, 'products_shortcode' ) );
            add_shortcode( 'brands_list', array( $this, 'brands_list_shortcode' ) );
            add_shortcode( 'brands_catalog', array( $this, 'brands_catalog_shortcode' ) );
            add_shortcode( 'brands_by_name', array( $this, 'brands_catalog_shortcode' ) ); // for older versions

            add_filter( 'template_include', array( $this, 'template_loader' ) );
            add_action( 'current_screen', array( $this, 'register_permalink_option' ) );
            add_filter( 'berocket_filter_filter_type_array', array( $this, 'filter_type_array' ) );
            add_filter( 'BeRocket_updater_menu_order_sub_order', array($this, 'menu_order_sub_order') );
            //WC shortcode compatibility
            add_filter('shortcode_atts_products', array($this, 'wc_shortcode_atts'), 10, 3);
            add_filter('woocommerce_shortcode_products_query', array($this, 'wc_shortcode_query'), 10, 2);

            add_filter( 'br_brands_options_to_update', array($this, 'options_to_update'), 10 );

            add_filter( 'wc_get_template', array($this, 'get_brands_template'), 10, 5 );

            // add_filter( 'wp_insert_term_data', array($this, 'translit_brand_slug'), 10, 3 );
        }
        add_filter('parent_file', array($this, 'select_menu'));
        add_filter('submenu_file', array($this, 'select_submenu'));
    }

    // public function translit_brand_slug( $data, $taxonomy, $args ) {
    //     if ( $taxonomy != self::$taxonomy_name ) return $data;

    //     $data['slug'] = utf8_uri_encode( $title, 200 );
    //     return $data;
    // }

    public function init_validation() {
        return ( ( is_plugin_active( 'woocommerce/woocommerce.php' ) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) && 
            br_get_woocommerce_version() >= 2.1 );
    }
    public function update_from_older( $version ) {
        $options = $this->get_option();
        if ( version_compare($version, '3.0.1', '<') ) {
            $version_index = 1;
        } else {
            $version_index = 2;
        }

        if( $version_index == 1 && ! empty($options['product_thumbnail']) ) {
            $options['product_display_brand'] = '1';
            $options['product_display_position'] = 'after_title';
            $options['product_what_to_display_image'] = '1';
            $options['product_display_image_width'] = '35%';
        }
        update_option( $this->values['settings_name'], $options );
    }
    public function widgets_init() {
        register_widget("berocket_product_brand_widget");
        register_widget("berocket_product_brand_description_widget");
        register_widget("berocket_alphabet_brand_widget");
    }
    public function template_loader( $template ) {

		$find = array( 'woocommerce.php' );
		$file = '';

		if ( is_tax( self::$taxonomy_name ) ) {
			$term = get_queried_object();

			$woocommerce_url = apply_filters( 'woocommerce_template_url', 'woocommerce/' );
            $file   = 'taxonomy-' . $term->taxonomy . '.php';
			$find[] = 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
			$find[] = $woocommerce_url . 'taxonomy-' . $term->taxonomy . '-' . $term->slug . '.php';
			$find[] = $file;
			$find[] = $woocommerce_url . $file;
		}

		if ( $file ) {
			$template = locate_template( $find );
			if ( ! $template ) $template = product_brand_TEMPLATE_PATH . $file;
		}

		return $template;
	}

    public function get_brands_template( $located, $template_name, $args, $template_path, $default_path ) {
        if ( is_tax( self::$taxonomy_name ) && $template_name == 'loop/result-count.php' ) {
            $located = plugin_dir_path( __FILE__ ) . 'templates/result-count.php';
        }
        return $located;
    }

    public function ajax_button( $html, $field_item, $field_name, $value, $class, $extra ) {
        $html .= '<label>';
        if ( ! empty( $field_item[ 'label_be_for' ] ) ) {
            $html .= "<span class='br_label_be_for'>{$field_item[ 'label_be_for' ]}</span>";
        }
        $html .= "<input type='button' name='$field_name' value='" . htmlentities( $value ) . "' $class $extra />";
        if ( ! empty( $field_item[ 'label_for' ] ) ) {
            $html .= "<span class='br_label_for'>{$field_item[ 'label_for' ]}</span>";
        }
        $html .= '</label>';

        return $html;
    }

    public function shortcode_brands_product_thumbnail($atts = array()) {
        ob_start();
        $this->description_post($atts);
        $return = ob_get_clean();
        return apply_filters('shortcode_brands_product_thumbnail_return', $return, $atts);
    }
    public function shortcode_brands_info( $atts = array()) {
        $default = array('type' => 'name,image,description', 'id' => false);
        if( ! empty($atts) && is_array($atts) ) {
            $atts = array_merge($default, $atts);
        } else {
            $atts = $default;
        }
        if( empty ($atts['type']) ) {
            return;
        }
        if($atts['type'] == 'all') {
            $atts['type'] = $default['type'];
        }
        $values = explode(',', $atts['type']);
        if( empty($values) || ! is_array($values) || count($values) == 0 ) {
            return;
        }
        if( empty($atts['id']) ) {
            if( ! is_tax( self::$taxonomy_name ) ) {
                return;
            }
            if ( ! get_query_var( 'term' ) ) {
                return;
            }
            $term = get_term_by( 'slug', get_query_var( 'term' ), self::$taxonomy_name );
        } else {
            $term = get_term_by( 'term_id', $atts['id'], self::$taxonomy_name );
        }
        if ( empty($term) ) return;

        ob_start();
        do_action('brands_info_before', $term, $atts);
        $image 	= get_term_meta( $term->term_id, 'brand_image_url', true );
        foreach($values as $value) {
            if( $value == 'name' ) {
                echo '', $term->name, '';
            } elseif( $value == 'image' ) {
                echo '<img src="', $image, '" alt="', $term->name, '">';
            } elseif( $value == 'description' ) {
                echo '<div class="br_brand_description">', term_description($term), '</div>';
            }
        }
        do_action('brands_info_after', $term, $atts);
        $return = ob_get_clean();
        return apply_filters('shortcode_brands_info_return', $return, $term, $atts);
    }
    public function shortcode_product_brands_info($atts = array()) {
        $default = array('type' => 'name,image,description', 'product_id' => false);
        if( ! empty($atts) && is_array($atts) ) {
            $atts = array_merge($default, $atts);
        } else {
            $atts = $default;
        }
        if( empty ($atts['type']) ) {
            return;
        }
        if($atts['type'] == 'all') {
            $atts['type'] = $default['type'];
        }
        $values = explode(',', $atts['type']);
        if( empty($values) || ! is_array($values) || count($values) == 0 ) {
            return;
        }
        if( empty($atts['product_id']) ) {
            global $wp_query;
            $product_id = $wp_query->queried_object->ID;
        } else {
            $product_id = $atts['product_id'];
        }
        $terms = get_the_terms( $product_id, self::$taxonomy_name );
        if( $terms === false || is_wp_error($terms) ) {
            return;
        }
        $term = $terms[0];
        ob_start();
        do_action('product_brands_info_before', $term, $atts);
        $image 	= get_term_meta( $term->term_id, 'brand_image_url', true );
        foreach($values as $value) {
            if( $value == 'name' ) {
                echo '', $term->name, '';
            } elseif( $value == 'image' ) {
                echo '<img src="', $image, '" alt="', $term->name, '">';
            } elseif( $value == 'description' ) {
                echo '<div class="br_brand_description">', term_description($term), '</div>';
            }
        }
        do_action('product_brands_info_after', $term, $atts);
        $return = ob_get_clean();
        return apply_filters('shortcode_product_brands_info_return', $return, $term, $atts);
    }

    public function brands_catalog_shortcode( $atts = array() ) {
        if ( !is_array( $atts ) ) $atts = array();
        if ( !empty( $atts['position'] ) ) {
            $positions = array(
                1 => 'left',
                2 => 'right',
                3 => 'above',
            );
            if ( $atts['position'] == 4 ) {
                $atts['show_all'] = 1;
                $atts['img_align'] = 'left';
            } else if ( is_numeric( $atts['position'] ) ) {
                $atts['show_all'] = 0;
                $atts['img_align'] = $positions[$atts['position']];
            }
        }

        if ( empty( $atts['use_name'] ) ) $atts['use_name'] = 0;
        if ( empty( $atts['img'] ) ) $atts['img'] = 0;
        if ( $atts['use_name'] === 0 && $atts['img'] === 0 ) $atts['use_name'] = 1;

        $atts['cache_key'] = $this->get_cache_key();
        ob_start();
        the_widget( 'berocket_alphabet_brand_widget', $atts );
        $return = ob_get_clean();
        return apply_filters('brands_by_name_shortcode_return', $return, $atts);
    }

    public function brands_list_shortcode($atts = array()) {
        if ( !empty( $atts['padding'] ) ) $atts['padding'] = intval( $atts['padding'] );
        $atts['cache_key'] = $this->get_cache_key();
        if ( empty( $atts['slider'] ) ) $atts['slider'] = 0;
        ob_start();
        the_widget( 'berocket_product_brand_widget', $atts);
        $return = ob_get_clean();
        return apply_filters('brands_list_shortcode_return', $return, $atts);
    }

    public function products_shortcode($atts = array()) {
        $atts = shortcode_atts( array(
			'columns'   => '4',
			'orderby'   => 'title',
			'order'     => 'desc',
			'brand_id'  => '',
			'brand_slug'=> '',
			'operator'  => 'IN',
            'per_page'  => '12'
		), $atts );

		if ( empty($atts['brand_id']) && empty($atts['brand_slug']) ) {
			return '';
		}

		// Default ordering args
		$ordering_args = WC()->query->get_catalog_ordering_args( $atts['orderby'], $atts['order'] );
		$meta_query    = WC()->query->get_meta_query();
        if( ! empty($atts['brand_id']) ) {
            $brand = $atts['brand_id'];
            $brand_field = 'id';
        } elseif( ! empty($atts['brand_slug']) ) {
            $brand = $atts['brand_slug'];
            $brand_field = 'slug';
        }
        if( empty($atts['per_page']) ) {
            unset($atts['per_page']);
        }
		$query_args    = array(
			'post_type'            => 'product',
			'post_status'          => 'publish',
			'orderby'              => $ordering_args['orderby'],
			'order'                => $ordering_args['order'],
			'posts_per_page'       => (empty($atts['per_page']) ? '12' : $atts['per_page']),
			'meta_query'           => $meta_query,
			'tax_query'            => array(
				array(
					'taxonomy'     => self::$taxonomy_name,
					'terms'        => explode( ',', $brand ),
					'field'        => $brand_field,
					'operator'     => $atts['operator']
				)
			)
		);

		if ( isset( $ordering_args['meta_key'] ) ) {
			$query_args['meta_key'] = $ordering_args['meta_key'];
		}

		$return = $this->product_loop( $query_args, $atts, 'product_cat' );

		// Remove ordering query arguments
		WC()->query->remove_ordering_args();

        return apply_filters('brands_products_shortcode_return', $return, $atts);
    }
	private function product_loop( $query_args, $atts, $loop_name ) {
		global $woocommerce_loop;

		$products                    = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, $loop_name ) );
		$columns                     = absint( $atts['columns'] );
		$woocommerce_loop['columns'] = $columns;
		$woocommerce_loop['name']    = $loop_name;

		ob_start();
		if ( $products->have_posts() ) {
			?>

			<?php do_action( "woocommerce_shortcode_before_{$loop_name}_loop" ); ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php do_action( "woocommerce_shortcode_after_{$loop_name}_loop" ); ?>

			<?php
		} else {
			do_action( "woocommerce_shortcode_{$loop_name}_loop_no_results" );
		}

		woocommerce_reset_loop();
		wp_reset_postdata();

		return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
	}
    public function register_taxonomy () {
        $permalink_option = get_option( 'berocket_brands_permalink' );
        if( function_exists('wc_get_page_id') ) {
            $shop_page_id = wc_get_page_id( 'shop' );
        } else {
            $shop_page_id = woocommerce_get_page_id( 'shop' );
        }
		$base_slug = $shop_page_id > 0 && get_page( $shop_page_id ) ? get_page_uri( $shop_page_id ) : 'shop';
		$category_base = get_option('woocommerce_prepend_shop_page_to_urls') == "yes" ? trailingslashit( $base_slug ) : '';

		register_taxonomy( self::$taxonomy_name,
			array('product'),
			array(
				'hierarchical'          => true,
				'update_count_callback' => '_update_post_term_count',
				'label'                 => __( 'Brands', 'brands-for-woocommerce'),
				'labels'                => array(
                    'name'                  => __( 'Brands', 'brands-for-woocommerce' ),
                    'back_to_items'         => __( 'Back to Brands', 'brands-for-woocommerce' ),
                    'not_found'             => __( 'No brands found.', 'brands-for-woocommerce' ),
                    'singular_name'         => __( 'Brand', 'brands-for-woocommerce' ),
                    'search_items'          => __( 'Search Brands', 'brands-for-woocommerce' ),
                    'all_items'             => __( 'All Brands', 'brands-for-woocommerce' ),
                    'parent_item'           => __( 'Parent Brand', 'brands-for-woocommerce' ),
                    'parent_item_colon'     => __( 'Parent Brand:', 'brands-for-woocommerce' ),
                    'edit_item'             => __( 'Edit Brand', 'brands-for-woocommerce' ),
                    'update_item'           => __( 'Update Brand', 'brands-for-woocommerce' ),
                    'add_new_item'          => __( 'Add New Brand', 'brands-for-woocommerce' ),
                    'new_item_name'         => __( 'New Brand Name', 'brands-for-woocommerce' )
				),
				'show_ui'               => true,
                'show_in_menu'          => true,
				'show_admin_column'     => true,
				'show_in_nav_menus'     => true,
				'show_in_quick_edit'    => true,
				'meta_box_cb'           => 'post_categories_meta_box',
				'capabilities'          => array(
					'manage_terms'          => 'manage_product_terms',
					'edit_terms'            => 'edit_product_terms',
					'delete_terms'          => 'delete_product_terms',
					'assign_terms'          => 'assign_product_terms'
				),

				'rewrite' => array( 
                    'slug' => $category_base . ( empty($permalink_option) ? __( 'brands', 'brands-for-woocommerce' ) : $permalink_option ), 
                    'with_front' => true, 
                    'hierarchical' => true 
                )
			)
		);
    }
    public function init () {
        global $woocommerce;

        add_filter( 'woocommerce_coupon_is_valid', array( $this, 'validate_coupon' ), 10, 3 );
        add_filter( 'woocommerce_coupon_get_discount_amount', array( $this, 'apply_discount' ), null, 5 );

        parent::init();

        $options = $this->get_option();

        BeRocket_tooltip_display::$load_tippy = true;
        wp_register_style( 'berocket_slick', plugins_url( 'css/slick.css', __FILE__ ) );
        wp_register_script( 'berocket_slick', plugins_url( 'js/slick.min.js', __FILE__ ), array( 'jquery' ) );
        wp_register_script( 'br_brands_slider', plugins_url( 'js/slider.js', __FILE__ ), array( 'berocket_slick', 'jquery' ) );
        wp_register_script( 'br_brands_catalog', plugins_url( 'js/catalog.js', __FILE__ ), array( 'jquery' ) );
        wp_register_style( 'berocket_product_brand_style', plugins_url( 'css/frontend.css', __FILE__ ), 
            "", BeRocket_product_brand_version );
        wp_register_script( 'berocket_front', plugins_url( 'js/front.js',  __FILE__ ), 
            array( 'berocket_framework_tippy', 'jquery' ) );

        wp_enqueue_style( 'berocket_product_brand_style' );
        wp_enqueue_style( 'berocket_tippy' );
        wp_enqueue_script( 'berocket_front' );
    }
    function wc_get_product_brand_ids( $product_id ) {
        $product_brands = wc_get_product_term_ids( $product_id, self::$taxonomy_name );

        foreach ( $product_brands as $product_cat ) {
            $product_brands = array_merge( $product_brands, get_ancestors( $product_cat, self::$taxonomy_name ) );
        }

        return $product_brands;
    }
    function wc_get_brands_for_coupon( &$coupon ) {
		if ( ! isset( $coupon->in_brands ) && ! isset( $coupon->ex_brands ) ) {
            $in_brands = get_post_meta( $coupon->get_id(), self::$taxonomy_name, true );
            $ex_brands = get_post_meta( $coupon->get_id(), 'exclude_berocket_brand', true );
            $coupon->in_brands = $in_brands;
            $coupon->ex_brands = $ex_brands;
		} else {
            $in_brands = $coupon->in_brands;
            $ex_brands = $coupon->ex_brands;
        }
        return $coupon;
    }
    public function validate_coupon($valid, $coupon, $coupon_class) {
        if ( ! $valid ) return $valid;
        $valid = false;
        foreach ( $coupon_class->get_items_to_validate() as $item ) {
            if ( $coupon->get_exclude_sale_items() && $item->product && $item->product->is_on_sale() ) {
                continue;
            }
            if( $this->is_coupon_applied_to_product($item->product, $coupon) ) {
                $valid = true;
                break;
            }
        }
        return $valid;
    }
    public function apply_discount($discount, $amount, $cart_item, $single, $coupon) {
        if ( ! is_a( $coupon, 'WC_Coupon' ) || ! $coupon->is_type( array( 'fixed_product', 'percent' ) ) ) {
            return $discount;
        }
        if( $this->is_coupon_applied_to_product($cart_item['data'], $coupon) ) {
            return $discount;
        } else {
            return 0;
        }
    }
    function is_coupon_applied_to_product($product, $coupon) {
        $this->wc_get_brands_for_coupon($coupon);
        $is_in_brands = ! empty($coupon->in_brands) && is_array($coupon->in_brands) && count($coupon->in_brands) > 0;
        $is_ex_brands = ! empty($coupon->ex_brands) && is_array($coupon->ex_brands) && count($coupon->ex_brands) > 0;
        if ( ! $is_in_brands && ! $is_ex_brands ) {
            return true;
        }
        $product_brands = $this->wc_get_product_brand_ids( $product->get_id() );

        if ( $product->get_parent_id() ) {
            $product_brands = array_merge( $product_brands, $this->wc_get_product_brand_ids( $product->get_parent_id() ) );
        }
        if( ( $is_in_brands && count( array_intersect( $product_brands, $coupon->in_brands ) ) > 0) 
        || (! $is_in_brands && (! $is_ex_brands || count( array_intersect( $product_brands, $coupon->ex_brands ) ) == 0) ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Function adding styles/scripts and settings to admin_init WordPress action
     *
     * @access public
     *
     * @return void
     */
    public function admin_init () {
        parent::admin_init();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'berocket_widget-colorpicker-style' );
        wp_enqueue_script( 'berocket_widget-colorpicker' );

        global $pagenow;
        if( $pagenow == 'edit-tags.php' && !empty( $_GET['taxonomy'] ) && $_GET['taxonomy'] == self::$taxonomy_name ) {
            wp_enqueue_script( 'jquery-ui-sortable' );
        }

        wp_enqueue_script( 'berocket_product_brand_admin', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), BeRocket_product_brand_version );
        wp_register_style( 'berocket_product_brand_admin_style', plugins_url( 'css/admin.css', __FILE__ ), "", BeRocket_product_brand_version );
        wp_enqueue_style( 'berocket_product_brand_admin_style' );

        wp_localize_script( 'berocket_product_brand_admin', 'brandsHelper',
            array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            )
        );

        add_filter( 'berocket_framework_item_content_toggleswitch', array($this, 'toggleswitch'), 10, 8 );

		add_action( 'berocket_brand_add_form_fields', array( $this, 'add_field' ) );
		add_action( 'berocket_brand_edit_form_fields', array( $this, 'edit_field' ), 10, 2 );
		add_action( 'created_term', array( $this, 'field_save' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'field_save' ), 10, 3 );
        add_action( 'edit_term', array( $this, 'clear_cache_on_edit_brand' ), 10, 3 );
        add_action( 'created_term', array( $this, 'clear_cache_on_edit_brand' ), 10, 3 );
        add_action( 'delete_term', array( $this, 'clear_cache_on_edit_brand' ), 10, 3 );
        add_action( 'edit_post', array( $this, 'clear_cache_on_edit_post' ), 10, 2 );
		add_filter( 'woocommerce_product_filters', array( $this, 'product_filter' ) );
		add_action( 'woocommerce_coupon_options_usage_restriction', array( $this, 'coupon_field' ) );
		add_action( 'woocommerce_coupon_options_save', array( $this, 'save_coupon' ) );
        // add_filter( 'woocommerce_sortable_taxonomies', array($this, 'add_brands_to_sortable') );
        add_filter( 'woocommerce_screen_ids', array($this, 'woocommerce_screen_ids') );

        add_filter( "manage_berocket_brand_custom_column", array( $this, 'brand_custom_columns' ), 10, 3 );
        add_filter( "manage_edit-berocket_brand_columns", array( $this, 'brand_columns' ) );
        add_filter( "manage_edit-berocket_brand_sortable_columns", array( $this, 'brand_sortable_columns' ) );
        // add_filter( "manage_berocket_brand_custom_column", array( $this, 'brand_order_columns' ), 10, 3 );
        add_action( 'pre_get_terms', array( $this, 'pre_get_brands' ) );
    }

    public function toggleswitch( $html, $field_item, $field_name, $value, $class, $extra, $option_values, $option_deault_values ) {
        $checked = !empty( $option_values ) ? ' checked="checked" ' : '';
        $html .= 
            "<label class='br_toggleswitch'>
                {$field_item['label_be_for']}
                <span class='br_toggleswitch_slider_container'>
                    <input type='checkbox' name='$field_name' value='{$field_item['value']}' $checked $class $extra />
                    <span class='br_toggleswitch_slider'></span>
                </span>
                {$field_item['label_for']}
            </label>";
        return $html;
    }

    // public function add_brands_to_sortable($taxonomies) {
    //     $taxonomies[] = self::$taxonomy_name;
    //     return $taxonomies;
    // }

    public function brand_columns( $columns ) {
        $columns['brand_description'] = __( 'Description', 'brands-for-woocommerce' );
        $columns['order'] = __( 'Order', 'brands-for-woocommerce' );
        unset( $columns['description'] );
        return $columns;
    }

    public function brand_sortable_columns( $columns ) {
        $columns['order'] = __( 'Order', 'brands-for-woocommerce' );
        return $columns;
    }

    public function brand_custom_columns( $value, $name, $term_id ) {
        if ( $name == 'brand_description' ) {
            $value = wp_trim_words( term_description( $term_id ), 15 );
        } else if ( $name == 'order' ) {
            $order = get_term_meta( $term_id, 'br_brand_order', true );
            if ( $order === '' ) $order = 0;

            $saving_title = __( 'Saving...', 'brands-for-woocommerce' );
            $save_title = __( 'Save', 'brands-for-woocommerce' );
            $prev_title = __( 'Level up', 'brands-for-woocommerce' );
            $next_title = __( 'Level down', 'brands-for-woocommerce' );
            return 
                "<a href='#order-up' class='berocket_post_set_new_sortable br_brand_order' title='$prev_title'>
                    <i class='fa fa-arrow-up'></i>
                </a>
                <span class='berocket_post_set_new_sortable_input'>
                    <input class='br_brand_order_input' type='number' min='0' value='$order' />
                    <a class='berocket_post_set_new_sortable_set br_brand_order_save fa fa-arrow-circle-right' data-term_id='$term_id' href='#order-set' title='$save_title'></a>
                    <div class='br_brand_order_wait'>$saving_title</div>
                </span>
                <a href='#order-down' class='berocket_post_set_new_sortable br_brand_order' title='$next_title'>
                    <i class='fa fa-arrow-down'></i>
                </a>
                <i class='fa fa-bars ui-sortable-handle br-brands-sortable-handler'></i>";

            // return $value = '<span class="br-sorted-holder"><i class="fas fa-arrows-alt-v"></i></span>' . get_term_meta( $term_id, 'br_brand_order', true );
        }
        return $value;
    }
    
    // public function sort_brands_by_order( $pieces, $taxonomies, $args ) {
    //     global $pagenow;
    //     if( !is_admin() || $pagenow != 'edit-tags.php' || empty( $taxonomies ) || $taxonomies[0] != self::$taxonomy_name ) {
    //         return $pieces;
    //     }
    //     // $pieces['orderby'] = 'ORDER BY tt.br_brand_order';
    //     // bd($pieces);
    //     return $pieces;
    // }

    public function pre_get_brands( $query ) {
        global $pagenow;
        if ( !is_admin() || $pagenow != 'edit-tags.php' || $query->query_vars['taxonomy'][0] != self::$taxonomy_name ) {
            return $query;
        }

        if ( !empty( $_GET['orderby'] ) && $_GET['orderby'] == 'Order' ) {
            $query->query_vars['orderby'] = 'order_clause';
            $query->query_vars['order'] = isset($_GET['order']) ? $_GET['order'] : "asc";
            // the OR relation and the NOT EXISTS clause allow for terms without a meta_value at all
            $args = array(
                'order_clause' => array(
                    'key' => 'br_brand_order',
                    'type' => 'NUMERIC'
                )
            );
            $query->meta_query = new WP_Meta_Query( $args );
        }
        return $query;
    }

    public function woocommerce_screen_ids($screens) {
        $screens[] = 'edit-berocket_brand';
        return $screens;
    }
    public function register_permalink_option() {
        $screen = get_current_screen();
        $default_values = '';
        if($screen->id == 'options-permalink') {
            $this->save_permalink_option();
            $this->_register_permalink_option();
        }
    }
    public function _register_permalink_option() {
        add_settings_section(
            'berocket_permalinks_brand',
            $this->info['norm_name'],
            array($this, 'permalink_input_section'),
            'permalink'
        );
    }
    function permalink_input_section() {
        set_query_var( 'norm_name', $this->info['norm_name'] );
        $this->br_get_template_part( 'permalink_option' );
    }

    public function save_permalink_option() {
        if ( isset( $_POST['berocket_brands_permalink'] ) ) {
            $option_values = $_POST['berocket_brands_permalink'];
            update_option( 'berocket_brands_permalink', $option_values );
        }
    }

    private function get_fields ( $term_id = false ) {
        global $pagenow;

        $fields = ( $pagenow == 'edit-tags.php' ) ? '' : '<table class="form-table" role="presentation">';
        foreach ( $this->attributes as $name => $attribute ) {
            $value = $term_id ? get_term_meta( $term_id, $name, true ) : 
                ( isset( $attribute['default'] ) ? $attribute['default'] : '' );
            $type = $attribute['type'];

            $fields .= ( $pagenow == 'edit-tags.php' ) ?
                    "<div class='form-field term-$name-wrap'>
                        <label class='br_brand_$type' for='$name'>{$attribute['label']}</label>"
                    : "<tr class='form-field term-$name-wrap'>
                        <th scope='row'><label class='br_brand_$type' for='$name'>{$attribute['label']}</label></th>
                        <td>";

            switch ( $type ) {
                case 'image':
                    $select_upload = $value ? 
                        berocket_font_select_upload( '', 'br_brand_options_ajax_load_icon', $attribute['image_name'], @ $value, false) 
                        : berocket_font_select_upload( '', 'br_brand_options_ajax_load_icon', $attribute['image_name'], '', false);
                    $fields .=  
                        "<div id='$name' class='br_brands_image'>$select_upload</div>";
                    break;
                 
                case 'color':
                    $fields .=  
                        "<input type='text' id='$name' name='$name' value='$value' class='br_brand_colorpicker' />";
                    break;
                 
                case 'checkbox':
                    $is_checked = empty( $value ) ? '' : 'checked="checked"';
                    $fields .=  
                        "<input type='checkbox' id='$name' name='$name' value='1' $is_checked />";
                    break;
                 
                case 'category_checklist':
                    $cat_ids = empty($value) ? array() : array_map( function($v) { $term = get_term_by( 'name', $v, 'product_cat' ); return $term->term_id; }, $value );
                    $fields .=  '<ul class="br_brand_product_categories">' 
                        . wp_terms_checklist( 0, array( 
                            'taxonomy' => 'product_cat', 
                            'walker' => new Br_Walker_Category_Checklist,
                            'echo' => false, 
                            'selected_cats' => $cat_ids ) )
                        . '</ul>';
                    break;

                default:
                    $args = empty( $attribute['attributes'] ) ? '' 
                        : implode( ' ', array_map( function( $key, $value ) { return "$key='$value'";}, 
                            array_keys( $attribute['attributes'] ), $attribute['attributes'] ) );
                    $fields .= "<input name='$name' id='$name' type='{$attribute['type']}' value='$value' $args />";
                    break;
             }
            if ( !empty( $attribute['description'] ) ) {
                $fields .= "<p>{$attribute['description']}</p>";
            }
            $fields .= ( $pagenow == 'edit-tags.php' ) ? '</div>' : '</td></tr>' ; 
        }
        if ( $pagenow == 'edit-tags.php' ) $fields .= '</table>';
        return $fields;
    }

    public function add_field () {
        echo $this->get_fields();
    }

    public function edit_field ( $term, $taxonomy ) {
        echo $this->get_fields( $term->term_id );
    }

    public function field_save( $term_id, $tt_id, $taxonomy ) {
        if ( $taxonomy != self::$taxonomy_name ) return;

        foreach ( $this->attributes as $name => $attribute ) {
            switch ( $attribute['type'] ) {
                case 'image':
                    $image_name = $attribute['image_name'];
                    if ( isset( $_POST[$image_name] ) ) {
                        update_term_meta( $term_id, $name, $_POST[$image_name] );
                    }
                    break;
             
                case 'checkbox':
                    if ( !empty( $_POST[$name] ) ) {
                        update_term_meta( $term_id, $name, $_POST[$name] );
                    } else {
                        update_term_meta( $term_id, $name, false );
                    }
                    break;

                case 'category_checklist':
                    if ( !empty( $_POST['br_brand_category'] ) && !empty( $_POST['br_brand_category']['product_cat'] ) ) {
                        update_term_meta( $term_id, $name, $_POST['br_brand_category']['product_cat'] );
                    }
                    break;

                default:
                    if ( isset( $_POST[$name] ) ) {
                        update_term_meta( $term_id, $name, $_POST[$name] );
                    }
                    break;
            }
        }

        if ( empty( get_term_meta( $term_id, 'br_brand_order' ) ) ) {
            add_term_meta( $term_id, 'br_brand_order', 0 );
        }
    }

    public function clear_cache_on_edit_brand( $term_id, $tt_id, $taxonomy ) {
        if ( $taxonomy != self::$taxonomy_name ) return;
        $this->clear_cache();
    }

    public function clear_cache_on_edit_post( $post_ID, $post ) {
        if ( get_post_type( $post_ID ) == 'product' ) {
            $this->clear_cache();
            return;
        }
        $this->clear_cache( "{$this->cache_key}_$post_ID" );
    }

    public function description() {
        if( ! is_tax( self::$taxonomy_name ) ) {
            return;
        }
		if ( ! get_query_var( self::$taxonomy_name ) && ! get_query_var( 'term' ) ) {
			return;
        }
        $term_find = get_query_var( self::$taxonomy_name );
        $term_find = empty( $term_find ) ? get_query_var( 'term' ) : $term_find;
        $term = get_term_by( 'slug', $term_find, self::$taxonomy_name );
        if( empty( $term ) ) {
            return;
        }
        $options = $this->get_option();
        if ( empty( $options['link_text'] ) ) $options['link_text'] = $this->defaults['link_text'];
        
        set_query_var( 'options', $options );
        set_query_var( 'brand_term', $term );
        set_query_var( 'brand_banner', get_term_meta( $term->term_id, 'brand_banner_url', true ) );
        set_query_var( 'brand_thumbnail', get_term_meta( $term->term_id, 'brand_image_url', true ) );
        set_query_var( 'brand_url', get_term_meta( $term->term_id, 'br_brand_url', true ) );
        set_query_var( 'tooltip', BeRocket_product_brand::get_tooltip( $term->term_id ) );

        $this->br_get_template_part( 'description' );
        remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
        remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
    }
    public function description_post($atts = array()) {
        $atts = shortcode_atts( array(
			'post_id'   => '',
			'width'     => '35%',
			'height'    => '',
			'position'  => 'right',
            'image'     => '1',
			'url'       => '',
		), $atts );
        if( empty($atts['post_id']) ) {
            $atts['post_id'] = get_the_ID();
            if( empty($atts['post_id']) ) {
                return;
            }
        }
        $terms = get_the_terms( $atts['post_id'], self::$taxonomy_name );
        if( empty($terms) ) {
            return;
        }
        if( ! empty($terms) && is_array($terms) ) {
            foreach($terms as $term) {
                $image 	= get_term_meta( $term->term_id, 'brand_image_url', true );
                if( ! empty($atts['url']) ) {
                    echo '<a href="'.get_term_link( (int)$term->term_id ).'">';
                }
                if( ! empty($image) && ! empty($atts['image']) ) {
                    echo '<img class="berocket_brand_post_image" src="', $image, '" alt="', $term->name, '" style="',
                    (empty($atts['width']) ? '' : 'width:'.$atts['width'].';'),
                    (empty($atts['height']) ? '' : 'height:'.$atts['height'].';'),
                    (empty($atts['position']) ? '' : 'float:'.$atts['position'].';'),
                    '">';
                } else {
                    echo '<span class="berocket_brand_post_image_name" style="display: block;', 
                    (empty($atts['width']) ? '' : 'width:'.$atts['width'].';'),
                    (empty($atts['height']) ? '' : 'height:'.$atts['height'].';'),
                    (empty($atts['position']) ? '' : 'float:'.$atts['position'].';'),
                    '">', @ $term->name, '</span>';
                }
                if( ! empty($atts['url']) ) {
                    echo '</a>';
                }
            }
        }
    }
	public function product_filter( $filters ) {
		global $wp_query;

		$current_product_brand = (! empty( $wp_query->query[self::$taxonomy_name] ) ? $wp_query->query[self::$taxonomy_name] : '');
		$terms = get_terms( self::$taxonomy_name );

		if ( empty($terms) ) {
			return $filters;
		}
		$args                  = array(
			'pad_counts'         => 1,
			'count'              => 1,
			'hierarchical'       => 1,
			'hide_empty'         => 1,
			'show_uncategorized' => 1,
			'orderby'            => 'name',
			'selected'           => $current_product_brand,
			'menu_order'         => false
		);

		$filters = $filters . PHP_EOL;
        $taxonomy_name = self::$taxonomy_name;
		$filters .= "<select name='$taxonomy_name' class='dropdown_berocket_brand'>";
		$filters .= '<option value="" ' .  selected( $current_product_brand, '', false ) . '>' . __( 'Select a brand', 'brands-for-woocommerce' ) . '</option>';
		$filters .= wc_walk_category_dropdown_tree( $terms, 0, $args );
		$filters .= "</select>";

		return $filters;
	}
	public function coupon_field () {
		global $post;
        $categories = get_terms( self::$taxonomy_name, 'orderby=name&hide_empty=0' );
		?>
        <div class="options_group">
		<p class="form-field">
            <label for="berocket_brand"><?php _e( 'Product brands', 'brands-for-woocommerce' ); ?></label>
            <select id="berocked_brand" name="berocket_brand[]" style="width: 50%;"  class="wc-enhanced-select" multiple="multiple" data-placeholder="<?php _e( 'Any brand', 'brands-for-woocommerce' ); ?>">
                <?php
                    $category_ids = (array) get_post_meta( $post->ID, self::$taxonomy_name, true );
                    if ( $categories && is_array($categories) ) foreach ( $categories as $cat ) {
                        echo '<option value="' . esc_attr( $cat->term_id ) . '"' . selected( in_array( $cat->term_id, $category_ids ), true, false ) . '>' . esc_html( $cat->name ) . '</option>';
                    }
                ?>
            </select>
            <?php 
            if( function_exists('wc_help_tip') ) {
                echo wc_help_tip( __( 'Products with these brands will be discounted', 'brands-for-woocommerce' ) );
            } ?>
        </p>
		<p class="form-field">
            <label for="exclude_berocket_brand"><?php _e( 'Exclude brands', 'brands-for-woocommerce' ); ?></label>
            <select id="exclude_berocked_brand" name="exclude_berocket_brand[]" style="width: 50%;"  class="wc-enhanced-select" multiple="multiple" data-placeholder="<?php _e( 'No brands', 'brands-for-woocommerce' ); ?>">
                <?php
                    $category_ids = (array) get_post_meta( $post->ID, 'exclude_berocket_brand', true );

                    if ( $categories && is_array($categories) ) foreach ( $categories as $cat ) {
                        echo '<option value="' . esc_attr( $cat->term_id ) . '"' . selected( in_array( $cat->term_id, $category_ids ), true, false ) . '>' . esc_html( $cat->name ) . '</option>';
                    }
                ?>
            </select>
            <?php 
            if( function_exists('wc_help_tip') ) {
                echo wc_help_tip( __( 'Products with these brands will not be discounted', 'brands-for-woocommerce' ) );
            } ?>
        </p>
        </div>
		<?php
	}
    public function save_coupon($post_id) {
		$berocket_brand         = empty( $_POST[self::$taxonomy_name] ) ? array() : $_POST[self::$taxonomy_name];
		$exclude_berocket_brand = empty( $_POST['exclude_berocket_brand'] ) ? array() : $_POST['exclude_berocket_brand'];

		// Save
		update_post_meta( $post_id, self::$taxonomy_name, $berocket_brand );
		update_post_meta( $post_id, 'exclude_berocket_brand', $exclude_berocket_brand );
    }
    public function admin_menu() {
        if( parent::admin_menu() ) {
            add_submenu_page(
                'woocommerce',
                __( $this->info[ 'norm_name' ] . ' settings', $this->info[ 'domain' ] ),
                __( $this->info[ 'norm_name' ], $this->info[ 'domain' ] ),
                'manage_options',
                $this->values[ 'option_page' ],
                array(
                    $this,
                    'option_form'
                )
            );
        }
    }

    public function admin_settings( $tabs_info = array(), $data = array() ) {
        $align_options = array(
            array("value" => "none",  "text" => __( 'none', 'brands-for-woocommerce' )),
            array("value" => "left",  "text" => __( 'Left', 'brands-for-woocommerce' )),
            array("value" => "right", "text" => __( 'Right', 'brands-for-woocommerce' )),
        );

        parent::admin_settings(
            array(
                'General' => array(
                    'icon' => 'cog',
                ),
                'Brand Page' => array(
                    'icon' => 'sitemap',
                ),
                'Slider' => array(
                    'icon' => 'arrows-h',
                ),
                'CSS'     => array(
                    'icon' => 'css3',
                ),
                'Addons' => array(
                    'icon'  => 'cog'
                ),
                'License' => array(
                    'icon' => 'unlock-alt',
                    'link' => admin_url( 'admin.php?page=berocket_account' )
                ),
            ),
            array(
            'General' => array(
                'cache' => array(
                    "label" => __('Use cache', 'brands-for-woocommerce'),
                    "tr_class" => "br_use_cache",
                    "items" => array(
                        'use_cache' => array(
                            "type"  => "checkbox",
                            // "label" => __('Use cache', 'brands-for-woocommerce'),
                            "class" => "br_brands_display_options",
                            "name"  => "use_cache",
                            "value" => $this->defaults['use_cache'],
                        ),
                        'clear_cache' => array(
                            "type"  => "ajax_button",
                            // "label_be_for" => __('Clear cache', 'brands-for-woocommerce'),
                            "label_for" => __('Clear cache after update shortcodes and widgets', 'brands-for-woocommerce'),
                            "name"  => "clear_cache",
                            'extra' => ' id="br_brands_clear_cache" data-process="' . __('Clearing...', 'brands-for-woocommerce') . '" data-done="' . __('Cleared', 'brands-for-woocommerce') . '"',
                            'class' => 'button action',
                            "value" => __( 'Clear', 'brands-for-woocommerce' ),
                        ),
                    ),
                ),
                'shortcodes_explanation' => array(
                    "section"  => "shortcodes_explanation",
                ),
            ),
            'Brand Page' => array(
                'display_description' => array(
                    "type"  => "checkbox",
                    "label" => __('Display description', 'brands-for-woocommerce'),
                    "name"  => "display_description",
                    "value" => $this->defaults['display_description'],
                ),
                'thumbnail' => brfr_image_options( array( 
                    'name' => 'thumbnail', 
                    'label' => __('Thumbnail', 'BeRocket_products_label_domain'), 
                    'defaults' => $this->defaults, 
                    'align_options' => $align_options ) 
                ),
                'banner' => brfr_image_options( array(
                    'name' => 'banner', 
                    'label' => __('Banner', 'BeRocket_products_label_domain'), 
                    'defaults' =>  $this->defaults, 
                    'align_options' => $align_options ) 
                ),
                'external_link' => array(
                    "label" => __('External link', 'brands-for-woocommerce'),
                    "tr_class" => "br_nowrap_label",
                    "items" => array(
                        'display_link' => array(
                            "type"         => "checkbox",
                            'label_be_for' => __('Display (if URL for the brand is set)', 'brands-for-woocommerce'),
                            "class"        => "br_brands_display_options",
                            "name"         => "display_link",
                            "value"        => $this->defaults['display_link'],
                        ),
                        'link_text' => array(
                            "type"         => "text",
                            'label_be_for' => __('Text', 'brands-for-woocommerce'),
                            "name"         => "link_text",
                            "value"        => $this->defaults['link_text'],
                        ),
                        'link_open_in_new_tab' => array(
                            "type"         => "checkbox",
                            'label_be_for' => __('Open in new tab', 'brands-for-woocommerce'),
                            "name"         => "link_open_in_new_tab",
                            "value"        => $this->defaults['link_open_in_new_tab'],
                        ),
                    ),
                ),
            ),
            'Slider' => array(
                'slider_autoplay' => array(
                    "type"  => "checkbox",
                    "label" => __('Autoplay', 'brands-for-woocommerce'),
                    "name"  => "slider_autoplay",
                    "extra" => " id='br_slider_autoplay'",
                    "class" => "br_has_dependent_options",
                    "value" => $this->defaults['slider_autoplay'],
                ),
                'slider_autoplay_speed' => array(
                    "type"  => "number",
                    "label" => __('Autoplay Speed', 'brands-for-woocommerce'),
                    "label_for" => __('ms', 'brands-for-woocommerce'),
                    "name"  => "slider_autoplay_speed",
                    "class" => "br_slider_autoplay_dependent",
                    "value" => $this->defaults['slider_autoplay_speed'],
                ),
                'slider_change_speed' => array(
                    "type"  => "number",
                    "label" => __('Slide change speed', 'brands-for-woocommerce'),
                    "label_for" => __('ms', 'brands-for-woocommerce'),
                    "name"  => "slider_change_speed",
                    "value" => $this->defaults['slider_change_speed'],
                ),
                'slider_infinite' => array(
                    "type"  => "checkbox",
                    "label" => __('Infinite', 'brands-for-woocommerce'),
                    "name"  => "slider_infinite",
                    "value" => $this->defaults['slider_infinite'],
                ),
                'slider_arrows' => array(
                    "type"  => "checkbox",
                    "label" => __('Show Arrows', 'brands-for-woocommerce'),
                    "name"  => "slider_arrows",
                    "value" => $this->defaults['slider_arrows'],
                ),
                'slider_slides_scroll' => array(
                    "type"  => "number",
                    "label" => __('Brands to Scroll', 'brands-for-woocommerce'),
                    "name"  => "slider_slides_scroll",
                    "value" => $this->defaults['slider_slides_scroll'],
                ),
                'slider_mode' => array(
                    "type"  => "toggleswitch",
                    "label" => __('Change slide mode', 'brands-for-woocommerce'),
                    "label_for" => __('Slide', 'brands-for-woocommerce'),
                    "label_be_for" => __('Fade', 'brands-for-woocommerce'),
                    "tr_class" => "br_nowrap_label",
                    "name"  => "slider_mode",
                    "value" => $this->defaults['slider_mode'],
                ),
                'slider_ease' => array(
                    "type"  => "selectbox",
                    "label" => __('Easing', 'brands-for-woocommerce'),
                    "name"  => "slider_ease",
                    "options"  => array(
                        array('value' => 'linear', 'text' => __( 'Linear', 'brands-for-woocommerce' ) ),
                        array('value' => 'ease', 'text' => __( 'Ease', 'brands-for-woocommerce' ) ),
                        array('value' => 'ease-in', 'text' => __( 'Ease in', 'brands-for-woocommerce' ) ),
                        array('value' => 'ease-out', 'text' => __( 'Ease out', 'brands-for-woocommerce' ) ),
                        array('value' => 'ease-in-out', 'text' => __( 'Ease in-out', 'brands-for-woocommerce' ) ),
                        array('value' => 'cubic-bezier(.22,.68,0,1.71)', 'text' => __( 'Cubic Bezier 1', 'brands-for-woocommerce' ) ),
                        array('value' => 'cubic-bezier(.57,.21,.69,1.25)', 'text' => __( 'Cubic Bezier 2', 'brands-for-woocommerce' ) ),
                        array('value' => 'cubic-bezier(0.600,-0.280,0.735,0.045)', 'text' => __( 'Cubic Bezier 3', 'brands-for-woocommerce' ) ),
                        array('value' => 'cubic-bezier(.99,.01,.99,.01)', 'text' => __( 'Cubic Bezier 4', 'brands-for-woocommerce' ) ),
                        array('value' => 'cubic-bezier(.99,.62,.56,.01)', 'text' => __( 'Cubic Bezier 5', 'brands-for-woocommerce' ) ),
                        array('value' => 'cubic-bezier(.59,1.75,.32,-0.61)', 'text' => __( 'Cubic Bezier 6', 'brands-for-woocommerce' ) ),
                    ),
                    "value" => $this->defaults['slider_ease'],
                ),
                'slider_stop_focus' => array(
                    "type"  => "checkbox",
                    "label" => __('Stop Autoscroll on Focus', 'brands-for-woocommerce'),
                    "name"  => "slider_stop_focus",
                    "value" => $this->defaults['slider_stop_focus'],
                ),
                'slider_dots' => array(
                    "type"  => "checkbox",
                    "label" => __('Show dots', 'brands-for-woocommerce'),
                    "name"  => "slider_dots",
                    "extra" => " id='br_slider_dots'",
                    "class" => "br_has_dependent_options",
                    "value" => 1,
                ),
                'slider_dots_color' => array(
                    "type"  => "color",
                    "label" => __('Dots color', 'brands-for-woocommerce'),
                    "name"  => "slider_dots_color",
                    "class" => "br_slider_dots_dependent",
                    "value" => $this->defaults['slider_dots_color'],
                ),
            ),
            'CSS'     => array(
                'global_font_awesome_disable' => array(
                    "label"     => __( 'Disable Font Awesome', "brands-for-woocommerce" ),
                    "type"      => "checkbox",
                    "name"      => "fontawesome_frontend_disable",
                    "value"     => $this->defaults['global_font_awesome_disable'],
                    'label_for' => __('Don\'t loading css file for Font Awesome on site front end. Use it only if you doesn\'t uses Font Awesome icons in widgets or you have Font Awesome in your theme.', 'brands-for-woocommerce'),
                ),
                'global_fontawesome_version' => array(
                    "label"    => __( 'Font Awesome Version', "brands-for-woocommerce" ),
                    "name"     => "fontawesome_frontend_version",
                    "type"     => "selectbox",
                    "options"  => array(
                        array('value' => '', 'text' => __('Font Awesome 4', 'brands-for-woocommerce')),
                        array('value' => 'fontawesome5', 'text' => __('Font Awesome 5', 'brands-for-woocommerce')),
                    ),
                    "value"    => $this->defaults['global_fontawesome_version'],
                    "label_for" => __('Version of Font Awesome that will be used on front end. Please select version that you have in your theme', 'brands-for-woocommerce'),
                ),
                array(
                    "type"  => "textarea",
                    "label" => __('Custom CSS', 'brands-for-woocommerce'),
                    "name"  => "custom_css",
                ),
            ),
            'Addons'     => array(
                array(
                    "label"   => '',
                    'section' => 'addons'
                ),
            ),
        ) );
    }
    public function section_shortcodes_explanation() {
        $html = '<th scope="row" style="vertical-align: top;">' . __('Shortcodes: click to expand', 'brands-for-woocommerce') . '</th>
            <td>
                <ul class="br_shortcode_info">
                    <li>
                        <span class="br_shortcode_title">
                            <strong><i class="fas fa-caret-right"></i>&nbsp;[brands_list]</strong> - '.__("list of brands", 'brands-for-woocommerce').'
                        </span>
                        <ul class="br_shortcode_attributes">
                            <li><i>title</i> - '.__("title of the brand list", 'brands-for-woocommerce').'</li>
                            <li><i>use_name</i> - '.__("display brand name (1 or 0)", 'brands-for-woocommerce').'</li>
                            <li><i>per_row</i> - '.__("number of columns for brands list (number of brands per slider)", 'brands-for-woocommerce').'</li>
                            <li><i>hide_empty</i> - '.__("hide brands without products (1 or 0)", 'brands-for-woocommerce').'</li>
                            <li><i>count</i> - '.__("maximum number of brands", 'brands-for-woocommerce').'</li>
                            <li><i>padding</i> - '.__("padding around image and name in pixels (default is 3)", 'brands-for-woocommerce').'</li>
                            <li><i>border_color</i> - '.__("border color in HEX (#FFFFFF - white, #000000 - black)", 'brands-for-woocommerce').'</li>
                            <li><i>border_width</i> - '.__("border width in pixels", 'brands-for-woocommerce').'</li>
                            <li><i>slider</i> - '.__("output mode: slider (1) or list (0)", 'brands-for-woocommerce').'</li>
                            <li><i>orderby</i> - '.__("sort brands by:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>name</i> - '.__("brand name (default)", 'brands-for-woocommerce').'</li>
                                    <li><i>count</i> - '.__("number of products", 'brands-for-woocommerce').'</li>
                                    <li><i>order</i> - '.__("brand order", 'brands-for-woocommerce').'</li>
                                    <li><i>random</i> - '.__("random order", 'brands-for-woocommerce').'</li>
                                    <li><i>slug</i> - '.__("brand slug", 'brands-for-woocommerce').'</li>
                                    <li><i>description</i> - '.__("brand description", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>order</i> - '.__("sorting order:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>asc</i> - '.__("ascending (default)", 'brands-for-woocommerce').'</li>
                                    <li><i>desc</i> - '.__("descending", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>img</i> - '.__("display brand image (1 or 0)", 'brands-for-woocommerce').'</li>
                            <li><i>imgh</i> - '.__("brand image height in px or % (i.e. 50%, 100px; default is 64px)", 'brands-for-woocommerce').'</li>
                            <li><i>imgw</i> - '.__("brand image width in px or % (i.e. 50%, 100px; default is 100%)", 'brands-for-woocommerce').'</li>
                            <li><i>img_fit</i> - '.__("brand image fit:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>cover</i> - '.__("default", 'brands-for-woocommerce').'</li>
                                    <li><i>contain</i></li>
                                    <li><i>fill</i></li>
                                </ul>
                            </li>
                            <li><i>img_align</i> - '.__("brand image align to name:", 'brands-for-woocommerce') . '
                                <ul>
                                    <li><i>left</i> - '.__("image left to name", 'brands-for-woocommerce').'</li>
                                    <li><i>right</i> - '.__("image right to name", 'brands-for-woocommerce').'</li>
                                    <li><i>under</i> - '.__("image under name", 'brands-for-woocommerce').'</li>
                                    <li><i>above</i> - '.__("image above name (default)", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>featured_first</i> - '.__("show featured brands first (0 or 1)", 'brands-for-woocommerce').'</li>
                            <li><i>include</i> - '.__("brands to display (id list, i.e. include='45,47,52,61')", 'brands-for-woocommerce').'</li>
                            <li><i>exclude</i> - '.__("brands to exclude from display (i.e. exclude='45,47,52,61')", 'brands-for-woocommerce').'</li>
                        </ul>
                    </li>
                    <li>
                        <span class="br_shortcode_title">
                            <strong><i class="fas fa-caret-right"></i>&nbsp;[brands_catalog]</strong> - '.__("brands grouped by name or category", 'brands-for-woocommerce').'
                        </span>
                        <ul class="br_shortcode_attributes">
                            <li><i>title</i> - '.__("title of the brand catalog", 'brands-for-woocommerce').'</li>
                            <li><i>use_name</i> - '.__("display brand name", 'brands-for-woocommerce').'</li>
                            <li><i>style</i> - '.__("placement of brands:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>vertical</i> - '.__("vertically (default)", 'brands-for-woocommerce').'</li>
                                    <li><i>horizontal</i> - '.__("horizontally", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>column</i> - '.__("number of columns", 'brands-for-woocommerce').'</li>
                            <li><i>hide_empty</i> - '.__("hide brands without products (1 or 0)", 'brands-for-woocommerce').'</li>
                            <li><i>count</i> - '.__("maximum number of brands", 'brands-for-woocommerce').'</li>
                            <li><i>groupby</i> - '.__("group brands by:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>alphabet</i> - '.__("brand name (default)", 'brands-for-woocommerce').'</li>
                                    <li><i>category</i> - '.__("brand category", 'brands-for-woocommerce').'</li>
                                    <li><i>none</i> - '.__("no group", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>orderby</i> - '.__("sort brands by:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>name</i> - '.__("brand name (default)", 'brands-for-woocommerce').'</li>
                                    <li><i>count</i> - '.__("number of products", 'brands-for-woocommerce').'</li>
                                    <li><i>order</i> - '.__("brand order", 'brands-for-woocommerce').'</li>
                                    <li><i>random</i> - '.__("random order", 'brands-for-woocommerce').'</li>
                                    <li><i>slug</i> - '.__("brand slug", 'brands-for-woocommerce').'</li>
                                    <li><i>description</i> - '.__("brand description", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>order</i> - '.__("sorting order:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>asc</i> - '.__("ascending (default)", 'brands-for-woocommerce').'</li>
                                    <li><i>desc</i> - '.__("descending", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>img</i> - '.__("display brand image", 'brands-for-woocommerce').'</li>
                            <li><i>imgh</i> - '.__("brand image height, in px or % (i.e. 50%, 100px; default is 64px)", 'brands-for-woocommerce').'</li>
                            <li><i>imgw</i> - '.__("brand image width, in px or % (i.e. 50%, 100px; default is 100%)", 'brands-for-woocommerce').'</li>
                            <li><i>img_fit</i> - '.__("brand image fit:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>cover</i> - '.__("default", 'brands-for-woocommerce').'</li>
                                    <li><i>contain</i></li>
                                    <li><i>fill</i></li>
                                </ul>
                            </li>
                            <li><i>img_align</i> - '.__("brand image align to name:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>left</i> - '.__("image left to name", 'brands-for-woocommerce').'</li>
                                    <li><i>right</i> - '.__("image right to name", 'brands-for-woocommerce').'</li>
                                    <li><i>under</i> - '.__("image under name", 'brands-for-woocommerce').'</li>
                                    <li><i>above</i> - '.__("image above name (default)", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>featured_first</i> - '.__("show featured brands first (0 or 1)", 'brands-for-woocommerce').'</li>
                            <li><i>include</i> - '.__("brands to display (id list, i.e. include='45,47,52,61')", 'brands-for-woocommerce').'</li>
                            <li><i>exclude</i> - '.__("brands to exclude from display (i.e. exclude='45,47,52,61')", 'brands-for-woocommerce').'</li>
                        </ul>
                    </li>
                    <li>
                        <span class="br_shortcode_title">
                            <strong><i class="fas fa-caret-right"></i>&nbsp;[brands_products]</strong> - '.__("product list for given brands (by ids or slugs)", 'brands-for-woocommerce').'
                        </span>
                        <ul class="br_shortcode_attributes">
                            <li><i>brand_id</i> - '.__("one or more brand ID (example: brand_id='12,34,35')", 'brands-for-woocommerce').'</li>
                            <li><i>brand_slug</i> - '.__("one or more brand slugs (example: brand_slug='brand1,brand2,brand3')", 'brands-for-woocommerce').'</li>
                            <li><b>'.__("Use only one of these options: brand_id or brand_slug", 'brands-for-woocommerce').'</b></li>
                            <li><i>columns</i> - '.__("number of columns for product list. May not work with some themes or plugins", 'brands-for-woocommerce').'</li>
                            <li><i>orderby</i> - '.__("order products by:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>title</i> - '.__("product title", 'brands-for-woocommerce').'</li>
                                    <li><i>name</i> - '.__("product name (post slug)", 'brands-for-woocommerce').'</li>
                                    <li><i>date</i> - '.__("date of creation", 'brands-for-woocommerce').'</li>
                                    <li><i>modified</i> - '.__("last modified date", 'brands-for-woocommerce').'</li>
                                    <li><i>rand</i> - '.__("random order", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>order</i> - '.__("sorting order:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>asc</i> - '.__("ascending (default)", 'brands-for-woocommerce').'</li>
                                    <li><i>desc</i> - '.__("descending", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="br_shortcode_title">
                            <strong><i class="fas fa-caret-right"></i>&nbsp;[brands_info]</strong> - '.__("information about brand", 'brands-for-woocommerce').'
                        </span>
                        <ul class="br_shortcode_attributes">
                            <li><i>id</i> - '.__("brand ID", 'brands-for-woocommerce').'</li>
                            <li><i>type</i> - '.__("type of information:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>name</i> - '.__("brand name", 'brands-for-woocommerce').'</li>
                                    <li><i>image</i> - '.__("brand thumbnail", 'brands-for-woocommerce').'</li>
                                    <li><i>description</i> - '.__("brand description", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span class="br_shortcode_title">
                            <strong><i class="fas fa-caret-right"></i>&nbsp;[brands_product_thumbnail]</strong> - '.__("brand image for product page", 'brands-for-woocommerce').'
                        </span>
                        <ul class="br_shortcode_attributes">
                            <li><i>post_id</i> - '.__("product id", 'brands-for-woocommerce').'</li>
                            <li><i>width</i> - '.__("image width (default is 35%)", 'brands-for-woocommerce').'</li>
                            <li><i>height</i> - '.__("image height (optionally)", 'brands-for-woocommerce').'</li>
                            <li><i>position</i> - '.__("float style for element (default is right)", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>right</i> - '.__("right to text (default)", 'brands-for-woocommerce').'</li>
                                    <li><i>left</i> - '.__("left to text", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                            <li><i>image</i> - '.__("display brand image, if available (1 or 0, default is 1)", 'brands-for-woocommerce').'</li>
                            <li><i>url</i> - '.__("display image as link (1 or 0, default is 0)", 'brands-for-woocommerce').'</li>
                        </ul>
                    </li>
                    <li>
                        <span class="br_shortcode_title">
                            <strong><i class="fas fa-caret-right"></i>&nbsp;[product_brands_info]</strong> - '.__("single brand info for single product", 'brands-for-woocommerce').'
                        </span>
                        <ul class="br_shortcode_attributes">
                            <li><i>product_id</i> - '.__("product ID; on single product page can get it automatically", 'brands-for-woocommerce').'</li>
                            <li><i>type</i> - '.__("what to display:", 'brands-for-woocommerce').'
                                <ul>
                                    <li><i>name</i> - '.__("brand name", 'brands-for-woocommerce').'</li>
                                    <li><i>image</i> - '.__("brand thumbnail", 'brands-for-woocommerce').'</li>
                                    <li><i>description</i> - '.__("brand description", 'brands-for-woocommerce').'</li>
                                </ul>
                            </li>
                        </ul>
                </ul>
            </td>';
        return $html;
    }
    public function filter_type_array($filter_type_array) {
        $filter_type_array[self::$taxonomy_name] = array(
            'name' => __('Brands', 'brands-for-woocommerce'),
            'sameas' => 'custom_taxonomy',
            'attribute' => self::$taxonomy_name,
        );
        return $filter_type_array;
    }
    public function menu_order_sub_order($new_sub_order) {
        $new_sub_order[ 'br-product_brand' ][] = array(
            "<span class='berocket_admin_menu_custom_post_submenu'>" . __( 'All Brands', 'brands-for-woocommerce' ) . "</span>",
            'edit_posts',
            'edit-tags.php?taxonomy=berocket_brand&post_type=product&menu=berocket_account',
            'Brands',
        );
        return $new_sub_order;
    }
    function select_menu($file) {
        global $plugin_page, $submenu_file;
        if( $submenu_file == htmlentities('edit-tags.php?taxonomy=berocket_brand&post_type=product') ) {
            $plugin_page = 'berocket_account';
        }
        return $file;
    }
    function select_submenu($submenu_file) {
        if( $submenu_file == htmlentities('edit-tags.php?taxonomy=berocket_brand&post_type=product') ) {
            return 'edit-tags.php?taxonomy=berocket_brand&post_type=product&menu=berocket_account';
        }
        return $submenu_file;
    }
    function activation() {
        parent::activation();
        $this->register_taxonomy();
        flush_rewrite_rules();
    }

    function options_to_update( $options ) {
        $options = array(
            '3.6' => array(
                'update_options' => array(
                    'thumbnail_display' => 'display_thumbnail',
                ),
                'width_options' => array(
                    'thumbnail_width' => 'thumbnail_width',
                ),
            ),
        );
        return $options;
    }

    function update_version($previous, $current) {
        $options = $this->get_option();
        $update_options = apply_filters( 'br_brands_options_to_update', array() );
        if ( version_compare( $previous, '3.6', '<' ) ) {
            $update_options_3_6 = $update_options['3.6'];

            foreach ( $update_options_3_6['update_options'] as $new_key => $old_key ) {
                $options[$new_key] = empty( $options[$old_key] ) ? '' : $options[$old_key];
            }

            foreach ( $update_options_3_6['width_options'] as $new_key => $old_key ) {
                if ( empty( $options[$old_key] ) ) continue;
                $new_width = intval( $options[$old_key] );
                $units = str_replace( $new_width, '', $options[$old_key] );
                $options[$new_key] = $new_width;
                $options["{$new_key}_units"] = $units;
            }
        }
        update_option( $this->values['settings_name'], $options );
        wp_cache_delete( $this->values['settings_name'], 'berocket_framework_option' );
    }

    function wc_shortcode_atts($out, $pairs, $atts) {
        if( ! empty($atts['brand']) ) {
            $out['brand'] = $atts['brand'];
        }
        return $out;
    }
    function wc_shortcode_query($query_args, $atts = array()) {
        if ( ! empty( $atts['brand'] ) ) {
			$taxonomy = self::$taxonomy_name;
			$terms    = array_map( 'sanitize_title', explode( ',', $atts['brand'] ) );
			$field    = 'slug';

			if ( $terms && is_numeric( $terms[0] ) ) {
				$field = 'term_id';
				$terms = array_map( 'absint', $terms );
				// Check numeric slugs.
				foreach ( $terms as $term ) {
					$the_term = get_term_by( 'slug', $term, $taxonomy );
					if ( false !== $the_term ) {
						$terms[] = $the_term->term_id;
					}
				}
			}

			if( ! empty($terms) ) {
                $query_args['tax_query'][] = array(
                    'taxonomy' => $taxonomy,
                    'terms'    => $terms,
                    'field'    => $field,
                    'operator' => $atts['terms_operator'],
                );
            }
		}
        return $query_args;
    }

    public static function get_tooltip( $term_id ) {
        $tooltip = get_term_meta ( $term_id, 'br_brand_tooltip', true );
        return self::get_tooltip_data( $tooltip );
    }

    public static function get_tooltip_data( $tooltip ) {
        return empty( $tooltip ) ? array( 'class' => '', 'data' => '' ) 
            : array( 'class' => 'br_brand_tippy', 'data' => "data-tippy='$tooltip'" );
    }

    public function get_cache_key() {
        global $berocket_unique_value;
        $berocket_unique_value++;
        $post_id = get_the_ID();
        return "{$this->cache_key}_{$post_id}_{$berocket_unique_value}";
    }

    public function get_from_cache( $key ) {
        $options = $this->get_option();
        if ( empty( $options['use_cache'] ) ) return array();
        return get_transient( $key );
    }

    public function set_to_cache( $key, $terms ) {
        set_transient( $key, $terms, $this->cache_time );
        $cache_list = get_transient( $this->cache_list );
        if ( is_array( $cache_list ) ) {
            $cache_list[] = $key;
        } else {
            $cache_list = array( $key );
        }
        set_transient( $this->cache_list, $cache_list, $this->cache_time );
    }

    public function save_order() {
        $term_id = intval( sanitize_text_field( $_REQUEST['term_id'] ) );
        $order   = intval( sanitize_text_field( $_REQUEST['order'] ) );

        update_term_meta( $term_id, 'br_brand_order', $order );
        $this->clear_cache();
        wp_die();
    }

    public function save_all_orders() {
        foreach ( $_REQUEST['term_ids'] as $order => $term_id ) {
            $term_id = intval( str_replace( 'tag-', '', $term_id ) );
            update_term_meta( $term_id, 'br_brand_order', $order );
        }
        $this->clear_cache();
        wp_die();
    }

    public function clear_cache( $needle = '' ) {
        $cache_list = get_transient( $this->cache_list );
        if ( empty( $cache_list ) || !is_array( $cache_list ) ) return;

        foreach ( $cache_list as $cache_key ) {
            if ( empty( $needle ) || strpos( $cache_key, $needle ) !== false ) {
                delete_transient( $cache_key );
            }
        }
    }

    public function clear_cache_ajax() {
        $this->clear_cache();
        wp_die();
    }

    public function woocommerce_duplicate_product( $new_id, $post ) {
        $brands = get_the_terms($post->ID, self::$taxonomy_name );
        if ( empty($brands) ) return;
        $brands_id = wp_list_pluck( $brands, 'term_id' );
        wp_set_post_terms( $new_id, $brands_id, self::$taxonomy_name );
    }

    public function brand_product_export_column_names( $columns ) {
        $columns[ self::$taxonomy_name ] = __( 'Brands', 'brands-for-woocommerce' );
        return $columns;
    }

    public function brand_export_product_column_brand_taxonomy( $value, $product ) {
        $terms = get_terms( array( 'object_ids' => $product->get_ID(), 'taxonomy' => self::$taxonomy_name ) );
        if ( is_wp_error( $terms ) ) return $value;

        return implode( ', ', wp_list_pluck( $terms, 'name' ) );
    }

    public function brand_product_import_mapping_default_columns( $columns ) {
        $columns[ __( 'Brands', 'brands-for-woocommerce' ) ] = self::$taxonomy_name;
        $columns[ 'Brands' ] = self::$taxonomy_name; // Always add English mappings.
        return $columns;
    }

    public function brand_product_importer_parsed_data( $parsed_data, $importer ) {
        if ( empty( $parsed_data[ self::$taxonomy_name ] ) ) return $parsed_data;

        $parsed_data[ self::$taxonomy_name ] = explode( ', ', $parsed_data[ self::$taxonomy_name ] );
        return $parsed_data;
    }

    public function brand_product_import_inserted_product_object( $product, $data ) {
        if ( !is_a( $product, 'WC_Product' ) || empty( $data[ self::$taxonomy_name ] ) ) return $product;

        $object_terms = wp_set_object_terms( $product->get_id(), (array) $data[ self::$taxonomy_name ], self::$taxonomy_name );
        return $product;
    }
}

new BeRocket_product_brand;

