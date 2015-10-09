<?php
// Main Theme Setup
if (!function_exists('declaringglory_setup_theme')) {
    function declaringglory_setup_theme() {
        add_image_size('author-thumb', 120, 120, true);
        add_image_size('author-thumb-small', 80, 80, true);
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
            'description' => 'This sidebar will be shown only on the front page of the site.',
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

// Custom JavaScript and CSS Scripts
if (!function_exists('declaringglory_enqueue_scripts')) {
    function declaringglory_enqueue_scripts() {
        wp_enqueue_style('declaringglory', get_template_directory_uri() . '/css/declaringglory.css');
    }
}
add_action('wp_enqueue_scripts', 'declaringglory_enqueue_scripts');

if (!function_exists('declaringglory_enqueue_admin_scripts')) {
    function declaringglory_enqueue_admin_scripts() {
        wp_enqueue_style('declaringglory', get_template_directory_uri() . '/css/admin.css');
    }
}
add_action('admin_enqueue_scripts', 'declaringglory_enqueue_admin_scripts');

// Plugins
require get_template_directory() . '/inc/plugins/songs/songs.php';
require get_template_directory() . '/inc/plugins/composers/composers.php';

// Widgets
require get_template_directory() . '/inc/widgets/recent_songs.php';
require get_template_directory() . '/inc/widgets/recent_devos.php';
require get_template_directory() . '/inc/widgets/song_types.php';

// Connections
if (function_exists('p2p_register_connection_type')) {
    if (!function_exists('declaringglory_connection_types')) {
        function declaringglory_connection_types() {
            // Writers
            p2p_register_connection_type(array(
                'name' => 'writer',
                'from' => 'song',
                'to' => 'user',
                'cardinality' => 'many-to-many',
                'title' => array('from' => 'Written by', 'to' => 'Wrote')
            ));

            // Composers
            p2p_register_connection_type(array(
                'name' => 'composer',
                'from' => 'song',
                'to' => 'composer',
                'cardinality' => 'many-to-many',
                'title' => array('from' => 'Composed by', 'to' => 'Composed')
            ));
        }
    }
    add_action('p2p_init', 'declaringglory_connection_types');
}

// Set up FB integration
if (!function_exists('declaringglory_setup_facebook')) {
    function declaringglory_setup_facebook() {

    }
}
//add_action('wp_head', 'declaringglory_setup_facebook');
