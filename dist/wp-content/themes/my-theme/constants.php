<?php

const COMPRESS_HTML = 0;

const WP_CORE_AUTO_UPDATE = true;

const WP_PLUGIN_AUTO_UPDATE = true;

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
