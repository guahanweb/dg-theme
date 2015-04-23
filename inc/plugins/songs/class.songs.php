<?php
/**
 * Setting up the main behavior
 */

class GW_Songs {
    private static $initialized = false;

    public static function init() {
        if (!self::$initialized) {
            self::init_hooks();
            self::registerPostType();
            self::registerTaxonomies();
        }
    }

    public static function init_hooks() {
        self::$initialized = true;
        add_filter('the_content', array('GW_Songs', 'filterContent'), 0);
    }

    public static function registerPostType() {
        $slug = get_theme_mod('event_permalink');
        $slug = empty($slug) ? 'song' : $slug;

        register_post_type('song', array(
            'label' => __('songs', 'declaringglory'),
            'description' => __('Songs represented by this site', 'declaringglory'),
            'labels' => array(
                'name' => __('Songs', 'declaringglory'),
                'singular_name' => __('Song', 'declaringglory'),
                'menu_name' => __('Songs', 'declaringglory'),
                'all_items' => __('All Songs', 'declaringglory'),
                'view_item' => __('View Song', 'declaringglory'),
                'add_new_item' => __('Add New Song', 'declaringglory'),
                'add_new' => __('Add New', 'declaringglory'),
                'edit_item' => __('Edit Song', 'declaringglory'),
                'update_item' => __('Update Song', 'declaringglory'),
                'search_items' => __('Search Songs', 'declaringglory'),
                'not_found' => __('Not Found', 'declaringglory'),
                'not_found_in_trash' => __('Not Found in Trash', 'declaringglory')
            ),

            'supports' => array('title', 'editor'),
            'taxonomies' => array('songs'),
            'rewrite' => array('slug' => $slug),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'post',

            // Meta box
            'register_meta_box_cb' => array('GW_SongsAdmin', 'registerMetaBoxes')
        ));
    }

    public static function registerTaxonomies() {
        register_taxonomy(
            'song_type',
            'song',
            array(
                'labels' => array(
                    'name' => __('Song Types'),
                    'singular_name' => __('Song Type'),
                    'add_new_item' => __('Add New Song Type'),
                    'new_item_name' => __('New Song Type')
                ),
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true
            )
        );
    }

    public static function filterContent($content) {
        if ('song' === get_post_type()) {
            global $post;
            $text = get_post_meta($post->ID, 'song_text', true);
            $content = str_replace('[insert_text]', '<blockquote class="song-text fulltext">' . $text . '</blockquote>', $content);
        }
        return $content;
    }
}
