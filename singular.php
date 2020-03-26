<?php get_header(); ?>

  <div class="container">

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

                <div class="entry__content">
                  <?php the_content(); ?>
                </div>

                <footer class="entry__footer">
                  <div class="entry__meta">
                    <div class="entry__tags">
                      <?php the_tags('', ',', ''); ?>
                    </div>
                  </div>
                </footer>
              </article>


            <div class="navigation d-flex justify-between">
              <?php previous_post_link(
                '<div class="navigation-link navigation-link--prev">%link</div>',
                '<div class="d-flex align-center">
                  <svg width="12" height="12"><use xlink:href="#prev-icon" href="#prev-icon"></svg>
                  <span class="ml-2">%title</span>
                </div>',
                TRUE);
              ?>
              <?php next_post_link(
                '<div class="navigation-link navigation-link--next">%link</div>',
                '<div class="d-flex align-center">
                  <span class="mr-2">%title</span>
                  <svg width="12" height="12"><use xlink:href="#next-icon" href="#next-icon"></svg>
                </div>',
                TRUE);
              ?>
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
