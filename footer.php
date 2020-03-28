    </div><!-- .page-content -->

    <footer class="page-footer py-4 py-md-6">
      <div class="container">
        <div>© <?php bloginfo( 'name' ); ?></div>

        <?php if (current_user_can('edit_files')): ?>
					<!-- Yandex.Metrika informer -->
					<a href="https://metrika.yandex.ru/stat/?id=37661975&amp;from=informer"
					target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/37661975/3_0_202020FF_000000FF_1_pageviews"
					style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="37661975" data-lang="ru" /></a>
					<!-- /Yandex.Metrika informer -->
				<? endif; ?>
      </div>

    </footer>

  </div><!-- .page -->

  <?php wp_footer(); ?>
</body>
</html>
