<?php
/**
 * The template for displaying all composers.
 *
Template Name: Composers
 *
 * @package WordPress
 * @subpackage DeclaringGlory
 * @since 1.0
 */

get_header(); ?>
<div class="container_12 site-cover">
    <div id="primary" class="content-area grid_8">
        <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', 'page' ); ?>
            <?php endwhile; // end of the loop. ?>

            <div class="composers listing">
            <?php
            // Attempt to reset query and display composer list
            $tmp_query = $wp_query;
            $wp_query = new WP_Query(array(
                'post_type' => 'composer'
            ));

            while (have_posts()) {
                the_post();
                get_template_part('content', 'composer');
            }

            $wp_query = $tmp_query;
            ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
