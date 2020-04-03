<?php
  $isMainSidebarActive = is_active_sidebar('main-sidebar');
  $banners = get_the_terms( $post->ID, 'banner' );
  $isSidebarVisible = $isMainSidebarActive || ($banners && count($banners) > 0);
?>

<?php if ($isSidebarVisible): ?>
  <div class="col col-12 col-lg-4 col-xl-3">
    <aside class="page-sidebar">
      <div class="page-sidebar__sticky">

        <?php foreach($banners as $banner): ?>
          <?php $bannerLink = get_term_meta( $banner->term_id, 'term_link', 1 ); ?>

          <article class="post-widget text-center">
            <a href="<?= $bannerLink ?>" class="d-block p-3 nolink">
              <div class="post-widget__image">
                <?php furry_sidebar_banner_img($banner); ?>
              </div>
              <div class="post-widget__content">
                <h2 class="h3 mb-2"><?= $banner->name; ?></h2>
                <?php if ($banner->description): ?>
                  <div><?= $banner->description ?></div>
                <?php endif; ?>
              </div>
            </a>
          </article>

        <?php endforeach; ?>



        <?php if ($isMainSidebarActive): ?>
          <?php dynamic_sidebar('main-sidebar'); ?>
        <?php endif ?>
      </div>

    </aside>
  </div>
<?php endif; ?>
