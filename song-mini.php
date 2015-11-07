<?php
$users = get_users(array(
    'connected_type' => 'writer',
    'connected_items' => $post
));
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h3 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="pubilsh-info">
            <?php
            if ($users > 0) {
                $authors = [];
                foreach ($users as $author) {
                    $authors[] = sprintf('<a href="%s" class="author-link">%s</a>', get_author_posts_url($author->ID), $author->display_name);
                }
                printf('<span class="author">%s</span>', implode(', ', $authors));
            ?>
            <?php } ?>
            <span class="date"></span>
        </div>
    </header>
</article>
