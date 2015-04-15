<?php
if (!function_exists('declaringglory_create_composers')) {
    function declaringglory_create_composers() {
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
?>
