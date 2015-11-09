<?php
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();
?>

<div class="container">

  <div id="login" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php echo do_shortcode('[woocommerce_my_account]'); ?>

    <p id="nav">

        <a href="https://www.assistwireless.com/dev/my-account/lost-password/" title="Password Lost and Found">Lost your password?</a>

    </p>

    <p id="backtoblog"><a href="<?php echo get_bloginfo('url'); ?>" title="Are you lost?">← Back to Lifeline Cell Phone Service</a></p>

  </div>

</div>

<script>
    function closeViolator(){
        jQuery('#violator').hide();
    }
</script>
<div id="violator" >
    <h1>Recieved a letter from USAC?</h1>
    <p style="font-size:24px;font-weight:bold">Make sure Assist Wireless<br/> is your #1 choice!</p>
    <a href="/why-assist"><img src="<?php bloginfo('template_url'); ?>/images/details.png" border="0"/></a> <br/>
    <div style="text-align:right">
    <a href="#" style="font-size:24px;color:black;font-weight:bold" onclick="closeViolator();">X</a>
    </div>
</div>
<?php get_footer(); ?>