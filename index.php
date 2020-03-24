<?php get_header(); ?>

<main class="page-main">
  <div class="container">
    <?php if (is_search()): ?>
      <h1 class="h2 mb-4">
        <span class="color-inactive"><?php _e('Вы искали:') ?></span>
        <?= get_search_query() ?>
      </h1>
    <?php endif; ?>

    <?php if (is_category()): ?>
      <h1 class="h2 mb-4">
        <span class="color-inactive"><?= single_cat_title(); ?></span>
        <?= get_search_query() ?>
      </h1>
    <?php endif; ?>

    <?php if (is_tag()): ?>
      <h1 class="h2 mb-4">
        <span class="color-inactive"><?= single_tag_title('', false); ?></span>
        <?= get_search_query() ?>
      </h1>
    <?php endif; ?>

    <?php get_template_part('content/content', 'loop'); ?>

  </div>
</main>

<?php get_footer(); ?>
