<?php
add_filter('acf/settings/rest_api_format', function () {
    return 'standard';
});


/**
 * rest apiのuser一覧を非表示
 */
function disable_rest_api_default_query()
{
    if (preg_match('/wp\/v2\/users/i', $_SERVER['REQUEST_URI']) || preg_match('/wp\/v2\/users/i', $_SERVER['QUERY_STRING'])) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
  
    $endpoint = '/wp-json/wp/v2';
    if ($_SERVER['REQUEST_URI'] === $endpoint || $_SERVER['REQUEST_URI'] === $endpoint . '/') {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
}
add_action('init', 'disable_rest_api_default_query');


/**
 * WP REST Cache Pluginの有効化
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';
if (is_plugin_active('wp-rest-cache/wp-rest-cache.php')) {
    include_once WP_PLUGIN_DIR . '/wp-rest-cache/wp-rest-cache.php';
    $wp_rest_cache_api = new \WP_Rest_Cache_Plugin\Includes\API\Endpoint_Api();
    $wp_rest_cache_api->get_api_cache();
}
