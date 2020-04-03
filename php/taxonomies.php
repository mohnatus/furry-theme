<?php

add_action( 'init', 'furry_register_taxonomies' );
function furry_register_taxonomies() {
  register_taxonomy( 'banner', [ 'post', 'page' ], [
		'label'                 => '',
		'labels'                => [
			'name'              => 'Баннеры',
			'singular_name'     => 'Баннер',
			'search_items'      => 'Искать баннеры',
			'all_items'         => 'Все баннеры',
			'view_item '        => 'Посмотреть баннер',
			'edit_item'         => 'Редактировать баннер',
			'update_item'       => 'Обновить баннер',
			'add_new_item'      => 'Добавить новый баннер',
			'new_item_name'     => 'Название нового баннера',
      'menu_name'         => 'Баннер',
      'popular_items'     => 'Популярные баннеры',
		],
		'description'           => 'Рекламные баннеры в сайдбаре постов и страниц',
		'public'                => true,
		'publicly_queryable'    => false,
		// 'show_in_nav_menus'     => true, // равен аргументу public
		// 'show_ui'               => true, // равен аргументу public
		// 'show_in_menu'          => true, // равен аргументу show_ui
		// 'show_tagcloud'         => true, // равен аргументу show_ui
    // 'show_in_quick_edit'    => null, // равен аргументу show_ui
    'show_in_rest'          => true,
    'rest_base'             => 'banners',
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box',
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
    'rest_base'             => null, // $taxonomy
    'sort'                  => true,
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}

/**
 * Добавляет возможность загружать изображения для элементов указанных таксономий - категории, метки.
 * Получить ID картинки термина: $image_id = get_term_meta( $term_id, 'term_image_id', 1 );
 * Затем получить URL картинки: $image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
 * @Author: Kama
 * @ver: 1.1
 */
if( ! class_exists('Term_Meta_Image') ){

	class Term_Meta_Image {

		public $for_taxes = array('category', 'post_tag', 'banner'); // для каких таксономий должен работать код

		## Initialize the class and start calling our hooks and filters
		public function __construct(){

			foreach( $this->for_taxes as $taxname ){
				add_action("{$taxname}_add_form_fields",   array( & $this, 'add_term_image' ),     10, 2 );
				add_action("{$taxname}_edit_form_fields",  array( & $this, 'update_term_image' ),  10, 2 );
				add_action("created_{$taxname}",           array( & $this, 'save_term_image' ),    10, 2 );
				add_action("edited_{$taxname}",            array( & $this, 'updated_term_image' ), 10, 2 );

				add_filter("manage_edit-{$taxname}_columns",  array( & $this, 'add_image_column' ) );
				add_filter("manage_{$taxname}_custom_column", array( & $this, 'fill_image_column' ), 10, 3 );
			}
		}

		## Add a form field in the new category page
		public function add_term_image( $taxonomy ){
			wp_enqueue_media(); // подключим стили медиа, если их нет

			add_action('admin_print_footer_scripts', array( & $this, 'add_script' ), 99 );
			?>
			<div class="form-field term-group">
				<label for="term_image_id">
					<?php _e('Image', 'hero-theme'); ?>
				</label>
				<input type="hidden" id="term_image_id" name="term_image_id" class="custom_media_url" value="">
				<div id="term__image__wrapper"></div>
				<p>
					<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
					<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
				</p>
			</div>
			<?php
		}

		## Edit the form field
		public function update_term_image( $term, $taxonomy ){
			wp_enqueue_media(); // подключим стили медиа, если их нет

			add_action('admin_print_footer_scripts', array( & $this, 'add_script' ), 99 );

			$image_id = get_term_meta( $term -> term_id, 'term_image_id', true );
			?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="term_image_id"><?php _e( 'Image', 'hero-theme' ); ?></label>
				</th>
				<td>
					<input type="hidden" id="term_image_id" name="term_image_id" value="<?php echo $image_id; ?>">
					<div id="term__image__wrapper">
					 <?php if( $image_id ){
							echo wp_get_attachment_image( $image_id, 'preview-sm' );
						} ?>
					</div>
					<p>
						<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
						<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
					</p>
				</td>
			</tr>
			<?php
		}

		## Save the form field
		public function save_term_image( $term_id, $tt_id ){
			if( isset( $_POST['term_image_id'] ) && '' !== $_POST['term_image_id'] ){
				$image = $_POST['term_image_id'];
				add_term_meta( $term_id, 'term_image_id', $image, true );
			}
		}

		## Update the form field value
		public function updated_term_image( $term_id, $tt_id ){
			if( isset( $_POST['term_image_id'] ) && '' !== $_POST['term_image_id'] ){
				$image = $_POST['term_image_id'];
				update_term_meta( $term_id, 'term_image_id', $image );
			}
			else
				update_term_meta( $term_id, 'term_image_id', '' );
		}

		## Add script
		public function add_script(){
			// выходим если мы не на нужной странице таксономии
			//$cs = get_current_screen();
			//if( ! in_array($cs->base, array('edit-tags','term')) || ! in_array($cs->taxonomy, (array) $this->for_taxes) )
			//  return;

			?>
			<script>
			jQuery(document).ready( function($){
				function ct_media_upload( button_class ){
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;

					$('body').on('click', button_class, function(e){
						var button_id           = '#'+$(this).attr('id');
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button              = $(button_id);

						_custom_media = true;

						wp.media.editor.send.attachment = function( props, attachment ){
							if( _custom_media ){
								$('#term_image_id').val(attachment.id);
								$('#term__image__wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
								$('#term__image__wrapper .custom_media_image').attr('src',attachment.sizes.thumbnail.url).css('display','block');
							}
							else {
								return _orig_send_attachment.apply( button_id, [props, attachment] );
							}
						}
						wp.media.editor.open(button);
						return false;
					});
				}

				ct_media_upload('.ct_tax_media_button.button');

				$('body').on('click','.ct_tax_media_remove',function(){
					$('#term_image_id').val('');
					$('#term__image__wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
				});

				// Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
				$(document).ajaxComplete(function( event, xhr, settings ){
					var queryStringArr = settings.data.split('&');

					if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
						var xml = xhr.responseXML;
						$response = $(xml).find('term_id').text();

						if( $response != '' ){
							$('#term__image__wrapper').html(''); // Clear the thumb image
						}
					}
				});
			});
			</script>
			<?php
		}

		## Добавляет колонкку картинки в таблицу терминов
		public function add_image_column( $columns ){
			// подправим ширину колонки через css
			add_action('admin_notices', function(){
				echo '<style>.column-image{ width:60px; text-align:center; }</style>';
			});

			$num = 1; // после какой по счету колонки вставлять новые

			$new_columns = array( 'image'=>'Картинка' );

			return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
		}

		public function fill_image_column( $string, $column_name, $term_id ){
			if ($column_name !== 'image') return $string;
			$image_id = get_term_meta( $term_id, 'term_image_id', 1 );
			// если есть картинка
			if( $image_id ){
				$string = '<img src="'. wp_get_attachment_image_url( $image_id, 'preview-sm' ) .'" width="40" alt="" />';
			}

			return $string;
		}
	}

	new Term_Meta_Image();
}

if( ! class_exists('Banner_Meta_Link') ){

	class Banner_Meta_Link {

		public $for_taxes = array('banner'); // для каких таксономий должен работать код

		## Initialize the class and start calling our hooks and filters
		public function __construct(){

			foreach( $this->for_taxes as $taxname ){
				add_action("{$taxname}_add_form_fields",   array( & $this, 'add_term_link' ),     10, 2 );
				add_action("{$taxname}_edit_form_fields",  array( & $this, 'update_term_link' ),  10, 2 );
				add_action("created_{$taxname}",           array( & $this, 'save_term_link' ),    10, 2 );
				add_action("edited_{$taxname}",            array( & $this, 'updated_term_link' ), 10, 2 );

				add_filter("manage_edit-{$taxname}_columns",  array( & $this, 'add_link_column' ) );
				add_filter("manage_{$taxname}_custom_column", array( & $this, 'fill_link_column' ), 10, 3 );
			}
		}

		## Add a form field in the new category page
		public function add_term_link( $taxonomy ){
			wp_enqueue_media(); // подключим стили медиа, если их нет

			add_action('admin_print_footer_scripts', array( & $this, 'add_script' ), 99 );
			?>
			<div class="form-field term-group">
				<label for="term_link">
					<?php _e('Link', 'hero-theme'); ?>
				</label>
				<input type="text" id="term_link" name="term_link" class="" value="">
				<div id="term__link__wrapper"></div>
			</div>
			<?php
		}

		## Edit the form field
		public function update_term_link( $term, $taxonomy ){
			wp_enqueue_media(); // подключим стили медиа, если их нет


			$link_id = get_term_meta( $term -> term_id, 'term_link', true );
			?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="term_link"><?php _e( 'Link', 'hero-theme' ); ?></label>
				</th>
				<td>
					<input type="text" id="term_link" name="term_link" value="<?php echo $link_id; ?>">
					<div id="term__link__wrapper">
					</div>
				</td>
			</tr>
			<?php
		}

		## Save the form field
		public function save_term_link( $term_id, $tt_id ){
			if( isset( $_POST['term_link'] ) && '' !== $_POST['term_link'] ){
				$link = $_POST['term_link'];
				add_term_meta( $term_id, 'term_link', $link, true );
			}
		}

		## Update the form field value
		public function updated_term_link( $term_id, $tt_id ){
			if( isset( $_POST['term_link'] ) && '' !== $_POST['term_link'] ){
				$link = $_POST['term_link'];
				update_term_meta( $term_id, 'term_link', $link );
			}
			else
				update_term_meta( $term_id, 'term_link', '' );
		}

		## Добавляет колонкку картинки в таблицу терминов
		public function add_link_column( $columns ){
			// подправим ширину колонки через css
			add_action('admin_notices', function(){
				echo '<style>.column-link{ width:60px; text-align:center; }</style>';
			});

			$num = 1; // после какой по счету колонки вставлять новые

			$new_columns = array( 'link'=>'Ссылка' );

			return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
		}

		public function fill_link_column( $string, $column_name, $term_id ){
			if ($column_name !== 'link') return $string;
			// если есть картинка
			if( $link_id = get_term_meta( $term_id, 'term_link', 1 ) ){
				$string = "<a href='$link_id'>Ссылка</a>";
			}

			return $string;
		}
	}

	new Banner_Meta_Link();
}
