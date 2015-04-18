<?php
/**
 * @package WordPress
 * @subpackage DeclaringGlory
 * @since 1.0
 */
?>
<article id="post-<?php the_ID(); ?>">
    <header class="entry-header">
        <div class="entry-feature">
            <div class="portrait"><?php the_post_thumbnail('composer-thumb-small'); ?></div>
        </div>
        <div class="title-holder">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </div>
    </header>
    <main>
        <div class="bio">
            <p><?php the_content(); ?></p>
        </div>
    </main>
</article>
