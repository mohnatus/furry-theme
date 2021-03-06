<?php

class clean_comments_constructor extends Walker_Comment {
  public function start_lvl( &$output, $depth = 0, $args = array()) {
    $output .= '<ul class="children">' . "\n";
  }
  public function end_lvl( &$output, $depth = 0, $args = array()) {
    $output .= "</ul>\n";
  }

  // разметка каждого комментария, без закрывающего </li>!
  protected function comment( $comment, $depth, $args ) {
    $commentID = get_comment_ID();
    $commentClasses = 'comment';
    $isApproved = $comment->comment_approved != '0';
    if (!$isApproved) {
      $commentClasses .= ' not-approved';
    }

    $authorAvatarUrl = get_avatar_url($comment);
    $authorName = get_comment_author();
    $authorUrl = get_comment_author_url();
    if ($authorUrl) {
      $authorName = "<a href='$authorUrl'>$authorName</a>";
    }

    $commentDate = get_comment_date('j/m/Y, H:i');
    $commentDateTitle = get_comment_date('F j, Y в H:i');

    $commentText = get_comment_text();
    $commentReply = get_comment_reply_link(array_merge($args, [
      'depth' => $depth,
      'reply_text' => 'Ответить',
      'login_text' => 'Залогиньтесь, чтобы оставить комментарий'
    ]));
    $commentEdit = get_edit_comment_link($commentID);

    $commentFeedback = '';
    if (!$isApproved) {
      $commentFeedback = '<div class="color-inactive mb-4">
        Ваш комментарий будет опубликован после проверки модератором
      </div>';
    };

    echo "<li id='comment-$commentID' class='$commentClasses' itemprop='comment' itemscope itemtype='https://schema.org/Comment'>";
    ?>

      <?= $commentFeedback; ?>
      <div class="comment__meta comment-meta d-flex align-center mb-2">
        <div class="comment-meta__avatar mr-4">
          <img width="48" data-src="<?= $authorAvatarUrl ?>" alt="<?= $authorName ?>">
        </div>
        <div class="comment-meta__data">
          <div class="comment-meta__author mb-2 bold"><?= $authorName ?></div>
          <div class="comment-meta__date color-inactive" title="<?= $commentDateTitle ?>"><?= $commentDate ?></div>
        </div>
      </div>
      <div class="comment__content ugc my-4">
        <?= $commentText ?>
      </div>

      <?php if ($isApproved): ?>
        <div class="comment__actions">
          <?= $commentReply ?>
          <?php if ($commentEdit): ?>
            <a class="" href="<?= $commentEdit ?>">Редактировать</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>

    <?php
  }

  public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}

$commentsAllowedTags = [
  'a' => array(),
  'abbr' => array(),
  'blockquote' => array(),
  'code' => array(),
  'pre' => array(),
  'del' => array(),
  'i' => array(),
  'em' => array(),
  'strong' => array(),
  'b' => array(),
  'strike' => array()
];

/** Comments form */
function furry_comments_form() {
  global $commentsAllowedTags;

  if (!comments_open()) return false;

  $commenter = wp_get_current_commenter();
  $currentUser = wp_get_current_user();
  $currentUserName = $currentUser->display_name;

  $consent = !!$commenter['comment_author'];

  $allowedTagsList = array_keys($commentsAllowedTags);

  $fields =  array(
    'email' => '<div class="col col-12 col-lg-4">
      <div class="form-group"  data-required>
        <label for="email">Email <span class="color-inactive"></span></label>
        <input class="form-control" id="email" name="email" type="text" inputmode="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" value="'.esc_attr($commenter['comment_author_email']).'" required>
        <div class="form-message">*Не будет опубликован</div>
      </div>
    </div>',

    'author' => '<div class="col col-12 col-lg-4">
      <div class="form-group"  data-required>
        <label for="author">Имя</label>
        <input class="form-control" id="author" name="author" type="text" value="'.esc_attr($commenter['comment_author']).'" required>
      </div>
    </div>',

    'cookies' => '<div class="col col-12">
      <div class="checkbox">'.
       sprintf( '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />', $consent ).
       '
       <label for="wp-comment-cookies-consent">Сохранить мои данные</label>
      </div>
		</div>'
  );
  $args = array(
    'fields' => $fields,
    'comment_field' => '<div class="col col-12">
      <div class="form-group" data-required>
        <textarea class="form-control" id="comment" name="comment" rows="8" placeholder="Комментарий" required></textarea>
      </div>
    </div>',

    'must_log_in' => '<div class="mb-4 color-warning">
      Авторизуйтесь, чтобы оставлять комментарии'.
      wp_login_url(apply_filters('the_permalink',get_permalink())).
    '</div>',

    'logged_in_as' => '<div class="mb-4 col col-12 color-inactive">'.
      sprintf(
        __('Вы вошли как <a href="%1$s">%2$s</a>. <a href="%3$s">Выйти?</a>'),
        admin_url('profile.php'),
        $currentUserName,
        wp_logout_url(
          apply_filters('the_permalink',get_permalink())
        )
      ).
    '</div>',

    'comment_notes_before' => '',
    'comment_notes_after' => '<div class="col col-12 mb-6 color-inactive text-small">'.
      '*Доступные HTML-теги: '.
      implode(
        ', ',
        array_map(
          function($tag) { return "<code>$tag</code>"; }, $allowedTagsList
        )
      ).
    '</div>',

    'id_form' => 'comments-form',
    'class_form' => 'form comments-form mb-6 row',

    'title_reply' => 'Оставить комментарий',
    'title_reply_to' => 'Ответить %s',
    'title_reply_before' => '<h2 class="h3">',
    'title_reply_after' => '</h2>',

    'cancel_reply_link' => 'Отменить ответ',
    'cancel_reply_before' => '<span class="text-small ml-2">',
    'cancel_reply_after' => '</span>',

    'submit_button' => '<div class="col col-12 mt-4"><button type="submit" class="btn btn-primary">Отправить</button></div>'
  );

  comment_form($args);
}

add_action('wp_enqueue_scripts', 'furry_comment_scripts');
function furry_comment_scripts() {
	wp_enqueue_script(
    'comments-form',
    includes_url() . 'js/comment-reply.min.js',
    array(),
    null,
    'in_footer'
  );
}

add_filter('preprocess_comment','furry_sanitize_comment');
function furry_sanitize_comment($commentdata) {
  $commentdata['comment_content'] = wp_kses($commentdata['comment_content'], $commentsAllowedTags);
  return $commentdata;
}
