<?php
  $siteName = get_bloginfo('name');
  $separator = ' | ';
  $pageTitle = $siteName;
  $pageDescription = get_bloginfo('description');
  $pageKeywords = '';
?>

<title><?= $pageTitle ?></title>
<meta name="description" content="<?= $pageDescription ?>">
<meta name="keywords" content="<?= $pageKeywords ?>">
