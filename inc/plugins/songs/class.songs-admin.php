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
        add_action('save_post', array('GW_SongsAdmin', 'saveMetaData'));
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

    public static function registerMetaBoxes() {
        add_meta_box('declaringglory_songs_details', __('Song Details'), array('GW_SongsAdmin', 'renderDetailsMetaBox'), 'song', 'normal', 'default');
    }

    public static function renderDetailsMetaBox($post) {
        // Render nonce
        wp_nonce_field(basename(__FILE__), 'dgsongs_nonce');

        // Render textarea for text
        $text = get_post_meta($post->ID, 'song_text', true);
        echo '<p>';
        echo '<label class="declaringglory-meta-label" for="song_details_text">';
        _e('Text');
        echo '</label>';
        printf('<textarea name="song_details_text" id="song_details_text" class="widefat" rows="12">%s</textarea>', $text);
        echo '</p>';
    }

    public static function saveMetaData($post_id) {
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['dgsongs_nonce']) && wp_verify_nonce($_POST['dgsongs_nonce'], basename(__FILE__)));

        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }

        if (isset($_POST['song_details_text'])) {
            update_post_meta($post_id, 'song_text', $_POST['song_details_text']);
        }
    }
}
