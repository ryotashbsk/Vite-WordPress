<?php
/**
 * ソース圧縮
 */
function compress_output($buffer)
{
    $search = ['/\>[^\S]+/s', '/[^\S]+\</s', '/(\s)+/s', '/<!--[\s\S]*?-->/s', '/<!--▲[\s\S]*?▲-->/s'];
    $replace = ['>', '<', '\\1', ''];
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}


/**
 * 子ページの存在チェック
 */
function is_parent_slug($parent_slug)
{
    global $post;
    if ($post->post_parent) {
        $post_data = get_post($post->post_parent);
        return $parent_slug == $post_data->post_name;
    }
}


/**
 * data-route
 */
function data_route()
{
    $data_route = '';
    global $post;
    $page_template = get_page_template_slug($post->ID);
    
    if (is_front_page()) {
        $data_route = 'home';
    } elseif (is_page()) {
        $data_route = $post->post_name;
    } elseif (is_archive()) {
        $data_route = 'archive';
    } elseif (is_single()) {
        $data_route = 'single';
    } elseif (is_search()) {
        $data_route = 'search';
    } elseif (is_404()) {
        $data_route = 'notfound';
    } else {
        $data_route = '';
    }
  
    echo esc_attr($data_route);
}


/**
 * 画像パス
 */
function img($path)
{
    echo esc_url(get_theme_file_uri() . '/assets/images/' . $path);
}
function get_img($path)
{
    return esc_url(get_theme_file_uri() . '/assets/images/' . $path);
}
function svg($path)
{
    include esc_url(get_theme_file_path() . '/assets/images/' . $path);
}
