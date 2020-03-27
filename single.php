<?php get_header(); ?>

  <div class="container container--narrow">

    <div class="row">

      <div class="col col-12 col-lg-8 col-xl-9">
        <main class="page-main">

          <?php the_post(); ?>

          <article id="entry-<?php the_ID(); ?>" class="entry">
            <header class="entry__header visually-hidden">
              <div class="entry__meta">
                <h1 class="entry__title my-2"><?php the_title(); ?></h1>
                <span class="entry__categories">
                  <?php the_category(', '); ?>
                </span>
                <span class="entry__time" title="<?php the_time('j F Y, h:i') ?>"><?php the_time('j/m/Y'); ?></span>
              </div>
            </header>

            <?php get_template_part('content/entry', 'contentlist'); ?>

            <div class="entry__content ugc">
              <?php the_content(); ?>

              <?php get_template_part('content/entry', 'source'); ?>
            </div>

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
      <div class="col col-12 col-lg-4 col-xl-3">
        <aside class="page-sidebar">
          <?php dynamic_sidebar('main-sidebar'); ?>
        </aside>
      </div>
    </div>

  </div>

<?php get_footer(); ?>
