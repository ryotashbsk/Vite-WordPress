<?php

// title
add_theme_support('title-tag');


add_action('wp_head', function () {
    // base
    global $post;
    $title = wp_get_document_title();
    $title = strip_tags($title);
    $title = str_replace(PHP_EOL, '', $title);
    $title = esc_html($title);
    $site_name = get_bloginfo('name');
    $description = get_field('meta_description') ? get_field('meta_description'): get_bloginfo('description');
    $excerpt = '';
  
    if (is_single()) {
        $contents = get_field('contents');
        if ($contents) {
            foreach ($contents as $content) {
                if ($content['acf_fc_layout'] === 'layout_text') {
                    $excerpt = $content['text'];
                }
            }
            $excerpt = str_replace(array("\r\n","\r","\n","&nbsp;"), '', $excerpt);
            $excerpt = wp_strip_all_tags($excerpt);
            $excerpt = preg_replace('/\[.*\]/', '', $excerpt);
            $excerpt = mb_strimwidth($excerpt, 0, 220, "...");
            $description = $excerpt;
        }
    }
    
    // canonical
    $canonical = (is_ssl() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo sprintf('<link rel="canonical" href="%s">', esc_url($canonical)) . "\n";

    
    // og
    if (is_single()) {
        $type = 'article';
    } else {
        $type = 'website';
    }

  
    if (is_single() && get_the_post_thumbnail_url()) {
        $image = esc_url(get_the_post_thumbnail_url());
    } else {
        $image = esc_url(get_theme_file_uri() . '/assets/images/og.png');
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
    ['<meta name="description" content="%s">', esc_attr($description)],
    ['<meta name="twitter:card" content="%s">', esc_attr($twitter_card)],
    ['<meta property="og:title" content="%s">', esc_attr($title)],
    ['<meta property="og:type" content="%s">', esc_attr($type)],
    ['<meta property="og:image" content="%s">', esc_url($image)],
    ['<meta property="og:url" content="%s">', esc_url($url)],
    ['<meta property="og:description" content="%s">', esc_attr($description)],
    ['<meta property="og:site_name" content="%s">', esc_attr($site_name)],
    ['<meta property="og:locale" content="%s">', 'ja_JP'],
  ]
    as list($format, $value)) {
        echo sprintf($format, $value) . "\n";
    }

    // resources
    $manifest = vite_manifest();
    echo sprintf(
        '<link rel="icon" href="%s" type="image/x-icon">',
        esc_url(get_theme_file_uri() . '/assets/images/favicon/favicon.ico')
    ) . "\n";

    echo sprintf(
        '<link rel="apple-touch-icon" href="%s" sizes="180x180">',
        esc_url(get_theme_file_uri() . '/assets/images/favicon/apple-touch-icon.png')
    ) . "\n";

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
        esc_url('https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap')
    ) . "\n";
  
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
            'http://localhost:3000/src/scripts/main.js'
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
    
    if($post) {
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
    $json = get_theme_file_path('/assets/build/manifest.json');
    if(file_exists($json)) {
        return json_decode(
            file_get_contents($json),
            true
        );
    }
}
