<?php

add_action('add_meta_boxes', 'furry_meta_boxes', 1);
add_action('save_post', 'furry_meta_update', 0);

$metaboxes = [
  'pagemeta' => 'Мета-данные статьи',
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

function furry_meta_box_update($metaBoxName, $postId) {
  if (!isset($_POST[$metaBoxName])) {
    return false;
  }

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
