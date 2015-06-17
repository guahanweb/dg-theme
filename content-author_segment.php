<?php
/**
 * @package WordPress
 * @subpackage DeclaringGlory
 * @since 1.0
 */
$data = get_userdata(2);
?>
<article id="author-segment">
    <header class="entry-header">
        <h2 class="secondary"><?php printf('%s %s', $data->first_name, $data->last_name); ?></h2>
    </header>
    <main>
        <div class="bio">
        <p><?php echo $data->description; ?></p>
        </div>
    </main>
</article>
