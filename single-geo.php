<?php
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();
?>

<div id="content" class="row-fluid single-geo">
    <div class="span9 main">

        <div class="breadcrumbs">
        	<a title="Go to Assist Wireless." href="/" class="home">Home</a> | <? the_title()?>
        </div>


		<?php while (have_posts()) : the_post(); ?>

			<h1 class="page-title">Free Assist Wireless Phones are now available in <? the_title()?></h1>


			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="featured-image hidden-phone">
					<img src="<?php bloginfo('template_url'); ?>/images/geo-header.jpg" width="710" height="190"/>
				</div>

                <div>
                    <a class="enrollment-link" href="/enrollment-form" style="margin-left:30px;float:right"><img style="height:60px;width:154px;" src="<?php bloginfo('template_url'); ?>/images/button-enroll.png" alt="Enroll Now"/></a>
				    <p>Getting a free Lifeine cell phone in <? the_title()?> is easy. Make sure you have all your documents.
					Then <a style="font-weight:bold" title="Welcome to the Assist Wireless Lifeline Cell Phone Online Enrollment" href="/enrollment-form/">click here to enroll online.</a>
					It will only take a few minutes to see if you qualify for the Assist Wireless Lifeline Assistance Program.
					If you prefer to enroll by phone, just call us at 1-855-420-2449.</p>
                </div>

				<div class="geo-thumb">
					<? if (has_post_thumbnail()) {
                    		the_post_thumbnail();
                    } ?>
				</div>

                <h3>Eligibility Information</h3>
                <p>
                	Lifeline is a government program that provides a monthly discount on home or mobile telephone services.
                	Only ONE Lifeline discount is allowed per household. Members of a household are not permitted to receive
                	Lifeline service from multiple telephone companies. Your household is everyone who lives together
                	at your address as one economic unit (including children and people who are not related to you).
                	The adults you live with are part of your economic unit if they contribute to and share in the income
                	and expenses of the household. An adult is any person 18 years of age or older,
                	or an emancipated minor (a person under age 18 who is legally considered to be an adult).
                	Household expenses include food, health care expenses (such as medical bills) and the
                	cost of renting or paying a mortgage on your place of residence (a house or apartment, for example)
                	and utilities (including water, heat and electricity). Income includes salary, public assistance benefits,
                	social security payments, pensions, unemployment compensation, veteran's benefits, inheritances,
                	alimony, child support payments, worker's compensation benefits, gifts, and lottery winnings. Spouses
                	and domestic partners are considered to be part of the same household. Children under the age of 18 living
                	with their parents or guardians are considered to be part of the same household as their parents or guardians.
                	If an adult has no income, or minimal income, and lives with someone who provides financial support to that adult,
                	both people are considered part of the same household.</p>


                <p>NOTE: By Law, the Lifeline Program is only available for one (1) phone per household.</p>


			</div>

		<?php endwhile; ?>

		<div style="height:20px"></div>


		<div class="enrollment-section">
			<div><strong><span class="red">Enroll</span> in Lifeline Phone Service</strong>
        	It only takes a few minutes to sign up</div>
        	<a class="enrollment-link" href="/enrollment-form"><img style="height:60px;width:154px;" src="<?php bloginfo('template_url'); ?>/images/button-enroll.png" alt="Enroll Now"/></a>
        </div>

    </div>

    <div class="span3 hidden-tablet">
        <? get_sidebar()?>
    </div>
</div>
<?php get_footer(); ?>