<?php
if (!function_exists('declaringglory_setup_theme')) {
    function declaringglory_setup_theme() {
        add_image_size('composer-thumb', 120, 120, true);
        add_image_size('composer-thumb-small', 80, 80, true);
    }
}
add_action('after_setup_theme', 'declaringglory_setup_theme');

// Front Page Sidebar
if (!function_exists('declaringglory_setup_sidebars')) {
    function declaringglory_setup_sidebars() {
        $args = array(
            'name' => __('Front Page Sidebar'),
            'id' => 'declaringglory-sidebar-front',
            'description' => 'Front page sidebar',
            'class' => '',
            'before_widget' => '<aside id="%1$s-2" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>'
        );

        register_sidebar($args);
    }
}
add_action('widgets_init', 'declaringglory_setup_sidebars');

// Composers
require get_template_directory() . '/inc/plugins/composers.php';

if (!function_exists('declaringglory_enqueue_scripts')) {
    function declaringglory_enqueue_scripts() {
        wp_enqueue_style('declaringglory', get_template_directory_uri() . '/css/declaringglory.css');
    }
}
add_action('wp_enqueue_scripts', 'declaringglory_enqueue_scripts');
