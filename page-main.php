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
    <section id="main-banner">
        <div class="wrapper">
            <img src="<?php echo get_template_directory_uri() . '/images/dgbanner01.png'; ?>" alt="Declaring Glory" />
        </div>
    </section>
    <div id="primary" class="content-area grid_8">
        <main id="main" class="site-main" role="main">
            <?php the_post(); ?>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <?php the_content(); ?>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar('front'); ?>
    <div id="composers" class="grid_12">
        <header class="secondary-header">
            <h1 class="header-title">Composers</h1>
        </header>
        <main id="composer-content">
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
