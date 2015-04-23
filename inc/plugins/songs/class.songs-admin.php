<?php
class GW_SongsAdmin {
    private static $initialized = false;
    private static $instance;

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
        // Set up instance mapping
        global $wp_query;
        p2p_type('composer')->each_connected($wp_query);

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
            $users = get_users(array(
                'connected_type' => 'writer',
                'connected_items' => $post_id
            ));

            if (count($users) > 0) {
                $names = array();
                foreach ($users as $user) {
                    $names[] = $user->display_name;
                }
                echo implode(', ', $names);
            } else {
                echo '<p class="disabled">none</p>';
            }
        } elseif ($column_name == 'composer') {
            global $post;
            $names = array();
            foreach ($post->connected as $post) {
                setup_postdata($post);
                $names[] = sprintf('<a href="post.php?post=%d&action=edit">%s</a>', $post->ID, $post->post_title);
            }
            wp_reset_postdata();
            echo (count($names) > 0) ? implode(', ', $names) : '<p class="disabled">none</p>';
        }
    }
}
