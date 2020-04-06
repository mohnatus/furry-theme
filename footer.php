    </div><!-- .page-content -->

    <?php
      if (is_active_sidebar('before-footer-sidebar')) {
        ?>
          <?php dynamic_sidebar('before-footer-sidebar'); ?>
        <?php
      }
    ?>

    <footer class="page-footer py-4 py-md-6">
      <div class="container">
        <div>© <?php bloginfo( 'name' ); ?></div>
      </div>
    </footer>
  </div><!-- .page -->

  <?php wp_footer(); ?>
</body>
</html>
