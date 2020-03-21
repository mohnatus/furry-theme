<?php

add_action( 'after_setup_theme', 'furry_register_menus' );
function furry_register_menus() {
	register_nav_menus( [
    'social' => 'Social menu',
    'top' => 'Top menu'
  ] );
}

add_action( 'wp_enqueue_scripts', 'furry_scripts' );
function furry_scripts(){
	wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/script.js');
}

add_theme_support( 'post-thumbnails' );
add_image_size( 'preview', 400, 200, true );
