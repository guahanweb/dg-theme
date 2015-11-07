<?php
$users = get_users(array(
    'connected_type' => 'writer',
    'connected_items' => $post
));
print_r($users);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h3 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="pubilsh-info">
            <span class="author"></span>
            <span class="date"></span>
        </div>
    </header>
</article>
