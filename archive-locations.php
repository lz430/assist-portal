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

        <h1 class="page-title">Locations</h1>
        <h5>Authorized Lifeline Cell Phone Service, Sales, and Payment Locations</h5>

        <p>

                <strong>Payments may be made at any Assist Wireless location below or any <a href="https://www.acecashexpress.com/locations">Ace Cash Express</a> location.</strong>
                </p>

        <p>Visit one of our many locations in Oklahoma to learn more about free Assist Wireless Cell Phones and
            Lifeline service.</p>

	
        <div id="locations">
            <div class="row-fluid">
                    <?php
                    query_posts($query_string . '&posts_per_page=100&orderby=title&order=ASC');
                    ?>
                <?php while (have_posts()) : the_post(); ?>

                <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <h5><a href="<?=the_permalink()?>"><?=the_title()?></a></h5>

                    <div class="hours-address">
                        <?= types_render_field("address", array("output" => "html"))?>

                        <strong>Store Hours:</strong><br/>
                        <?= types_render_field("store-hours", array("output" => "html"))?>

                        <strong>Phone: </strong>
                        <?= types_render_field("phone", array("raw" => "true"))?>
                    </div>

                    <a href="<?=the_permalink()?>">
                        <? assist_static_map(types_render_field("address", array("raw" => TRUE)))?>
                        View Larger Map &raquo;
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="span3 hidden-tablet">
        <? get_sidebar()?>
    </div>
</div>
<?php get_footer(); ?>