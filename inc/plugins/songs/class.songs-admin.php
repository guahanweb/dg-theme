<?php
class GW_SongsAdmin {
    private static $initialized = false;

    public static function init() {
        if (!self::$initialized) {
            self::init_hooks();
        }
    }

    private static function init_hooks() {
        self::$initialized = true;

        add_filter('manage_song_posts_columns', array('GW_SongsAdmin', 'setupTableHeadings'));
        add_action('manage_song_posts_custom_column', array('GW_SongsAdmin', 'manageCustomColumns'), 10, 2);
    }

    public static function setupTableHeadings($defaults) {
        $columns = array();
        foreach ($defaults as $k => $v) {
            if ($k == 'date') {
                $columns['writer'] = '<div class="song-header song-writeer">' . __('Written By') . '</div>';
                $columns['composer'] = '<div class="song-header song-composer">' . __('Composer(s)') . '</div>';
                $columns[$k] = $v;
            } else {
                $columns[$k] = $v;
            }
        }
        return $columns;
    }

    public static function manageCustomColumns($column_name, $post_id) {
        if ($column_name == 'writer') {

        } elseif ($column_name == 'composer') {

        }
    }
}
