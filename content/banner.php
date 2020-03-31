<div class="page-banner">
  <?php /*
  <div class="page-banner__img" data-style="background-image: url(<?= get_template_directory_uri().'/assets/img/banner.jpg' ?>); background-image: url(<?= get_template_directory_uri().'/assets/img/banner.webp' ?>)"></div>
  */ ?>

  <div class="page-banner__img">
    <?php furry_banner_img() ?>
  </div>

  <div class="page-banner__content text-center d-flex align-center">

    <?php if (is_search()): ?>
      <div class="container my-2">
        <h1 class="h0">
          <div class="page-banner__supheader text-uppercase">
            Вы искали:
          </div>
          <div class="h1 page-banner__title my-2"><?= get_search_query() ?></div>
        </h1>
      </div>
    <?php endif; ?>

    <?php if (is_category()): ?>
      <div class="container">
        <div class="page-banner__supheader text-uppercase">
          Рубрика
        </div>
        <h1 class="page-banner__title my-2"><?= single_cat_title(); ?></h1>
      </div>
    <?php endif; ?>

    <?php if (is_tag()): ?>
      <div class="container">
        <div class="page-banner__supheader text-uppercase">
          Метка
        </div>
        <h1 class="page-banner__title my-2"><?= single_tag_title('', false); ?></h1>
      </div>
    <?php endif; ?>

    <?php if(is_singular()): ?>
      <div class="container">
        <div class="page-banner__supheader text-uppercase">
          <?php the_category(', '); ?>
        </div>
        <div class="h1 page-banner__title my-2"><?php the_title(); ?></div>

        <div class="page-banner__meta">
          <span title="<?php the_time('j F Y, h:i') ?>"><?php the_time('j/m/Y'); ?></span>
        </div>
      </div>
    <?php endif; ?>

    <?php if(is_404()): ?>
      <div class="container">
        <div class="h1 page-banner__title my-2">404</div>
      </div>
    <?php endif; ?>
  </div>
</div>
