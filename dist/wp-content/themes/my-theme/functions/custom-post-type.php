<?php

/**
 * Register custom post type.
 */
function register_cpt($cpt, $label, $rewrite_slug, $taxonomy)
{
    $args = [
    'labels' => [
      'name' => __($label),
      'singular_name' => __($label),
      'edit_item'     => __($label . 'の編集'),
      'add_new_item'  => __($label . 'の新規作成')
    ],
    'public'               => true,
    'show_ui'              => true,
    'show_in_menu'         => true,
    'has_archive'          => true,
    'show_in_rest'         => true,
    'menu_position'        => 5,
    'exclude_from_search'  => true,
    'query_var'            => true,
    'supports'             => ['title','thumbnail'],
    // 'capability_type'      => $cpt,
    // 'map_meta_cap'         => true,
    'rewrite'              => ['slug' => $rewrite_slug, 'with_front' => true]
  ];
    register_post_type($cpt, $args);

    if ($taxonomy) {
        register_taxonomy(
            $cpt . '-category',
            $cpt,
            [
              'hierarchical' => true,
              'update_count_callback' => '_update_post_term_count',
              'label' => 'カテゴリー',
              'public' => true,
              'show_ui' => true,
              'show_admin_column' => true,
            ]
        );
    }
}

if (defined('CUSTOM_POST_TYPE')) {
    add_action('init', function () {
        foreach (CUSTOM_POST_TYPE as $data) {
            register_cpt($data['type'], $data['label'], $data['rewrite_slug'], $data['taxonomy']);
        }
    });
}

/**
 * Enable revision in custom post type
 */
add_action('init', function () {
    foreach (CUSTOM_POST_TYPE as $data) {
        add_post_type_support($data['type'], 'revisions');
    }
});
