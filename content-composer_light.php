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

        </div>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <p><?php the_content(); ?></p>
    </header>
</article>
