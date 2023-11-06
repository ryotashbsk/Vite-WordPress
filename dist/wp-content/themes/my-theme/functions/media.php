<?php

/**
 * サムネイルサイズ
 */
add_theme_support('post-thumbnails');
add_filter('jpeg_quality', function ($arg) {
    return 100;
});


/**
 * デフォルトのサムネイルサイズの無効化
 */

add_filter('intermediate_image_sizes_advanced', function ($new_sizes) {
    unset($new_sizes['thumbnail']);
    unset($new_sizes['medium']);
    unset($new_sizes['large']);
    unset($new_sizes['medium_large']);
    unset($new_sizes['1536x1536']);
    unset($new_sizes['2048x2048']);
    return $new_sizes;
});
add_filter('big_image_size_threshold', '__return_false');
