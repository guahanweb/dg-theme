<?php
/**
 * The template for displaying all composers.
 *
Template Name: Writings
 *
 * @package WordPress
 * @subpackage DeclaringGlory
 * @since 1.0
 */

$tax = array(
    'song_type'
);

$terms = get_terms($tax, array(
    'hide_empty' => false,
    'orderby' => 'id'
));
get_header(); ?>

<div class="container_12 site-cover">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" class="page-top">
                <?php the_post(); ?>
                <header class="post-header">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            </article>

            <div class="writings listing">
            <?php
            foreach ($terms as $term) {
                include(locate_template('writing-list.php'));
            }
            ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
</div>
<?php get_footer(); ?>
