<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package web2feel
 */
?>
    <div id="secondary" class="widget-area grid_4" role="complementary">
        <?php do_action( 'before_sidebar' ); ?>
        <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

        <?php endif; // end sidebar widget area ?>
    </div><!-- #secondary -->
