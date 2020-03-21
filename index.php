<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo wp_get_document_title(); ?></title>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,400,700,900&display=swap&subset=cyrillic-ext" rel="stylesheet">
  <?php wp_head(); ?>
</head>
<body>
  <div style="display: none">
    <?php get_template_part('content/svg'); ?>
  </div>
  <div class="page">
    <?php get_header(); ?>

    <main class="page-main py-6">
      <div class="container">
        <?php get_template_part('content/content', 'loop'); ?>
      </div>
    </main>

    <?php get_footer(); ?>
  </div>

  <?php wp_footer(); ?>

</body>
</html>
