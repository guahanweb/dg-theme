<?php
get_header();
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<div class="container_12 site-cover">
    <div id="primary" class="content-area grid_8">
        <main id="main" class="site-main" role="main">
            <p>This is <?php echo $curauth->nickname; ?>'s page</p>
        </main>
    </div>
</div>
<?php get_footer(); ?>
