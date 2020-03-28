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
    get_template_directory_uri() . '/assets/js/app.js',
    array(),
    filemtime(get_theme_file_path('assets/js/app.js')),
    'in_footer'
  );

  if (is_singular()) {
    wp_enqueue_script(
      'entry',
      get_template_directory_uri() . '/assets/js/entry.js',
      array(),
      filemtime(get_theme_file_path('assets/js/entry.js')),
      'in_footer'
    );
  }

  if ( !is_admin() ) {
    wp_deregister_script('jquery');
  }
}
function furry_async_scripts($tag, $handle) {
  $async = ['app', 'entry', 'advert'];
  if (in_array($handle, $async)) {
    return str_replace(' src', ' async src', $tag);
  }
  return $tag;
}

/** Styles */
add_action('wp_enqueue_scripts', 'furry_styles');
add_filter('style_loader_tag', 'furry_async_styles', 10, 4 );

function furry_styles() {

  if (!is_user_logged_in() && !is_admin()) {
    wp_deregister_style('dashicons');
  }

  if (!is_admin()) {
    wp_dequeue_style('wp-block-library');
  }

  wp_enqueue_style(
    'app',
    get_stylesheet_uri(),
    array(),
    filemtime(get_theme_file_path('style.css'))
  );

  wp_enqueue_style(
    'main-font',
    'https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=cyrillic-ext',
    array(),
    ''
  );

  wp_enqueue_style(
    'header-font',
    'https://fonts.googleapis.com/css?family=Oswald:500&display=swap&subset=cyrillic',
    array(),
    ''
  );

  if (is_singular()) {
    wp_enqueue_style(
      'entry',
      get_template_directory_uri() . '/assets/css/entry.css',
      array(),
      filemtime(get_theme_file_path('assets/css/entry.css'))
    );
  }
}
function furry_async_styles( $html, $handle, $href, $media ) {
  if (is_admin()) return $html;
  return "<link rel='preload' as='style' href='$href'>
    <link rel='stylesheet'
    data-href='$href'
    media='all'
    data-async-style>";
}

/** No index */
add_action( 'wp_head', 'furry_noindex', 1);
function furry_noindex() {
  $meta = '<meta name="robots" content="noindex, nofollow" />' . "\n";
	if (is_search()) echo $meta;
}

/** Emojis */
add_action( 'init', 'disable_emojis' );
function disable_emojis() {
  if (!is_admin()) {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
  }
}
function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  }
  return array();
}
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    $emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
    foreach ( $urls as $key => $url ) {
      if ( strpos( $url, $emoji_svg_url_bit ) !== false ) {
        unset( $urls[$key] );
      }
    }
  }
  return $urls;
}

remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head','start_post_rel_link',10,0);
remove_action('wp_head','index_rel_link');
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );


require_once('php/utils.php');
require_once('php/comments.php');
require_once('php/templates.php');
require_once('php/meta.php');
require_once('php/admin.php');
