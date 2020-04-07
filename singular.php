<?php get_header(); ?>

<div class="container">

  <div class="row row-lg-nowrap">

    <div class="col col-full overflow-hidden">
      <main class="page-main content-width mx-auto"  class="entry" itemscope itemtype="http://schema.org/Article">

        <?php the_post(); ?>

        <article id="entry-<?php the_ID(); ?>">

          <header class="entry__header visually-hidden">
            <div class="entry__meta">
              <h1 itemprop="headline" class="entry__title my-2"><?php the_title(); ?></h1>
              <span class="entry__categories">
                <?php the_category(', '); ?>
              </span>
              <time class="entry__time" datetime="<?php the_time('c'); ?>" title="<?php the_time('j F Y, h:i') ?>"><?php the_time('j/m/Y'); ?></time>
              <meta itemprop="dateCreated" content="<?php the_time('c'); ?>">
              <meta itemprop="datePublished" content="<?php the_time('c'); ?>">
              <meta itemprop="dateModified" content="<?php the_time('c'); ?>">
              <meta itemprop="author" content="<?= get_the_author() ?>"/>
              <meta itemprop="inLanguage" content="ru-RU">
              <meta itemprop="isFamilyFriendly" content="true">
              <meta itemprop="keywords" content="">
              <?php
                $postMetaThumbnail = get_the_post_thumbnail_url($post->ID, 'full');
                if (!$postMetaThumbnail) {
                  $postMetaThumbnail = get_template_directory_uri() . '/assets/img/preview-default-3x.png';
                }
              ?>
              <meta itemprop="image" content="<?= $postMetaThumbnail  ?>">
            </div>
          </header>

          <div class="entry__content ugc" itemprop="articleBody">
            <?php the_content(); ?>
          </div>

          <?php get_template_part('content/entry', 'source'); ?>
          <?= do_shortcode("[recommendations id='{$post->ID}']"); ?>

          <footer class="entry__footer mt-6">
            <div class="entry__meta">
              <?php $tags = get_the_terms($post->ID, 'post_tag'); ?>
              <?php if ($tags): ?>
                <div class="entry__tags ">
                  <svg width="16" height="16" class="color-icon text-middle mr-1">
                    <use xlink:href="#tag-icon" href="#tag-icon">
                  </svg>
                  <?php

                    echo implode('<span class="color-inactive"> | </span>', array_map(function($tag) {
                      $tag_link = get_tag_link($tag->term_id);
                      $tag_name = $tag->name;
                      $tag_slug = $tag->slug;
                      return "<a href='$tag_link' class='tag tag--$tag_slug color-inactive text-small'>$tag_name</a>";
                    }, $tags));

                  ?>
                </div>
              <?php endif; ?>
            </div>
          </footer>
        </article>


        <div class="navigation mt-6">
          <?php
            $previousPostLink = get_previous_post_link('%link');
            $nextPostLink = get_next_post_link('%link');
          ?>

          <?php if ($previousPostLink || $nextPostLink): ?>
            <div class="row">
              <div class='col col-12 col-md-6 mb-4'>
                <?php if ($previousPostLink): ?>
                  <div class='navigation-link navigation-link--prev'>
                    <div class='navigation-link__title mb-2 color-inactive text-small'>
                      Предыдущий пост
                    </div>
                    <?= $previousPostLink ?>
                  </div>
                <?php endif; ?>
              </div>

              <div class='col col-12 col-md-6 mb4 text-md-right'>
                <?php if ($nextPostLink): ?>
                  <div class='navigation-link navigation-link--next'>
                    <div class='navigation-link__title mb-2 color-inactive text-small '>
                      Следующий пост
                    </div>
                    <?= $nextPostLink ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <?php comments_template('', true); ?>

      </main>
    </div>



    <?php get_template_part('content/sidebar', 'entry'); ?>


  </div>

</div>

<?php get_footer(); ?>
