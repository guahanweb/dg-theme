<?php
if (!function_exists('add_action')) {
    echo 'Plugins aren\'t much good run by themselves...';
    exit;
}

define( 'COMPOSERS_VERSION', '1.0.0' );
define( 'COMPOSERS__MINIMUM_WP_VERSION', '3.1' );
define( 'COMPOSERS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once COMPOSERS__PLUGIN_DIR . 'class.composers.php';
add_action('init', array('GW_Composers', 'init'));

if (is_admin()) {
    require_once COMPOSERS__PLUGIN_DIR . 'class.composers-admin.php';
    add_action('init', array('GW_ComposersAdmin', 'init'));
}
