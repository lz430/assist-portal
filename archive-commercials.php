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
            <?php if (function_exists('bcn_display')) {
            bcn_display();
        }?>
        </div>

        <h1>Assist Wireless TV Commercials</h1>
        <p>Assist Wireless is here for you. Over the phone. On the web. And, now, with full-service stores across
            Oklahoma.
            Come and visit one of our 25 locations to learn more about the Free Assist Wireless Cell Phones and the
            Lifeline cell
            phone service. Watch the commercials below to learn more.</p>
        <div class="row-fluid" id="commercials">
            <?php while (have_posts()) : the_post(); ?>
            <div class="commercial">
            	<div class="ad-embed-container"><?= types_render_field("brightcove-embed-code", array("output" => "raw")) ?></div>

                <span class="title">"<? the_title()?>" :</span>
                <?= types_render_field("length", array("output" => "html")) ?>
                <?php the_content('Read the rest of this entry &raquo;'); ?>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="span3 hidden-tablet">
        <? get_sidebar()?>
    </div>
</div>
<?php get_footer(); ?>
