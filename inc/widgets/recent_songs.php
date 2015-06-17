<?php
class Recent_Songs extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'recent_songs',
            'Recent Songs',
            array('description' => __('Your site\'s most recent Songs', 'declaringglory'))
        );
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['numberOfSongs'] = strip_tags($new_instance['numberOfSongs']);
        return $instance;
    }

    public function form($instance) {
        if ($instance) {
            $title = esc_attr($instance['title']);
            $numberOfSongs = esc_attr($instance['numberOfSongs']);
        } else {
            $title = '';
            $numberOfSongs = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'declaringglory'); ?></label>
            <input class="widget" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('numberOfSongs'); ?>"><?php _e('Number of songs:', 'declaringglory'); ?></label>
            <select id="<?php echo $this->get_field_id('numberOfSongs'); ?>" name="<?php echo $this->get_field_name('numberOfSongs'); ?>">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                <?php printf('<option%s value="%s">%s</option>', $i == $numberOfSongs ? ' selected="selected"' : '', $i, $i); ?>
                <?php endfor; ?>
            </select>
        </p>
        <?php
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $numberOfSongs = $instance['numberOfSongs'];
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        $this->getSongs($numberOfSongs);
        echo $after_widget;
    }

    private function getSongs($count) {
        global $post;
        $songs = new WP_Query();
        $songs->query('post_type=song&posts_per_page=' . $count);
        if ($songs->found_posts > 0) {
            echo '<ul class="widget-content recent-songs">';
            while ($songs->have_posts()) {
                $songs->the_post();
                printf('<li><a href="%s">%s</a><span class="published">%s</span></li>',
                    get_permalink(),
                    get_the_title(),
                    get_the_time('M j, Y')
                );
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '<p class="no-result">No results</p>';
        }
    }
}

add_action('widgets_init', function () {
    register_widget('Recent_Songs');
});
