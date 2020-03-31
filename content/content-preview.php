<article class="entry-preview px-sm-6 px-md-4 px-lg-6 px-xl-4 mb-6 transformed">
  <?php
    $postPermalink = get_permalink();
    $postExcerpt = get_the_excerpt();

    //$postThumbnailSrcset = wp_get_attachment_image_srcset($postThumbnailId);
  ?>

  <a href="<?= $postPermalink ?>" class="d-block nolink entry-preview__link">
    <div class="entry-preview__img">
      <?= furry_preview_img($post); ?>
    </div>

    <div class="entry-preview__content">
      <h3 class="entry-preview__title pt-1">
        <?= get_the_title() ?>
      </h3>

      <div class="entry-preview__text mt-4">
        <?= $postExcerpt ?>
      </div>
    </div>
  </a>




</article>
