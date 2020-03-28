<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php get_template_part('content/meta'); ?>

  <style id="critical-css">
    <?php
      $criticalFile = get_theme_file_path('/assets/css/critical.css');
      echo file_get_contents($criticalFile);
    ?>
  </style>

  <?php wp_head(); ?>



  <?= get_option( 'analytics_head' ); ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() { window.contentLoaded = true; });
  </script>

</head>
<body <?php body_class('d-flex direction-column'); ?>>
  <?= get_option( 'analytics_body_top' ); ?>

  <div style="display: none">
    <?php get_template_part('content/svg'); ?>
  </div>
  <div class="page d-flex direction-column grow-1">

    <header class="page-header">
      <div class="container">
        <div class="page-top">
          <div class="social-menu">
            <?php wp_nav_menu([
              'theme_location' => 'social',
              'fallback_cb' => '',
            ]); ?>
          </div>
          <div class="h1 page-title px-1">
            <a href="<?= home_url() ?>" class="nolink">
              <?php bloginfo('name'); ?>
            </a>
          </div>
          <div class="top-menu">
            <div class="top-menu__control text-right">
              <button class="top-menu__icon btn btn-none" data-drawer-open>
                <svg width="24" height="24"><use xlink:href="#menu-icon" href="#menu-icon"></svg>
              </button>
            </div>
          </div>

        </div>

      </div>
      <?php get_template_part('content/banner'); ?>
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



    <div class="page-content py-6 grow-1">
