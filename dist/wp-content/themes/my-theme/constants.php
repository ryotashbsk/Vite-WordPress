<?php

const COMPRESS_HTML = 1;

const WP_CORE_AUTO_UPDATE = true;

const WP_PLUGIN_AUTO_UPDATE = true;

const ADMIN_POST_MENU_LABEL = '';

const ADMIN_PAGE_MENU_LABEL = '固定ページ';

const CUSTOM_POST_TYPE = [
  ['type' => 'news', 'label' => 'お知らせ', 'rewrite_slug' => false, 'taxonomy' => false],
];

const ARCHIVE_PER_PAGE = 6;

const NAV_ITEMS = [
  [
    'label' => 'home',
    'link'  => '/'
  ],
  [
    'label' => 'news',
    'link'  => '/news/'
  ],
];
