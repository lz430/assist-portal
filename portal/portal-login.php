<?php
/**
 * Template Name: Portal Login Page
 */
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
<?php get_footer(); ?>
