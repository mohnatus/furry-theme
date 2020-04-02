
<aside class="page-sidebar">
  <?php if (get_post_meta( $post->ID, 'postwidget_visible', true)): ?>
    <?php
      $widget_link = get_post_meta( $post->ID, 'postwidget_link', true);
      $widget_title = get_post_meta( $post->ID, 'postwidget_title', true);
      $widget_description = get_post_meta( $post->ID, 'postwidget_description', true);
      $widget_image = get_post_meta( $post->ID, 'postwidget_image', true);
      $widget_classes = get_post_meta( $post->ID, 'postwidget_classes', true);
    ?>

    <article class="post-widget text-center mb-4 <?= $widget_classes ?>">
      <a href="<?= $widget_link ?>" rel="noopener noreferrer" class="post-widget__link nolink d-block py-3">
        <img src="<?= $widget_image ?>" alt="" class="post-widget__image mb-3">
        <div class="post-widget__content">
          <?php if ($widget_title): ?>
            <h2 class="h3 mb-2"><?= $widget_title ?></h2>
          <?php endif; ?>
          <?php if ($widget_description): ?>
            <div><?= $widget_description ?></div>
          <?php endif; ?>
        </div>
      </a>
    </article>

  <?php endif; ?>

  <?php if (is_active_sidebar('main-sidebar')): ?>
    <?php dynamic_sidebar('main-sidebar'); ?>
  <?php endif ?>
</aside>
