<?php $commentsCount = get_comments_number(); ?>

<div id="comments" class="comments mt-6">

  <section class="comments__list">
    <h2 class="h3">
      <?= $commentsCount ?>
      <?= declination($commentsCount, ['комментарий', 'комментария', 'комментариев']) ?>
    </h2>

    <?php if (have_comments()): ?>

      <ul class="comments-list">
        <?php
          wp_list_comments([
						'walker' => new clean_comments_constructor
					]);
        ?>
      </ul>

      <?php the_comments_pagination([
				'prev_text' => '<svg width="12" height="12"><use xlink:href="#prev-icon" href="#prev-icon"></svg>',
				'next_text' => '<svg width="12" height="12"><use xlink:href="#next-icon" href="#next-icon"></svg>',
			]); ?>
    <?php endif; ?>
  </section>

	<?php furry_comments_form(); ?>
</div>
