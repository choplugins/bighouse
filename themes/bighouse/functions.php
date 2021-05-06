<?php

require_once __DIR__.'/inc/HanzoTopMenuWalker.php';

function hanzo_enqueue_scripts(){
    wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/bootstrap/bootstrap.min.css','',false);
    wp_enqueue_style('flickity',get_template_directory_uri().'/assets/carousel/flickity.css','',false);
    wp_enqueue_style('style',get_template_directory_uri().'/assets/sass/style.css','',false);

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap',get_template_directory_uri().'/assets/bootstrap/bootstrap.min.js',[],false,true);
    wp_enqueue_script('flickity',get_template_directory_uri().'/assets/carousel/flickity.pkgd.min.js',[],false,true);
    wp_enqueue_script('main',get_template_directory_uri().'/assets/js/main.js',[],false,true);
}
add_action('wp_enqueue_scripts','hanzo_enqueue_scripts');

function hanzo_svg($name, $width = false)
{
    $dir  = 'assets/icon/';
    $path = $dir . $name . '.svg';

    if ($name && file_exists($path)) {
        $svg = file_get_contents($path);
        if ($width) {
            $size = '<svg';
            $new_size = '<svg width="' . $width . 'px"';
            $svg = str_replace($size, $new_size, $svg);
        }
        return $svg;
    }
    return '';
}

add_theme_support('custom-logo');
add_theme_support('title-tag');
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('customize-selective-refresh-widgets');

function hanzo_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Top Header', 'hanzo' ),
        'id'            => 'top-header',
        'description'   => __( 'Widgets nằm trên top header', 'hanzo' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Main Header', 'hanzo' ),
        'id'            => 'main-header',
        'description'   => __( 'Widgets nằm trên Main header', 'hanzo' ),
        'before_widget' => '<div id="%1$s" class="widget header-center__commit-item header-center__commit-item-%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'hanzo_widgets_init' );
