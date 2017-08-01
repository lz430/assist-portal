<?php
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();
?>

<div id="content" class="row-fluid">
    <div class="span9 main">
        <?php if (have_posts()) : ?>

        <div class="breadcrumbs">
            <?php if (function_exists('bcn_display')) { bcn_display(); }?>
        </div>

        <div  class="row-fluid">
            <?php while (have_posts()) : the_post(); ?>

            <h1 class="page-title"><? the_title()?></h1>

 			<div class="commercial">
            	<div class="ad-embed-container"><?= types_render_field("brightcove-embed-code", array("output" => "raw")) ?></div>
            	<?= types_render_field("length", array("output"=>"html")) ?>
            </div>

            <?php the_content('Read the rest of this entry &raquo;'); ?>

            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="span3 hidden-tablet">
        <? get_sidebar()?>
    </div>
</div>
<?php get_footer(); ?>