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
  $alt = $post->post_title;
  if (!has_post_thumbnail($postId)) {
    return furry_default_preview($alt);
  }

  $sizes = furry_get_preview_sizes();

  $postThumbnailUrlSm = get_the_post_thumbnail_url($postId, 'preview-sm');
  $postThumbnailUrlMd = get_the_post_thumbnail_url($postId, 'preview-md');
  $postThumbnailUrlLg = get_the_post_thumbnail_url($postId, 'preview-lg');
  $srcset = furry_get_preview_srcset($postThumbnailUrlSm, $postThumbnailUrlMd, $postThumbnailUrlLg);

  echo "<img alt='$alt'
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

  $alt = get_bloginfo('name');

  echo "<img alt='$alt' data-src='$bannerXl'
        data-srcset='$bannerXs 530w, $bannerSm 800w, $bannerMd 1000w, $bannerLg 1200w, $bannerXl 1920w'
        sizes='100vw'>";
}

function furry_sidebar_banner_img($banner) {
  $bannerId = $banner->term_id;
  $bannerImageId = get_term_meta( $bannerId, 'term_image_id', 1 );
  $bannerImageUrlSm = wp_get_attachment_image_url( $bannerImageId, 'preview-sm' );
  $bannerImageUrlMd = wp_get_attachment_image_url( $bannerImageId, 'preview-md' );
  $bannerImageUrlLg = wp_get_attachment_image_url( $bannerImageId, 'preview-lg' );
  $srcset = furry_get_preview_srcset($bannerImageUrlSm, $bannerImageUrlMd, $bannerImageUrlLg);
  $sizes = '(max-width: 1199px) 100vw, 320px';
  echo "<img alt=''
    data-src='$bannerImageUrlMd'
    data-srcset='$srcset'
    sizes='$sizes'>";
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
