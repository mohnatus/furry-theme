<?php
  $source = [
    'link' => get_post_meta( $post->ID, 'source_link', true ),
    'title' => get_post_meta( $post->ID, 'source_title', true ),
    'author' => get_post_meta( $post->ID, 'source_author', true ),
    'author_link' => get_post_meta( $post->ID, 'source_author_link', true ),
  ];

  if ($source['link']) {

    $author = "";
    if ($source['author']) {
      if ($source['author_link']) {
        $author = ", by <a class='source__author' href='".$source['author_link']."' target='_blank' rel='noopener noreferrer nofollow'>".$source['author']."</a>";
      } else {
        $author = ", by <span class='source__author'>".$source['author']."</span>";
      }
    }
    $sourceBlock = "<div class='source'>
      Оригинал:
      <a href='".$source['link']."' target='_blank' rel='noopener noreferrer nofollow'>".
        ($source['title'] ? $source['title'] : $source['link'])
      ."</a>".
      $author.
    "</div>";
    echo $sourceBlock;
  }

?>
