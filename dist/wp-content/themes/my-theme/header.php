<?php if (defined('COMPRESS_HTML') && COMPRESS_HTML) {
    ob_start('compress_output');
} ?><!DOCTYPE html>

<?php
$current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$isEN = strpos($current_path, '/en/') === 0;
?>

<html lang="<?= $isEN ? 'en' : 'ja'; ?>" data-route="<?php data_route(); ?>">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta http-equiv="content-language" content="<?= get_locale(); ?>">
<meta http-equiv="x-dns-prefetch-control" content="on">
<meta name="format-detection" content="telephone=no">
<meta name="theme-color" content="#fff">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?= get_bloginfo('name'); ?>">
<?php wp_head(); ?>
</head>

<body class="preload" id="top">
	<header class="header">
    <nav class="header-nav">
      <ul class="header-nav-list">
      <?php foreach (NAV_ITEMS as $nav_item): ?>
        <li class="header-nav-list-item">
          <a class="header-nav-item" href="<?= esc_url($nav_item['link']); ?>">
            <?= esc_html($nav_item['label']); ?>
          </a>
        </li>
      <?php endforeach; ?>
      </ul>
    </nav>
	</header>

	<main class="main">
    