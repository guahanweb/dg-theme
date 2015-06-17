<?php
class Song_Types extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'song_types',
            'Song Types',
            array('description' => __('Your defined song categories', 'declaringglory'))
        );
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    public function form($instance) {
        if ($instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'declaringglory'); ?></label>
            <input class="widget" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <?php
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        $this->getTypes();
        echo $after_widget;
    }

    private function getTypes() {
        $tax = array(
            'song_type'
        );

        $terms = get_terms($tax, array(
            'hide_empty' => false,
            'orderby' => 'id'
        ));

        if (count($terms) > 0) {
            echo '<ul class="widget-content song-types">';
            foreach ($terms as $term) {
                printf('<li><a href="%s">%s</a></li>', get_term_link($term), $term->name);
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '<p class="no-result">No results</p>';
        }
    }
}

add_action('widgets_init', function () {
    register_widget('Song_Types');
});
