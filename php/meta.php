<?php

add_action('add_meta_boxes', 'furry_meta_boxes', 1);
add_action('save_post', 'furry_meta_update', 0);

$metaboxes = [
  'source' => 'Оригинал статьи',
  'contentlist' => 'Блок Содержание статьи'
];

function furry_meta_boxes() {
  global $metaboxes;

  foreach($metaboxes as $key=>$title) {
    add_meta_box($key, $title, $key.'_meta_box', 'post', 'normal', 'high');
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
