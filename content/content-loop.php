<?php

if(have_posts()): ?>

  <div class="row">

    <?php while(have_posts()):
      the_post(); ?>

      <div class="col col-12 col-md-6 col-lg-4">
        <?php get_template_part('content/content', 'preview'); ?>
      </div>
    <?php endwhile; ?>

  </div><!-- .row -->

<?php

else:
  get_template_part('content/content', 'none');
endif;
