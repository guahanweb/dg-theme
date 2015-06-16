<?php
class Recent_Devos extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'recent_devos',
            'Recent Devotionals',
            array('description' => __('Your site\'s most recent Devotionals', 'declaringglory'))
        );
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['numberOfDevos'] = strip_tags($new_instance['numberOfDevos']);
        return $instance;
    }

    public function form($instance) {
        if ($instance) {
            $title = esc_attr($instance['title']);
            $numberOfDevos = esc_attr($instance['numberOfDevos']);
        } else {
            $title = '';
            $numberOfDevos = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'declaringglory'); ?></label>
            <input class="widget" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('numberOfDevos'); ?>"><?php _e('Number of devos:', 'declaringglory'); ?></label>
            <select id="<?php echo $this->get_field_id('numberOfDevos'); ?>" name="<?php echo $this->get_field_name('numberOfDevos'); ?>">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                <?php printf('<option%s value="%s">%s</option>', $i == $numberOfDevos ? ' selected="selected"' : '', $i, $i); ?>
                <?php endfor; ?>
            </select>
        </p>
        <?php
    }

    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $numberOfDevos = $instance['numberOfDevos'];
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        $this->getDevos($numberOfDevos);
        echo $after_widget;
    }

    private function getDevos($count) {
        global $post;
        $devos = new WP_Query();
        $devos->query('post_type=devotional&posts_per_page=' . $count);
        if ($devos->found_posts > 0) {
            echo '<ul class="widget-content recent-devos">';
            while ($devos->have_posts()) {
                $devos->the_post();
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
    register_widget('Recent_Devos');
});
