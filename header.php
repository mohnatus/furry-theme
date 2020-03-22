<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo wp_get_document_title(); ?></title>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,400,700,900&display=swap&subset=cyrillic-ext" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:500&display=swap&subset=cyrillic" rel="stylesheet">
  <?php wp_head(); ?>
</head>
<body>
  <div style="display: none">
    <?php get_template_part('content/svg'); ?>
  </div>
  <div class="page">

    <header class="page-header">
      <div class="container">
        <div class="page-top">
          <div class="social-menu">
            <?php furry_nav_menu('social') ?>
          </div>
          <h2 class="h1 page-title px-1">
            <a href="<?= home_url() ?>" class="nolink">
              <?php bloginfo( 'name' ); ?>
            </a>
          </h2>
          <div class="top-menu">
            <?php furry_nav_menu('top'); ?>
          </div>
        </div>
      </div>
      <div class="page-banner">
        <div class="page-banner__img" data-background="<?= get_template_directory_uri().'/assets/img/banner.jpg' ?>"></div>
        <div class="page-banner__content">

        </div>
      </div>
    </header>

    <main class="page-main py-6">
