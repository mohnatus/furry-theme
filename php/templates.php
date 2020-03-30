<?php

/** Thumbnails */
add_theme_support('post-thumbnails');
add_image_size('preview-1x', 400, 200, true);
add_image_size('preview-2x', 800, 400, true);
add_image_size('preview-3x', 1200, 600, true);

function furry_preview_img($post) {
  $postId = $post->ID;
  $postExcerpt = $post->excerpt;

  $postThumbnailUrlFull = get_the_post_thumbnail_url($postId, 'full');

  if (!$postThumbnailUrlFull) {
    $previewPath = get_template_directory_uri() . '/assets/img';
    $previewWebp = "{$previewPath}/preview-default-3x.webp";
    $preview1x = "{$previewPath}/preview-default-1x.png";
    $preview2x = "{$previewPath}/preview-default-2x.png";
    $preview3x = "{$previewPath}/preview-default-3x.png";

    return "<picture>
      <source type='image/webp'
        data-srcset='$previewWebp'>
      <source media='(max-width: 420px)'
        data-srcset='$preview1x'>

      <source media='(max-width: 767px)'
        data-srcset='$preview2x'>

      <source
        data-srcset='$preview1x'>

      <img data-src='$preview1x' alt='$postExcerpt'>
    </picture>";
  }

  $postThumbnailUrl1x = get_the_post_thumbnail_url($postId, 'preview-1x');
  $postThumbnailUrl2x = get_the_post_thumbnail_url($postId, 'preview-2x');
  $postThumbnailUrl3x = get_the_post_thumbnail_url($postId, 'preview-3x');

  $postThumbnailUrlWebp1x = '';

  return "<picture>
    <source media='(max-width: 420px)'
      data-srcset='$postThumbnailUrl1x'>

    <source media='(max-width: 767px)'
      data-srcset='$postThumbnailUrl2x'>

    <source
      data-srcset='$postThumbnailUrl1x'>

    <img data-src='$postThumbnailUrl1x' alt='$postExcerpt'>
  </picture>";
}
function furry_entry_img($post) {
  $postID = $post->ID;
  $postExcerpt = $post->excerpt;

  $postThumbnailUrl1x = get_the_post_thumbnail_url($postId, 'preview-1x');
  $postThumbnailUrl2x = get_the_post_thumbnail_url($postId, 'preview-2x');
  $postThumbnailUrl3x = get_the_post_thumbnail_url($postId, 'preview-3x');
  $postThumbnailUrlFull = get_the_post_thumbnail_url($postId, 'full');

  return "<picture>
    <source media='(max-width: 420px)'
      data-srcset='$postThumbnailUrl1x'>

    <source media='(max-width: 820px)'
      data-srcset='$postThumbnailUrl2x'>

    <source
      data-srcset='$postThumbnailUrlFull'>

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

/** Adminbar margins */
add_action( 'admin_bar_init', function() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
});

/** Webp */
function furry_content() {
  $content = get_the_content();
  $content = furry_wrap_images($content);
  echo $content;
}
function furry_wrap_images($content) {
  $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'utf-8');
  $dom = new DOMDocument();
  libxml_use_internal_errors(true);
  $dom->loadHTML($content);
  libxml_clear_errors();

  $images = $dom->getElementsByTagName('img');
  $sources = $dom->getElementsByTagName('source');

  foreach ($images as $img) {
      $imgSrc = $img->getAttribute('src');
      $img->setAttribute("alt", 'test');
      if (is_user_logged_in()) {
        var_dump($imgSrc);
      }
      // $img->removeAttribute("src");

      // var_dump($img->getAttribute('srcset'));
      // $webpSource->setAttribute("data-srcset", $imgSrcWebp);

      // if (file_exists($imgSrcWebp)) {
      //   $webpSource->setAttribute("data-srcset", $imgSrcWebp);
      // }
  }

  foreach ($sources as $img) {
    $imgSrc = $img->getAttribute('src');
    $img->setAttribute("alt", 'test');
    if (is_user_logged_in()) {
      var_dump($imgSrc);
    }
    // $img->removeAttribute("src");

    // var_dump($img->getAttribute('srcset'));
    // $webpSource->setAttribute("data-srcset", $imgSrcWebp);

    // if (file_exists($imgSrcWebp)) {
    //   $webpSource->setAttribute("data-srcset", $imgSrcWebp);
    // }
}

  // $html = $dom->saveHTML();
  return $content;
}
