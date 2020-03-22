<article class="post-preview px-sm-6 px-md-4 px-lg-6 px-xl-4 mb-6 transformed">
  <?php
    $postPermalink = get_permalink();
    $postExcerpt = get_the_excerpt();

    //$postThumbnailSrcset = wp_get_attachment_image_srcset($postThumbnailId);
  ?>

  <a href="<?= $postPermalink ?>" class="post-preview__img">
    <?= furry_preview_img($post); ?>
  </a>

  <div class="post-preview__content">
    <h3 class="post-preview__title pt-1">
      <a class="nolink" href="<?= $postPermalink ?>">
        <?= get_the_title() ?>
      </a>
    </h3>

    <div class="post-preview__text mt-4">
      <?= $postExcerpt ?>
    </div>
  </div>


</article>
