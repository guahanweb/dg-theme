<?php
function declaringglory_create_composers() {
    register_post_type('composer', array(
        'labels' => array(
            'name' => __('Composers'),
            'singular' => __('Composer')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'composers')
    ));
}
add_action('init', 'declaringglory_create_composers');
?>
