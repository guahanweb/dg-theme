<?php
class GW_Composers {
    private static $initialized = false;

    public static function init() {
        if (!self::$initialized) {
            self::init_hooks();
            self::registerPostType();
        }
    }

    private static function init_hooks() {
        self::$initialized = true;
    }

    private static function registerPostType() {
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

            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
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
