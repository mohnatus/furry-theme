<header class="page-header">
  <div class="container">
    <div class="page-top">
      <div class="social-menu">
        <?php wp_nav_menu([
          'theme_location' => 'social',
          'fallback_cb' => '',
        ]); ?>
      </div>
      <h2 class="page-title"><?php bloginfo( 'name' ); ?></h2>
      <div class="top-menu">
        <?php wp_nav_menu([
          'theme_location' => 'top',
          'fallback_cb' => '',
        ]); ?>
      </div>
    </div>
  </div>
  <div class="page-banner">
    <div class="page-banner__img" data-background="<?= get_template_directory_uri().'/assets/banner.jpg' ?>"></div>
    <!-- <div class="page-banner__info"></div> -->
    </div>
</header>
