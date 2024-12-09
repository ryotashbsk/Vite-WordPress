<?php

const COMPRESS_HTML = 0;

const WP_CORE_AUTO_UPDATE = 1;

const WP_PLUGIN_AUTO_UPDATE = 1;

const CUSTOM_POST_TYPE = [
  ['type' => 'news', 'label' => 'お知らせ', 'rewrite_slug' => false, 'taxonomy' => false],
];

const GOOGLE_FONTS = 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap';

const TYPEKIT = '';

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
