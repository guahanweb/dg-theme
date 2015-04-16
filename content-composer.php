<?php
/**
 * @package WordPress
 * @subpackage DeclaringGlory
 * @since 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="entry-meta">
                <span class="author">Posted by <?php the_author(); ?> </span> <span class="clock">  <?php the_time('M - j - Y'); ?></span> <span class="comm"><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail('composer-thumb');
        }
        ?>
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'web2feel' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php
            /* translators: used between list items, there is a space after the comma */
            $category_list = get_the_category_list( __( ', ', 'web2feel' ) );

            /* translators: used between list items, there is a space after the comma */
            $tag_list = get_the_tag_list( '', __( ', ', 'web2feel' ) );

            if ( ! web2feel_categorized_blog() ) {
                // This blog only has 1 category so we just need to worry about tags in the meta text
                if ( '' != $tag_list ) {
                    $meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'web2feel' );
                } else {
                    $meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'web2feel' );
                }

            } else {
                // But this blog has loads of categories so we should probably display them here
                if ( '' != $tag_list ) {
                    $meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'web2feel' );
                } else {
                    $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'web2feel' );
                }

            } // end check for categories on this blog

            printf(
                $meta_text,
                $category_list,
                $tag_list,
                get_permalink(),
                the_title_attribute( 'echo=0' )
            );
        ?>

        <?php edit_post_link( __( 'Edit', 'web2feel' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post-## -->
