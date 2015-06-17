<?php
/**
 * @package WordPress
 * @subpackage DeclaringGlory
 * @since 1.0
 */
?>
<article id="post-<?php the_ID(); ?>">
    <header class="entry-header">
        <h2 class="secondary"><?php the_title(); ?></h2>
    </header>
    <main>
        <div class="bio">
            <div class="portrait"><?php the_post_thumbnail('composer-thumb-small'); ?></div>
            <p><?php echo get_the_content(); ?></p>
        </div>
    </main>
</article>
