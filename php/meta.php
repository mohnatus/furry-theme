<?php

add_action('add_meta_boxes', 'furry_meta_boxes', 1);
add_action('save_post', 'furry_meta_update', 0);

$metaboxes = [
  'source' => 'Оригинал статьи',
  'contentlist' => 'Блок Содержание статьи',
  'pagemeta' => 'Мета-данные статьи',
  'postwidget' => 'Виджет в сайдбаре'
];

function furry_meta_boxes() {
  global $metaboxes;

  foreach($metaboxes as $key=>$title) {
    add_meta_box($key, $title, $key.'_meta_box', array('post', 'page'), 'normal', 'high');
  }
}

function furry_meta_update($postId) {
  global $metaboxes;

  foreach($metaboxes as $key=>$title) {
    furry_meta_box_update($key, $postId);
  }
}

function source_meta_box($post) {
  $postId = $post->ID;
  $sourceLink = get_post_meta($postId, 'source_link', 1);
  $sourceTitle = get_post_meta($postId, 'source_title', 1);
  $sourceAuthor = get_post_meta($postId, 'source_author', 1);
  $sourceAuthorlink = get_post_meta($postId, 'source_author_link', 1);
  ?>

    <div class="form-group" style="margin: 20px 0">
      <label for="source-link">Ссылка на оригинал</label>
      <br>
      <input type="text" id="source-link" name="source[link]" value="<?= $sourceLink ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="source-title">Название оригинала</label>
      <br>
      <input type="text" id="source-title" name="source[title]" value="<?= $sourceTitle ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="source-author">Автор оригинала</label>
      <br>
      <input type="text" id="source-author" name="source[author]" value="<?= $sourceAuthor ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="source-authorlink">Ссылка на профиль автора</label>
      <br>
      <input type="text" id="source-authorlink" name="source[author_link]" value="<?= $sourceAuthorlink ?>" style="width: 100%">
    </div>

    <input type="hidden" name="source_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
  <?php
}

function contentlist_meta_box($post) {
  $postId = $post->ID;
  $needContentlist = get_post_meta($postId, 'contentlist_need', 1);
  $oneLevelContentlist = get_post_meta($postId, 'contentlist_one_level', 1);
  ?>
    <div class="form-group" style="margin: 20px 0">
      <input type="hidden" name="contentlist[need]" value="" />
      <input type="checkbox" name="contentlist[need]" value="1"
        id="contentlist-need"
        <?php checked($needContentlist, 1)?> />
      <label for="contentlist-need">Создать блок Содержание статьи</label>
    </div>

    <div class="form-group" style="margin: 20px 0">
      <input type="hidden" name="contentlist[one_level]" value="" />
      <input type="checkbox" name="contentlist[one_level]" value="1"
        id="contentlist-onelevel"
        <?php checked($oneLevelContentlist, 1)?> />
      <label for="contentlist-onelevel">Вывести только первый уровень заголовков</label>
    </div>

    <input type="hidden" name="contentlist_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
  <?php
}

function pagemeta_meta_box($post) {
  $postId = $post->ID;
  $metaTitle = get_post_meta($postId, 'pagemeta_title', 1);
  $metaDescription = get_post_meta($postId, 'pagemeta_description', 1);
  $metaKeywords = get_post_meta($postId, 'pagemeta_keywords', 1);
  ?>

    <div class="form-group" style="margin: 20px 0">
      <label for="pagemeta-title">Title</label>
      <br>
      <input type="text" id="pagemeta-title" name="pagemeta[title]" value="<?= $metaTitle ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="pagemeta-description">Description</label>
      <br>
      <input type="text" id="pagemeta-description" name="pagemeta[description]" value="<?= $metaDescription ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="pagemeta-keywords">Keywords</label>
      <br>
      <input type="text" id="pagemeta-keywords" name="pagemeta[keywords]" value="<?= $metaKeywords ?>" style="width: 100%">
    </div>


    <input type="hidden" name="pagemeta_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
  <?php
}

function postwidget_meta_box($post) {
  $postId = $post->ID;
  $postwidgetVisible = get_post_meta($postId, 'postwidget_visible', 1);
  $postwidgetTitle = get_post_meta($postId, 'postwidget_title', 1);
  $postwidgetDescription = get_post_meta($postId, 'postwidget_description', 1);
  $postwidgetLink = get_post_meta($postId, 'postwidget_link', 1);
  $postwidgetImage = get_post_meta($postId, 'postwidget_image', 1);
  $postwidgetClasses = get_post_meta($postId, 'postwidget_classes', 1);
  ?>
    <div class="form-group" style="margin: 20px 0">
      <input type="hidden" name="postwidget[visible]" value="" />
      <input type="checkbox" name="postwidget[visible]" value="1"
        id="postwidget-visible"
        <?php checked($postwidgetVisible, 1)?> />
      <label for="postwidget-visible">Показать виджет в сайдбаре</label>
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="postwidget-title">Заголовок</label>
      <br>
      <input type="text" id="postwidget-title" name="postwidget[title]" value="<?= $postwidgetTitle ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="postwidget-description">Описание</label>
      <br>
      <input type="text" id="postwidget-description" name="postwidget[description]" value="<?= $postwidgetDescription ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="postwidget-link">Ссылка</label>
      <br>
      <input type="text" id="postwidget-link" name="postwidget[link]" value="<?= $postwidgetLink ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="postwidget-image">Изображение</label>
      <br>
      <input type="text" id="postwidget-image" name="postwidget[image]" value="<?= $postwidgetImage ?>" style="width: 100%">
    </div>

    <div class="form-group" style="margin: 20px 0">
      <label for="postwidget-classes">Классы для блока</label>
      <br>
      <input type="text" id="postwidget-classes" name="postwidget[classes]" value="<?= $postwidgetClasses ?>" style="width: 100%">
    </div>

    <input type="hidden" name="postwidget_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
  <?php
}

function furry_meta_box_update($metaBoxName, $postId) {
  $metaBox = $_POST[$metaBoxName];
  if (
    empty($metaBox)
    || ! wp_verify_nonce($_POST[$metaBoxName.'_nonce'], __FILE__)
    || wp_is_post_autosave($postId )
    || wp_is_post_revision($postId )
  )
  return false;

  $metaBox = array_map(
    'sanitize_text_field',
    $metaBox
  );

  foreach($metaBox as $key=>$value) {
    $metaKey = $metaBoxName.'_'.$key;

    if(empty($value)){
      delete_post_meta( $postId, $metaKey );
      continue;
    }

    update_post_meta( $postId, $metaKey, $value );
  }

  return $postId;
}
