<?php

// title
add_theme_support('title-tag');

add_filter('pre_get_document_title', function ($title) {
    global $post;
    $current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $isEN = strpos($current_path, '/en/') === 0;

    if ($isEN) {
        // /en/のタイトルをsite_nameとして利用
        $en_page = get_page_by_path('en', OBJECT, 'page');
        $site_name = get_field('title', $en_page->ID) ?? get_bloginfo('name');

        if (is_singular('news-en')) {
            return get_the_title() .  ' | ' .  'Works' . '｜' . $site_name;
        } elseif (is_archive('news-en')) {
            return 'News' . '｜' . $site_name;
        } elseif (is_page()) {
            return str_replace('(en)', '', get_the_title()) .  ' | ' .  $site_name;
        }
    }
    
    if (is_page() && get_field('title')) {
        return esc_html(get_field('title'));
    }

    // それ以外はデフォルトのタイトルを使用
    return $title;
});



add_action('wp_head', function () {
    // base
    global $post, $wp;
    $current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $isEN = strpos($current_path, '/en/') === 0;

    // title
    $title = wp_get_document_title();
    $title = strip_tags($title);
    $title = str_replace(PHP_EOL, '', $title);
    $title = esc_html($title);
    $title = str_replace('(en)', '', $title);
    
    // description
    $description = get_field('description') ? get_field('description'): get_bloginfo('description');
    
    // canonical
    $canonical = (is_ssl() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo sprintf('<link rel="canonical" href="%s">', esc_url($canonical)) . "\n";

    // site_name
    if ($isEN) {
        $en_page = get_page_by_path('en', OBJECT, 'page');
        
        $title = get_field('title', $en_page->ID) ?? get_bloginfo('name');
        
        // /en/の説明文をdescriptionとして利用
        $description = get_field('description', $en_page->ID) ? get_field('description', $en_page->ID): get_bloginfo('description');
        
        // /en/のタイトルをsite_nameとして利用
        $site_name = $title;
        
    } else {
        $site_name = get_bloginfo('name');
    }
    
    
    // og
    if (is_single()) {
        $type = 'article';
    } else {
        $type = 'website';
    }

  
    if (is_single() && get_the_post_thumbnail_url()) {
        $image = esc_url(get_the_post_thumbnail_url());
    } else {
        $image = esc_url(get_theme_file_uri() . '/assets/img/ogp.png');
    }

    if (is_home()) {
        $url = home_url('/');
    } elseif (is_singular()) {
        $url = get_permalink();
    } else {
        $url = '';
    }

    $twitter_card = 'summary_large_image';

    foreach ([
    ['<meta name="theme-color" content="%s">', esc_attr('#000')],
    ['<meta name="mobile-web-app-capable" content="%s">', 'yes'],
    ['<meta name="apple-mobile-web-app-capable" content="%s">', 'yes'],
    ['<meta name="apple-mobile-web-app-title" content="%s">', esc_attr($site_name)],
    ['<meta name="description" content="%s">', esc_attr($description)],
    ['<meta name="twitter:card" content="%s">', esc_attr($twitter_card)],
    ['<meta property="og:title" content="%s">', esc_attr($title)],
    ['<meta property="og:type" content="%s">', esc_attr($type)],
    ['<meta property="og:image" content="%s">', esc_url($image)],
    ['<meta property="og:url" content="%s">', esc_url($url)],
    ['<meta property="og:description" content="%s">', esc_attr($description)],
    ['<meta property="og:site_name" content="%s">', esc_attr($site_name)],
    ['<meta property="og:locale" content="%s">', 'ja_JP'],
  ] as list($format, $value)) {
        echo sprintf($format, $value) . "\n";
    }

    // resources
    $manifest = vite_manifest();
    echo sprintf(
        '<link rel="icon" href="%s">',
        esc_url(get_theme_file_uri() . '/assets/img/favicon/favicon.ico')
    ) . "\n";

    echo sprintf(
        '<link rel="apple-touch-icon" href="%s" sizes="180x180">',
        esc_url(get_theme_file_uri() . '/assets/img/favicon/apple-touch-icon.png')
    ) . "\n";

    echo sprintf(
        '<link rel="apple-touch-icon" href="%s" sizes="32x32">',
        esc_url(get_theme_file_uri() . '/assets/img/favicon/favicon-16x16.pngg')
    ) . "\n";

    echo sprintf(
        '<link rel="apple-touch-icon" href="%s" sizes="16x16">',
        esc_url(get_theme_file_uri() . '/assets/img/favicon/favicon-32x32.png')
    ) . "\n";

    if (defined('GOOGLE_FONTS') && GOOGLE_FONTS) {
        echo sprintf(
            '<link rel="preconnect" href="%s">',
            esc_url('https://fonts.googleapis.com')
        ) . "\n";
    
        echo sprintf(
            '<link rel="preconnect" href="%s" crossorigin>',
            esc_url('https://fonts.gstatic.com')
        ) . "\n";
    
        echo sprintf(
            '<link rel="stylesheet" href="%s">',
            esc_url(GOOGLE_FONTS)
        ) . "\n";
    }
    
    if (defined('TYPEKIT') && TYPEKIT) {
        echo sprintf(
            '<link rel="stylesheet" href="%s">',
            esc_url(TYPEKIT)
        ) . "\n";
    }
  
    if (isset($manifest['src/scripts/main.js'])) {
        echo sprintf(
            '<link rel="stylesheet" href="%s">',
            esc_url(get_theme_file_uri() . '/assets/build/' . $manifest['src/scripts/main.js']['css'][0])
        ) . "\n";
    
        echo sprintf(
            '<script type="module" src="%s"></script>',
            esc_url(get_theme_file_uri() . '/assets/build/' . $manifest['src/scripts/main.js']['file'])
        ) . "\n";
    } else {
        echo sprintf(
            '<script type="module" src="%s"></script>',
            'http://localhost:5173/src/scripts/main.js'
        ) . "\n";
    }
});


add_filter('document_title_parts', function ($title) {
    if (isset($title['tagline'])) {
        unset($title['tagline']);
    }
    return str_replace(PHP_EOL, '', $title);
});

add_filter('document_title_separator', function () {
    global $post;
    
    if ($post) {
        $post_type = $post->post_type;

        if (is_singular($post_type) && !is_page()) {
            $title = '｜ ' . get_post_type_object($post_type)->label . ' ｜';
        } else {
            $title = '｜';
        }
        return $title;
    }
});

function vite_manifest()
{
    $json = get_theme_file_path('/assets/build/.vite/manifest.json');
    if (file_exists($json)) {
        return json_decode(
            file_get_contents($json),
            true
        );
    }
}
