<?php

/** Thumbnails */
add_theme_support('post-thumbnails');
add_image_size('preview-1x', 400, 200, false);
add_image_size('preview-2x', 800, 400, false);
add_image_size('preview-3x', 1200, 600, false);
function furry_preview_img($post) {
  $postID = $post->ID;
  $postExcerpt = $post->excerpt;

  $postThumbnailUrl1x = get_the_post_thumbnail_url($postId, 'preview-1x');
  $postThumbnailUrl2x = get_the_post_thumbnail_url($postId, 'preview-2x');
  $postThumbnailUrl3x = get_the_post_thumbnail_url($postId, 'preview-3x');

  return "<picture>
    <source media='(max-width: 420px)'
      data-srcset='$postThumbnailUrl1x, $postThumbnailUrl2x 1.5x, $postThumbnailUrl3x 2x'>

    <source media='(max-width: 767px)'
      data-srcset='$postThumbnailUrl2x, $postThumbnailUrl3x 2x'>

    <source
      data-srcset='$postThumbnailUrl1x, $postThumbnailUrl2x 1.5x, $postThumbnailUrl3x 2x'>

    <img data-src='$postThumbnailUrl1x' alt='$postExcerpt'>
  </picture>";
}

/** Pagination */
add_filter('navigation_markup_template', 'furry_pagination_template', 10, 2);
function furry_pagination_template($template, $class){
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}
