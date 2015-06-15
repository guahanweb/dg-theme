<?php
/**
 * @package WordPress
 * @subpackage DeclaringGlory
 * @since 1.0
 */
$data = get_userdata(1);
?>
<article id="author-segment">
    <header class="entry-header">
        <div class="title-holder">
            <h2 class="secondary"><?php printf('%s %s', $data->first_name, $data->last_name); ?></h2>
        </div>
    </header>
    <main>
        <div class="bio">
            <p>Info here...</p>
        </div>
    </main>
</article>
