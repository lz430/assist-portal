<?php
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();
?>

<div id="content">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <?php the_content('Read the rest of this entry &raquo;'); ?>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>