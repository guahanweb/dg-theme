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
    <div id="artists" class="clearfix">
        <section id="composers" class="region region-composer grid_8">
            <header class="secondary-header">
                <h1 class="header-title">Composers</h1>
            </header>
<?php
$tmp_query = $wp_query;
$wp_query = new WP_Query(array('post_type' => 'composer', 'posts_per_page' => 2));
while (have_posts()): the_post();
?>
    <div class="composer">
    <?php get_template_part('content', 'composer_light'); ?>
    </div>
<?php
endwhile;
$wp_query = $tmp_query;
?>
        </section>
        <section id="author" class="region region-author grid_4">
            <header class="secondary-header">
                <h1 class="header-title">Author</h1>
            </header>
        </section>
    </div>
</div>
<?php get_footer(); ?>
