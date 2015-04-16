<?php
/**
 * The template for displaying the front page.
 *
Template Name: Front Page
 *
 * @package WordPress
 * @subpackage DeclaringGlory
 */

get_header(); ?>
<div class="container_12 site-cover">
    <div id="primary" class="content-area grid_12">
        <main id="main" class="site-main" role="main">
            <?php the_post(); ?>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <?php the_content(); ?>
        </main><!-- #main -->
    </div><!-- #primary -->
    <div class="grid-holder">

    </div>
    <div id="secondary">
        <main id="composers">
<?php
$tmp_query = $wp_query;
$wp_query = new WP_Query(array('post_type' => 'composer'));
while (have_posts()): the_post();
?>
    <div class="composer content-area grid_4">
    <?php get_template_part('content', 'composer_light'); ?>
    </div>
<?php
endwhile;
$wp_query = $tmp_query;
?>
        </main>
    </div>
</div>
<?php get_footer(); ?>
