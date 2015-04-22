<?php
if (!function_exists('declaringglory_create_authors')) {
    function declaringglory_create_authors() {
        $slug = get_theme_mod('event_permalink');
        $slug = empty($slug) ? 'author' : $slug;

        register_post_type('author', array(
            'label' => __('authors', 'declaringglory'),
            'description' => __('Authors whose work is represented on this site', 'declaringglory'),
            'labels' => array(
                'name' => __('Authors', 'declaringglory'),
                'singular_name' => __('Authors', 'declaringglory'),
                'menu_name' => __('Authors', 'declaringglory'),
                'all_items' => __('All Authors', 'declaringglory'),
                'view_item' => __('View Authors', 'declaringglory'),
                'add_new_item' => __('Add New Author', 'declaringglory'),
                'add_new' => __('Add New', 'declaringglory'),
                'edit_item' => __('Edit Author', 'declaringglory'),
                'update_item' => __('Update Author', 'declaringglory'),
                'search_items' => __('Search Author', 'declaringglory'),
                'not_found' => __('Not Found', 'declaringglory'),
                'not_found_in_trash' => __('Not Found in Trash', 'declaringglory')
            ),

            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'taxonomies' => array('authors'),
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
add_action('init', 'declaringglory_create_authors', 0);

if (!function_exists('declaringglory_authors_table_head')) {
    function declaringglory_authors_table_head($defaults) {
        $columns = array();
        foreach ($defaults as $k => $v) {
            if ($k == 'title') {
                $columns['portrait'] = '<div class="author-header author-portrait">' . __('Portrait') . '</div>';
                $columns[$k] = '<div class="author-header author-name">' . __('Name') . '</div>';
            } elseif ($k == 'date') {
                $columns['author'] = '<div class="author-header author-added">' . __('Added By') . '</div>';
                $columns[$k] = $v;
            } else {
                $columns[$k] = $v;
            }
        }
        return $columns;
    }
}
add_filter('manage_author_posts_columns', 'declaringglory_authors_table_head');

if (!function_exists('declaringglory_authors_table_content')) {
    function declaringglory_authors_table_content($column_name, $post_id) {
        if ($column_name == 'portrait') {
            echo get_the_post_thumbnail($post_id, 'author-thumb-small');
        }
    }
}
add_action('manage_author_posts_custom_column', 'declaringglory_authors_table_content', 10, 2);
