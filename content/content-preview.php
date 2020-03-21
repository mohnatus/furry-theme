<article class="post-preview px-4 px-md-6">
  <?php
    $postPermalink = get_permalink();
    $postExcerpt = get_the_excerpt();
  ?>

  <a href="<?= $postPermalink ?>" class="post-preview__img">
    <?= get_the_post_thumbnail( null, 'preview', [
      'alt' => $postExcerpt,
    ] ); ?>
  </a>


  <h3 class="post-preview__title">
    <a href="<?= $postPermalink ?>">
      <?= get_the_title() ?>
    </a>
  </h3>

  <div class="post-preview__text">
    <?= $postExcerpt ?>
  </div>

</article>
