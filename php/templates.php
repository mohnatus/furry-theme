<?php

/** Thumbnails */
add_theme_support('post-thumbnails');
add_image_size('preview-sm', 350, 175, true);
add_image_size('preview-md', 500, 250, true);
add_image_size('preview-lg', 800, 400, true);

function furry_get_preview_sizes() {
  return '(max-width: 575px) calc(100vw - 40px),
          (max-width: 767px) calc(100vw - 40px - 6.5em),
          (max-width: 991px) calc(50vw - 20px - 2.5em),
          (max-width: 1199px) calc(50vw - 20px - 6.5em),
          (max-width: 1200px) calc(35vw - 15px - 2.5em),
          (max-width: 1300px) 500px,
          500px';
}


function furry_get_preview_srcset($sm, $md, $lg) {
  return "$sm 350w, $md 500w, $lg 800w";
}

function furry_default_preview($alt) {
  $previewPath = get_template_directory_uri() . '/assets/img';

  $previewSm = "{$previewPath}/preview-default-sm.png";
  $previewMd = "{$previewPath}/preview-default-md.png";
  $previewLg = "{$previewPath}/preview-default-lg.png";

  $srcset = furry_get_preview_srcset($previewSm, $previewMd, $previewLg);
  $sizes = furry_get_preview_sizes();

  echo "<img alt='$alt'
          data-src='$previewMd'
          data-srcset='$srcset'
          sizes='$sizes'>";
}

function furry_preview_img($post) {
  $postId = $post->ID;
  $postExcerpt = $post->excerpt;
  if (!has_post_thumbnail($postId)) {
    return furry_default_preview($postExcerpt);
  }

  $sizes = furry_get_preview_sizes();

  $postThumbnailUrlSm = get_the_post_thumbnail_url($postId, 'preview-sm');
  $postThumbnailUrlMd = get_the_post_thumbnail_url($postId, 'preview-md');
  $postThumbnailUrlLg = get_the_post_thumbnail_url($postId, 'preview-lg');
  $srcset = furry_get_preview_srcset($postThumbnailUrlSm, $postThumbnailUrlMd, $postThumbnailUrlLg);

  echo "<img alt='$postExcerpt'
    data-src='$postThumbnailUrlMd'
    data-srcset='$srcset'
    sizes='$sizes'>";
}

function furry_banner_img() {
  $path = get_template_directory_uri() . '/assets/img';

  $bannerXl = "$path/banner-xl.jpg"; // 1920
  $bannerLg = "$path/banner-lg.jpg"; // 1200
  $bannerMd = "$path/banner-md.jpg"; // 1000
  $bannerSm = "$path/banner-sm.jpg"; // 800
  $bannerXs = "$path/banner-xs.jpg"; // 530


  echo "<img alt='' data-src='$bannerXl'
        data-srcset='$bannerXs 530w, $bannerSm 800w, $bannerMd 1000w, $bannerLg 1200w, $bannerXl 1920w'
        sizes='100vw'>";
}

/** Lazy load */
add_filter('the_content', 'furry_lazy_load');
function furry_lazy_load($content) {
  $dom = new DOMDocument();
  $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'utf-8');
  libxml_use_internal_errors(true);
  $dom->loadHtml($content);
  libxml_use_internal_errors(false);

  $images = $dom->getElementsByTagName('img');

  foreach($images as $img) {
    $src = $img->getAttribute('src');
    $srcset = $img->getAttribute('srcset');

    $img->removeAttribute('src');
    $img->removeAttribute('srcset');

    $img->setAttribute('data-srcset', $srcset);
    $img->setAttribute('data-src', $src);
  }

	return $dom->saveHTML();
}

/** Pagination */
add_filter('navigation_markup_template', 'furry_pagination_template', 10, 2);
function furry_pagination_template($template, $class){
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
