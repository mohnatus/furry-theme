<?php
  $siteName = get_bloginfo('name');
  $separator = ' | ';
  $pageTitle = $siteName;
  $pageDescription = get_bloginfo('description');
  $pageKeywords = 'frontend, html, css, js, javascript';
  $pageImage = get_template_directory_uri() . '/assets/img/preview-default-3x.png';

  $pageType = '';

  if (is_single()) {
    $pagemetaTitle = get_post_meta($post->ID, 'pagemeta_title', true);
    $pagemetaDescription = get_post_meta($post->ID, 'pagemeta_description', true);
    $pagemetaKeywords = get_post_meta($post->ID, 'pagemeta_keywords', true);

    $thumbnail = get_the_post_thumbnail_url('full');

    $pageTitle = $pagemetaTitle ? $pagemetaTitle : get_the_title();
    $pageDescription = $pagemetaDescription ? $pagemetaDescription : get_the_excerpt();
    $pageKeywords = $pagemetaKeywords;
    $pageImage = $thumbnail ? $thumbnail : $pageImage;

    $pageType = 'article';
  }
?>

<title><?= $pageTitle.$separator.$siteName ?></title>
<meta name="description" content="<?= $pageDescription ?>">
<meta name="keywords" content="<?= $pageKeywords ?>">

<meta name="og:title" content="<?= $pageTitle ?>">
<meta name="og:type" content="<?= $pageType ?>">
<meta name="og:image" content="<?= $pageImage ?>">
<meta name="og:url" content="<?= home_url().$_SERVER['REQUEST_URI'] ?>">
<meta name="og:description" content="<?= $pageDescription ?>">
<meta name="og:locale" content="ru_RU">
<meta name="og:site_name" content="<?= $siteName ?>">
