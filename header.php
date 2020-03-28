<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php get_template_part('content/meta'); ?>

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=cyrillic-ext" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:500&display=swap&subset=cyrillic" rel="stylesheet">
  <?php wp_head(); ?>

  <!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
	   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
	   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	   ym(37661975, "init", {
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true
	   });
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/37661975" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- /Yandex.Metrika counter -->
</head>
<body <?php body_class('d-flex direction-column'); ?>>
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
