<?php

/** Theme menus */
add_action('after_setup_theme', 'furry_register_menus');
function furry_register_menus() {
	register_nav_menus([
    'social' => 'Social menu',
    'main' => 'Main menu'
  ]);
}

/** Sidebars */
add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	register_sidebar( array(
		'name'          => 'Main sidebar',
		'id'            => "main-sidebar",
		'description'   => '',
		'class'         => 'main-sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	) );
}

/** Scripts */
add_action('wp_enqueue_scripts', 'furry_scripts');
add_filter('script_loader_tag', 'furry_async_scripts', 10, 2);
function furry_scripts() {
	wp_enqueue_script(
    'app',
    get_template_directory_uri() . '/assets/script.js',
    array(),
    filemtime(get_theme_file_path('assets/script.js')),
    'in_footer'
  );
}
function furry_async_scripts($tag, $handle) {
  if ($handle == 'app') {
    return str_replace(' src', ' async src', $tag);
  }
  return $tag;
}

/** No index */
add_action( 'wp_head', 'furry_noindex', 1);
function furry_noindex() {
  $meta = '<meta name="robots" content="noindex, nofollow" />' . "\n";
	if (is_search()) echo $meta;
}

require_once('php/comments.php');
require_once('php/templates.php');
require_once('php/utils.php');
