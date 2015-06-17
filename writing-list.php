<?php
$songs = get_posts(array(
    'post_type' => 'song',
    'showposts' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => $term->taxonomy,
            'field' => 'term_id',
            'terms' => $term->term_id
        )
    )
));
?>
<section class="grid_6">
    <header class="list-header">
        <h2 class="list-title"><?php echo $term->name; ?></h2>
    </header>
    <div class="list-content">
        <?php if (count($songs) > 0): ?>
        <ul>
        <?php foreach ($songs as $song): ?>
            <li><?php
            printf('<a href="%s" class="permalink">%s</a>', get_the_permalink($song->ID), $song->post_title);
            ?></li>
        <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p class="no-content">
            No results
        </p>
        <?php endif; ?>
    </div>
</section>
