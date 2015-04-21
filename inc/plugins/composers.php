<?php
if (!function_exists('declaringglory_create_composers')) {
    function declaringglory_create_composers() {
        $slug = get_theme_mod('event_permalink');
        $slug = empty($slug) ? 'composer' : $slug;

        register_post_type('composer', array(
            'label' => __('composers', 'declaringglory'),
            'description' => __('Composers with whom I have worked', 'declaringglory'),
            'labels' => array(
                'name' => __('Composers', 'declaringglory'),
                'singular_name' => __('Composer', 'declaringglory'),
                'menu_name' => __('Composers', 'declaringglory'),
                'all_items' => __('All Composers', 'declaringglory'),
                'view_item' => __('View Composer', 'declaringglory'),
                'add_new_item' => __('Add New Composer', 'declaringglory'),
                'add_new' => __('Add New', 'declaringglory'),
                'edit_item' => __('Edit Composer', 'declaringglory'),
                'update_item' => __('Update Composer', 'declaringglory'),
                'search_items' => __('Search Composers', 'declaringglory'),
                'not_found' => __('Not Found', 'declaringglory'),
                'not_found_in_trash' => __('Not Found in Trash', 'declaringglory')
            ),

            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies' => array('composers'),
            'rewrite' => array('slug' => $slug),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post'
        ));
    }
}
add_action('init', 'declaringglory_create_composers', 0);

if (!function_exists('declaringglory_composers_table_head')) {
    function declaringglory_composers_table_head($defaults) {
        $columns = array();
        foreach ($defaults as $k => $v) {
            if ($k == 'title') {
                $columns['portrait'] = '<div class="composer-header composer-portrait">' . __('Portrait') . '</div>';
                $columns[$k] = '<div class="composer-header composer-name">' . __('Name') . '</div>';
                $columns['about'] = '<div class="composer-header composer-about">' . __('About') . '</div>';
            } elseif ($k == 'date') {
                $columns['author'] = '<div class="composer-header composer-added">' . __('Added By') . '</div>';
                $columns[$k] = $v;
            } else {
                $columns[$k] = $v;
            }
        }
        return $columns;
    }
}
add_filter('manage_composer_posts_columns', 'declaringglory_composers_table_head');

if (!function_exists('declaringglory_composers_table_content')) {
    function declaringglory_composers_table_content($column_name, $post_id) {
        if ($column_name == 'portrait') {
            echo get_the_post_thumbnail($post_id, 'composer-thumb-small');
        } elseif ($column_name == 'about') {
            echo get_the_content($post_id);
        }
    }
}
add_action('manage_composer_posts_custom_column', 'declaringglory_composers_table_content', 10, 2);
