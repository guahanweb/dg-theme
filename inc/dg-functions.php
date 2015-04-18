<?php
if (!function_exists('declaringglory_setup_theme')) {
    function declaringglory_setup_theme() {
        add_image_size('composer-thumb', 120, 120, true);
        add_image_size('composer-thumb-small', 80, 80, true);
    }
}
add_action('after_setup_theme', 'declaringglory_setup_theme');

// Composers
require get_template_directory() . '/inc/plugins/composers.php';

if (!function_exists('declaringglory_enqueue_scripts')) {
    function declaringglory_enqueue_scripts() {
        wp_enqueue_style('declaringglory', get_template_directory_uri() . '/css/declaringglory.css');
    }
}
add_action('wp_enqueue_scripts', 'declaringglory_enqueue_scripts');
