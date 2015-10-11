<?php   
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();
?>

<div id="content" class="row-fluid">
    <div class="span9 main">

        <div class="breadcrumbs">
        	<a title="Go to Assist Wireless." href="/" class="home">Home</a> | <? the_title()?>
        </div>

		<?php while (have_posts()) : the_post(); ?>

			<h1 class="page-title"><? the_title()?> is a qualified reseller of Assist Wireless phones</h1>


			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="featured-image hidden-phone"><? if (has_post_thumbnail()) {
					the_post_thumbnail();
				} else { ?>
					<img src='<?php bloginfo('template_url') ?>/images/affiliate-header.jpg'/><?
				}
				?></div>
				<?php the_content('Read the rest of this entry &raquo;'); ?>

				<div class="contact-info">
					<strong class="title">Contact</strong>
					<?= types_render_field("contact-information", array("output"=>"html"))?>
				</div>


			</div>
		<?php endwhile; ?>


		<a title="Online Enrollment" href="/enrollment-form/"><img style="height:60px;width:154px;" src="<?php bloginfo('template_url'); ?>/images/button-enroll.png" alt="Enroll Now"/></a>
    </div>

    <div class="span3 hidden-tablet">
        <? get_sidebar()?>
    </div>
</div>
<?php get_footer(); ?>