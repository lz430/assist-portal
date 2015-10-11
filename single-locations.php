<?php
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();
?>

<div id="content" class="row-fluid">
    <div class="span9 main">

        <div class="breadcrumbs">
            <?php if (function_exists('bcn_display')) { bcn_display(); }?>
        </div>

        <h1 class="page-title"><? the_title()?></h1>

        <div id="locations">
            <div  class="row-fluid">

                <?
                $args = array( 'post_type' => 'location', 'posts_per_page' => 100 );
                $loop = new WP_Query( $args );
                ?>

                <?php while (have_posts()) : the_post(); ?>

                <div class="span8">
                    <? assist_static_map_large(types_render_field("address", array("raw"=>true)))?>
                    <? assist_static_map_link(types_render_field("address", array("raw"=>true)))?>
                </div>

                <div class="span4">
                    <h5><?=the_title()?></h5>
                    <?= types_render_field("address", array("output"=>"html"))?>

                    <strong>Store Hours:</strong><br/>
                    <?= types_render_field("store-hours", array("output"=>"html"))?>

                    <strong>Phone: </strong>
                    <?= types_render_field("phone", array("raw"=>"true"))?>
                    <p>
                    <a href="<? assist_static_gplus_link(types_render_field("google-plus", array("raw"=>true))) ?>" target="gplus" class="gpus">View on Google+</a>
                    </p>

                    <h5>Services:</h5>
                    <?= types_render_field("services", array("output"=>"html"))?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

    </div>

    <div class="span3 hidden-tablet">
        <? get_sidebar()?>
    </div>
</div>
<?php get_footer(); ?>