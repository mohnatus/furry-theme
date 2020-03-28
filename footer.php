    </div><!-- .page-content -->

    <footer class="page-footer py-4 py-md-6">
      <div class="container">
        <div>© <?php bloginfo( 'name' ); ?></div>



        <?php if (current_user_can('edit_files')): ?>
          <?= get_option( 'analytics_body_bottom' ); ?>
				<?php endif; ?>
      </div>

    </footer>

  </div><!-- .page -->

  <?php wp_footer(); ?>
</body>
</html>
