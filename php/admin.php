<?php

add_action('admin_init', 'furry_settings_init');
add_action('admin_menu', 'furry_settings');

function furry_settings() {
	add_options_page('Analytics', 'Аналитика', 'manage_options', 'analytics', 'furry_analytics_settings');
}
function furry_settings_init() {
  add_settings_section( 'analytics_code', 'Коды аналитики', '', 'analytics' );
  add_settings_field(
		'analytics_head',
		'Код в секции head',
		'analytics_head_callback_function',
    'analytics',
    'analytics_code'
  );
  add_settings_field(
		'analytics_body_top',
		'Код вверху body',
		'analytics_body_top_callback_function',
    'analytics',
    'analytics_code'
  );
  add_settings_field(
		'analytics_body_bottom',
		'Код внизу body (скрыт от незарегистрированных)',
		'analytics_body_bottom_callback_function',
    'analytics',
    'analytics_code'
  );
  register_setting('analytics_group', 'analytics_head');
  register_setting('analytics_group', 'analytics_body_top');
  register_setting('analytics_group', 'analytics_body_bottom');
}
function furry_analytics_settings() {
  ?>
    <div class="wrap">
      <h1><?php echo get_admin_page_title() ?></h1>

      <form action="options.php" method="POST">
			<?php
				settings_fields('analytics_group');
				do_settings_sections('analytics');
				submit_button();
			?>
		</form>



  <?php
}
function analytics_head_callback_function() {
  echo "<textarea name='analytics_head' style='width: 100%' rows='10'>".get_option( 'analytics_head' )."</textarea>";
}
function analytics_body_top_callback_function() {
  echo "<textarea name='analytics_body_top' style='width: 100%' rows='10'>".get_option( 'analytics_body_top' )."</textarea>";
}
function analytics_body_bottom_callback_function() {
  echo "<textarea name='analytics_body_bottom' style='width: 100%' rows='10'>".get_option( 'analytics_body_bottom' )."</textarea>";
}
