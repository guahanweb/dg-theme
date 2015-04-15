<?php
if (!function_exists('declaringglory_setup_theme')) {
    function declaringglory_setup_theme() {
        add_image_size('composer-thumb', 120, 120, true);
    }
}
add_action('after_setup_theme', 'declaringglory_setup_theme');

// Composers
require get_template_directory() . '/inc/plugins/composers.php';
