<?php

class furry_walker_social_menu extends Walker_Nav_Menu {
  function start_el( &$output, $item, $depth = 0, $args = NULL, $id =0 ) {
    global $wp_query;

    // build html
    $output .= '<li id="nav-menu-item-'. $item->ID . '">';

    // link attributes
    $attributes = ' target="_blank" rel="noopener noreferrer nofollow"';
    $attributes .= ! empty( $item->url ) ? "href='$item->url'" : '';

    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
      $args->before,
      $attributes,
      $args->link_before,
      apply_filters( 'the_title', $item->title, $item->ID ),
      $args->link_after,
      $args->after
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

function furry_nav_menu($location) {

  if ($location == 'social') {
    wp_nav_menu([
      'theme_location' => $location,
      'fallback_cb' => '',
      'walker' => new furry_walker_social_menu
    ]);
  } else {
    wp_nav_menu([
      'theme_location' => $location,
      'fallback_cb' => '',
    ]);
  }

}
