    </div><!-- .page-content -->

    <footer class="page-footer py-4 py-md-6">
      <div class="container">
        <div>© <?php bloginfo( 'name' ); ?></div>


        <?php if (is_user_logged_in()): ?>
          <div class="mt-4">
            <?= get_option( 'analytics_body_bottom' ); ?>
          </div>
				<?php endif; ?>
      </div>

    </footer>

  </div><!-- .page -->

  <?php wp_footer(); ?>
</body>
</html>
