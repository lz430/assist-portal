<?php
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();
?>

<div id="content" class="row-fluid">

    <?
    /**
     * single product page -- show the sidebar
     */
    if(is_product()) { ?>
        <div class="span9 main">

            <h1>Product Details</h1>

            <div class="breadcrumbs">
                 <a title="Go to Assist Wireless." href="/" class="home">Home</a> |
                                <a title="Go to the Products List page." href="/shop">Phones</a>
                                | <? the_title() ?>
            </div>
            <?php woocommerce_content(); ?>
        </div>

        <div class="span3 hidden-tablet">
            <? get_sidebar()?>
        </div>
        <div class="clearfix"></div>
        <? do_action( 'woocommerce_after_product' );?>

    <? } else { ?>
        <div class="breadcrumbs">
            <?php if (function_exists('bcn_display')) {
            bcn_display();
        }?>
        </div>

        <h1>Upgrade Your Cell Phone Today</h1>

        <p>You can upgrade your cell phone anytime you like. Looking for a data phone? We got it. Looking for a smart
            phone? We have one for you. Just choose the cell phone that best fits your needs and place it in the
            shopping cart. And remember, every one of these upgraded models with work with your Lifeline
            cell phone service plan.</p>

        <?php woocommerce_content(); ?>
    <? } ?>
</div>
<?php get_footer(); ?>