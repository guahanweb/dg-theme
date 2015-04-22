<?php
class GW_ComposersAdmin {
    private static $initialized = false;

    public static function init() {
        if (!self::$initialized) {
            self::init_hooks();
        }
    }

    private static function init_hooks() {
        self::$initialized = true;

        add_filter('manage_song_posts_columns', array('GW_ComposersAdmin', 'setupTableHeadings'));
        add_action('manage_song_posts_custom_column', array('GW_ComposersAdmin', 'manageCustomColumns'), 10, 2);
    }

    public static function setupTableHeadings($defaults) {
        $columns = array();
        foreach ($defaults as $k => $v) {
            if ($k == 'title') {
                $columns['portrait'] = '<div class="composer-header composer-portrait">' . __('Portrait') . '</div>';
                $columns[$k] = '<div class="composer-header composer-name">' . __('Name') . '</div>';
            } elseif ($k == 'date') {
                $columns['author'] = '<div class="composer-header composer-added">' . __('Added By') . '</div>';
                $columns[$k] = $v;
            } else {
                $columns[$k] = $v;
            }
        }
        return $columns;
    }

    public static function manageCustomColumns($column_name, $post_id) {
        if ($column_name == 'portrait') {
            echo get_the_post_thumbnail($post_id, 'composer-thumb-small');
        }
    }
}
