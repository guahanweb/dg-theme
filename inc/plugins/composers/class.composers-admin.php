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

        add_filter('manage_composer_posts_columns', array('GW_ComposersAdmin', 'setupTableHeadings'));
        add_action('manage_composer_posts_custom_column', array('GW_ComposersAdmin', 'manageCustomColumns'), 10, 2);
        add_action('save_post', array('GW_ComposersAdmin', 'saveMetaData'));
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

    public static function saveMetaData($post_id) {
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['dgcomposers_nonce']) && wp_verify_nonce($_POST['dgcomposers_nonce'], basename(__FILE__)));

        if ($is_autosave || $is_revision || !$is_valid_nonce) {
            return;
        }

        $hidden = !isset($_POST['composer_hidden']) || empty($_POST['composer_hidden']) ? '', '1';
        update_post_meta($post_id, 'composer_hidden', isset($_POST['composer_hidden']));
    }

    public static function registerMetaBoxes() {
        add_meta_box('declaringglory_composers_details', __('Composer Details'), array('GW_ComposersAdmin', 'renderDetailsMetaBox'), 'composer', 'normal', 'default');
    }

    public static function renderDetailsMetaBox($post) {
        // Render nonce
        wp_nonce_field(basename(__FILE__), 'dcomposers_nonce');

        // Render textarea for text
        $hidden = empty(get_post_meta($post->ID, 'composer_hidden', true)) ? false : true;
        echo '<p>';
        echo '<label class="declaringglory-meta-label" for="composer_hidden">';
        _e('Hide Composer in Listings');
        echo '</label>';
        printf('<input name="composer_hidden" id="composer_hidden" checked="%s" value="1">',
            $text,
            $hidden ? 'checked' : ''
        );
        echo '</p>';
    }
}
