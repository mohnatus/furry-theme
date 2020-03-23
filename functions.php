<?php

/** Theme menus */
add_action('after_setup_theme', 'furry_register_menus');
function furry_register_menus() {
	register_nav_menus([
    'social' => 'Social menu',
    'main' => 'Main menu'
  ]);
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


require_once('php/templates.php');
