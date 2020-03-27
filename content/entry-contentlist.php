<?php
  if (get_post_meta( $post->ID, 'contentlist_need', true)) {
    $isOneLevel = get_post_meta( $post->ID, 'contentlist_one_level', true);
    ?>
      <div class="contentlist" <?= $isOneLevel ? "data-root" : "" ?>></div>
    <?php
  }
?>
