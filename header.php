<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo wp_get_document_title(); ?></title>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=cyrillic-ext" rel="stylesheet">
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
            <?php wp_nav_menu([
              'theme_location' => 'social',
              'fallback_cb' => '',
            ]); ?>
          </div>
          <h2 class="h1 page-title px-1">
            <a href="<?= home_url() ?>" class="nolink">
              <?php bloginfo( 'name' ); ?>
            </a>
          </h2>
          <div class="top-menu">
            <div class="top-menu__control text-right">
              <button class="top-menu__icon btn btn-none" data-drawer-open>
                <svg width="24" height="24"><use xlink:href="#menu-icon" href="#menu-icon"></svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="page-banner">
        <div class="page-banner__img" data-background="<?= get_template_directory_uri().'/assets/img/banner.jpg' ?>"></div>
        <div class="page-banner__content">

        </div>
      </div>
    </header>

    <div class="drawer">
      <div class="drawer__mask" data-drawer-close></div>
      <div class="drawer__panel">
        <div class="drawer__scroll">
          <div class="mb-4 drawer__close text-right" data-drawer-close>
            <svg width="24" height="24"><use xlink:href="#close-icon" href="#close-icon"></svg>
          </div>
          <div class="mb-5">
            <?php get_search_form(); ?>
          </div>
          <div class="main-menu">
            <?php wp_nav_menu([
              'theme_location' => 'main',
              'fallback_cb' => '',
            ]); ?>
          </div>
        </div>
      </div>
    </div>

    <main class="page-main py-6">
