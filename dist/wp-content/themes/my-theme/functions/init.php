<?php

/**
 *　自動アップデートの設定
 */
if (WP_CORE_AUTO_UPDATE !== false) {
    add_filter('allow_major_auto_core_updates', '__return_true');
}
if (WP_PLUGIN_AUTO_UPDATE !== false) {
    add_filter('auto_update_plugin', '__return_true');
}


/**
 * WP各種デフォルト機能の無効化
 */
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('welcome_panel', 'wp_welcome_panel');
remove_filter('pre_user_description', 'wp_filter_kses');
remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result');
add_theme_support('menus');
add_filter('wp_calculate_image_srcset', '__return_false');
add_filter('wp_sitemaps_enabled', '__return_false');
add_filter('show_admin_bar', '__return_false');


/**
 * global-styles-inline-cssの無効化
 */
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('global-styles');
});


/**
 * editor-style.cssの有効化
 */
add_editor_style('editor-style.css');


/**
 * コメント機能の無効化
 */
add_filter('comments_open', '__return_false');


/**
 * dns-prefetchの無効化
 */
add_filter('wp_resource_hints', function ($hints, $relation_type) {
    if ('dns-prefetch' === $relation_type) {
        return array_diff(wp_dependencies_unique_hosts(), $hints);
    }
    return $hints;
}, 10, 2);


/**
 * pinbackの無効化
 */
add_filter('wp_headers', function ($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});


/**
 * /?author=XXXの無効化
 */
add_action('init', function () {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
    $wp_rewrite->author_base = '';
    $wp_rewrite->author_structure = '/';

    if (isset($_REQUEST['author']) && !empty($_REQUEST['author'])) {
        $user_info = get_userdata(intval($_REQUEST['author']));
        if ($user_info && array_key_exists('administrator', $user_info->caps) && in_array('administrator', $user_info->roles)) {
            wp_redirect('/');
            exit;
        }
    }
});


/**
 * pre_get_posts設定
 */
add_action('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_post_type_archive('news')) {
        $query->set('posts_per_page', ARCHIVE_PER_PAGE);
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }
});


/**
 * wp_ksesで任意のタグを許可
 */
add_filter('wp_kses_allowed_html', function ($tags, $context) {
    $tags['iframe'] = [
      'src'             => true,
      'height'          => true,
      'width'           => true,
      'frameborder'     => true,
      'allowfullscreen' => true,
      'style'           => true,
      'loading'         => true,
      'referrerpolicy'  => true
    ];
    return $tags;
}, 10, 2);
