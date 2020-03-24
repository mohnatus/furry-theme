<div class="page-banner">
  <div class="page-banner__img" data-background="<?= get_template_directory_uri().'/assets/img/banner.jpg' ?>"></div>
  <div class="page-banner__content text-center d-flex align-center">

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
  </div>
</div>
