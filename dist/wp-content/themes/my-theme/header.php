<!DOCTYPE html>
<?php if (!DEBUG) {
    ob_start('compress_output');
} ?>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta http-equiv="content-language" content="<?php echo get_locale(); ?>">
<meta http-equiv="x-dns-prefetch-control" content="on">
<meta name="format-detection" content="telephone=no">
<meta name="theme-color" content="#fff">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php echo get_bloginfo('name'); ?>">

<?php wp_head(); ?>
</head>

<body class="preload" id="top">
	<header class="header">
    <nav class="header-nav">
      <?php foreach (NAV_ITEMS as $nav_item): ?>
          <a class="header-nav-item" href="<?php echo esc_url($nav_item['link']); ?>">
            <?php echo esc_html($nav_item['label']); ?>
          </a>
      <?php endforeach; ?>
    </nav>
	</header>

	<div data-barba="wrapper" class="wrapper">
		<div 
      class="app"
      data-barba="container"
      data-barba-namespace="<?php data_route(); ?>"
      data-route="<?php data_route(); ?>"
    >
    