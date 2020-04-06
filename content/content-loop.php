<?php

if(have_posts()): ?>

  <?php
    if (is_active_sidebar('before-loop-sidebar')) {
      ?>
        <?php dynamic_sidebar('before-loop-sidebar'); ?>
      <?php
    }
  ?>

  <div class="row">

    <?php while(have_posts()):
      the_post(); ?>

      <div class="col col-12 col-md-6 col-xl-4">
        <?php get_template_part('content/content', 'preview'); ?>
      </div>
    <?php endwhile; ?>

  </div><!-- .row -->

  <?php the_posts_pagination([
    'prev_text' => '<svg width="12" height="12"><use xlink:href="#prev-icon" href="#prev-icon"></svg>',
    'next_text' => '<svg width="12" height="12"><use xlink:href="#next-icon" href="#next-icon"></svg>',
  ]); ?>

<?php
    if (is_active_sidebar('after-loop-sidebar')) {
      ?>
        <?php dynamic_sidebar('after-loop-sidebar'); ?>
      <?php
    }
  ?>

<?php

else:
  get_template_part('content/content', 'none');
endif;
