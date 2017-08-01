<?php
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();

/* If this is a woocommerce page such as the cart, don't show the sidebar */

/*
Template Name: Prepaid Plans Page
*/
$main_span = 'span9';
$is_woo = false;
if(is_cart() || is_checkout()) {
    $main_span = 'span12';
    $is_woo = true;
}

?>

<div id="content" class="row-fluid">
    <div class="<?=$main_span?> main">
        <?php if (have_posts()) : ?>

        <div class="breadcrumbs">
            <?php if (function_exists('bcn_display')) {
            bcn_display();
        }?>
        </div>
        <?php while (have_posts()) : the_post(); ?>

            

            <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                <div class="featured-image"><? if (has_post_thumbnail()) {
                    the_post_thumbnail();
                } ?></div>
                <?php the_content('Read the rest of this entry &raquo;'); ?>
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <? if(!$is_woo) { ?>
   <div class="prettywoman"><img src="https://www.assistwireless.com/wp-content/uploads/2015/03/girl.png" style="float:left;align:left;margin-left:-58px!important;" /></div>
    <? } ?>
</div>
<?php get_footer(); ?>