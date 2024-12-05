<?php

/**
 * 投稿メニューのラベル変更
 */
$post_label = ADMIN_POST_MENU_LABEL;
if (!empty($post_label)) {
    add_filter('post_type_labels_post', function ($labels) use ($post_label) {
        foreach ($labels as $key => $value) {
            $labels->$key = str_replace('投稿', $post_label, $value);
        }
        return $labels;
    });
}


/**
 * 固定ページメニューのラベル変更
 */
$page_label = ADMIN_PAGE_MENU_LABEL;
if (!empty($page_label)) {
    add_filter('post_type_labels_page', function ($labels) use ($page_label) {
        foreach ($labels as $key => $value) {
            $labels->$key = str_replace('固定ページ', $page_label, $value);
        }
        return $labels;
    });
}


/**
 * タグ機能の無効化
 */
// add_action('init', function () {
//     global $wp_taxonomies;
//     if (!empty($wp_taxonomies['post_tag']->object_type)) {
//         foreach ($wp_taxonomies['post_tag']->object_type as $i => $object_type) {
//             if ($object_type == 'post') {
//                 unset($wp_taxonomies['post_tag']->object_type[$i]);
//             }
//         }
//     }
//     return true;
// });


/**
 * 非表示にする管理メニューの指定
 */
add_action('admin_menu', function () {
    $user = wp_get_current_user();
    if (!current_user_can('administrator')) {
        remove_menu_page('edit.php?post_type=acf-field-group');
        remove_menu_page('tools.php');
        remove_menu_page('profile.php');
        remove_menu_page('users.php');
        remove_menu_page('plugins.php');
        remove_menu_page('themes.php');
        remove_menu_page('customtaxorder');
    }
    // remove_menu_page('edit.php');
    // remove_menu_page('link-manager.php');
    remove_menu_page('edit-comments.php');
});


/**
 * ダッシュボードウィジェットの無効化
 */
add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
});


/**
 * 「WordPressへようこそ」の削除
 */
add_filter('admin_footer_text', function () {
    echo '&nbsp;';
});


/**
 * 管理画面上部バーのデフォルト項目の非表示
 */
add_action('admin_bar_menu', function ($wp_admin_bar) {
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('search');
}, 9999);


/**
 * 投稿一覧から任意の項目を非表示
 */
add_filter('manage_posts_columns', function ($columns) {
    unset($columns['author']);
    unset($columns['comments']);
    return $columns;
});


/**
 * 固定ページ一覧から任意の項目を非表示
 */
add_action('manage_pages_columns', function ($columns) {
    unset($columns['author']);
    unset($columns['comments']);
    return $columns;
});


/**
 * 編集者権限での外観の操作を有効化
 */
add_action('admin_init', function () {
    $role = get_role('editor');
    $role->add_cap('edit_theme_options');
});


/**
 * ダッシュボードトップページをリダイレクト
 */
add_action('admin_init', function () {
    if ('/wp-admin/index.php' === $_SERVER['SCRIPT_NAME']) {
        wp_redirect(admin_url('edit.php?post_type=page'));
    }
});


/**
 * ログインページ用CSS
 */
add_action('login_head', function () {
    wp_enqueue_style('style', get_theme_file_uri() . '/admin/css/login.css', [], time(), 'all');
});


/**
 * 管理画面用CSS
 */
add_action('admin_print_styles', function () {
    wp_enqueue_style('style', get_theme_file_uri() . '/admin/css/admin.css', [], time(), 'all');
    wp_enqueue_script('script', get_theme_file_uri() . '/admin/js/admin.js', [], time(), true);
});


// categoryの階層
add_action('wp_terms_checklist_args', function ($args, $post_id) {
    if ($args['checked_ontop'] !== false) {
        $args['checked_ontop'] = false;
    }
    return $args;
}, 10, 2);


/**
 * 投稿画面にタグ一覧を表示しチェックボックス選択式にする
 */
add_action('init', function () {
    $tag_slug_args = get_taxonomy('post_tag');
    $tag_slug_args->hierarchical = true;
    $tag_slug_args->meta_box_cb = 'post_categories_meta_box';
    register_taxonomy('post_tag', 'post', (array) $tag_slug_args);
}, 1);
