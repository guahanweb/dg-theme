<?php
/**
 * The template for displaying base taxonomies.
 *
 * @package declaringglory
 */

get_header();

// Get the taxonomy
$value = get_query_var($wp_query->query_vars['taxonomy']);
$term  = get_term_by('slug', $value, $wp_query->query_vars['taxonomy']);
?>
<div class="container_12 site-cover">
    <div id="primary" class="content-area grid_8">
        <main id="main" class="site-main" role="main">
            <header class="page-header">
                <h1 class="page-title"><?php printf( __( 'List of %s', 'declaringglory' ), '<span>' . $term->name . '</span>' ); ?></h1>
            </header><!-- .page-header -->
            <?php if (have_posts()): while(have_posts()): the_post(); ?>
                <?php get_template_part('mini', 'song'); ?>
            <?php endwhile; else: ?>
                <p>Nothing here</p>
            <?php endif; ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
</div>
<?php
get_footer();
