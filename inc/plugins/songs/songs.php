<?php
if (!function_exists('add_action')) {
    echo 'Plugins aren\'t much good run by themselves...';
    exit;
}

define( 'SONGS_VERSION', '1.0.0' );
define( 'SONGS__MINIMUM_WP_VERSION', '3.1' );
define( 'SONGS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once SONGS__PLUGIN_DIR . 'class.songs.php';
add_action('init', array('GW_Songs', 'init'));

if (is_admin()) {
    require_once SONGS__PLUGIN_DIR . 'class.songs-admin.php';
    add_action('init', array('GW_SongsAdmin', 'init'));
}
