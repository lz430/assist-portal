<?php
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();
?>

<?
/** Reorder them based on the popular field -- need to put all of the most popular posts at the front*/
$posts_right = array();
$posts_left = array();

$ordered_posts = array();
while (have_posts()) : the_post();
	$new_post = new stdClass;
	$new_post->title = get_the_title();
	$new_post->popular = types_render_field("popular", array("raw" => TRUE));
	$new_post->tribal_price = types_render_field("tribal-price", array("raw" => TRUE));
	$new_post->lifeline = types_render_field("lifeline", array("raw" => TRUE));
	$new_post->monthly_cost = types_render_field("monthly-cost", array("raw" => TRUE));
	$new_post->nontribal_price = types_render_field("nontribal-price", array("raw" => TRUE));



	$new_post->price_range = types_render_field("price-range", array("raw" => TRUE));
	$new_post->disclaimer = types_render_field("disclaimer-text", array("output" => "html"));
	$new_post->legal = types_render_field("legal", array("output" => "html"));
	$new_post->features = types_render_field("features", array("output" => "html"));

	if ($new_post->popular) {
		array_unshift($ordered_posts, $new_post);
	} else {
		$ordered_posts[] = $new_post;
	}
endwhile;

/** Split the arrays */
$planCount = 0;
foreach ($ordered_posts as $post) {
	if ($planCount++ % 2 == 0) {
		$posts_right[] = $post;
	} else {
		$posts_left[] = $post;
	}
}


$main_span = count($ordered_posts) < 2 ? 'span9' : "span12";

?>


<div id="content" class="row-fluid">
    <div class="<? echo $main_span ?> main">

        <div class="breadcrumbs">
            <?php if (function_exists('bcn_display')) {
            bcn_display();
        }?>
        </div>

        <? $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));?>
        <? if($term) { ?>
        <h1>Assist Wireless Phone Calling Plans <?=$term->name?></h1>
        <? } else { ?>
        <h1>Assist Wireless Phone Calling Plans</h1>
        <? } ?>
        <div class="clearfix"></div>

        <?php if (have_posts()) : ?>
        <div id="cell-phone-plans">
            <div class="row-fluid">



                <div class="<? echo $planCount > 1 ? 'span6' : 'span12'  ?>">

                    <? foreach ($posts_right as $post) { ?>
                    <div class="<? if ($post->popular) { ?>popular<? } ?>">
                        <div class="plan">
                            <span class="plan-badge"></span>
                            <h4 class="title"><?=$post->title?></h4>

                            <div class="body">
                                <div class="row-fluid">
                                    <div class="features span8">
                                        <h5>Features:</h5>
                                        <?= $post->features?>
                                    </div>
                                    <div class="pricing span4">
                                        <? if (strlen($post->tribal_price) > 0) { ?>
                                        <span class="title">Tribal Lifeline</span>
                                        <span class="cost"><sup>$</sup><?=$post->tribal_price?>/month</span>
                                        <? } ?>
 <? if (strlen($post->lifeline) > 0) { ?>
                                        <span class="title">Lifeline</span>
                                        <span class="cost"><sup>$</sup><?=$post->lifeline?>/month</span>
                                        <? } ?>
                                        <? if (strlen($post->monthly_cost) > 0) { ?>
                                        <span class="title">Monthly Cost</span>
                                        <span class="cost"><sup>$</sup><?=$post->monthly_cost?>/month</span>
<? } ?>
                                
 <? if (strlen($post->nontribal_price) > 0) { ?>
                                        <span class="title">Nontribal Lifeline</span>
                                        <span class="cost"><sup>$</sup><?=$post->nontribal_price?>/month</span>
                                        <? } ?>
                                        <? if ($post->price_range) {
                                        $parts = explode('-', $post->price_range);
                                        ?>
                                        <span class="range cost"><sup>$</sup><?=$parts[0]?>
                                            -<sup>$</sup><?=$parts[1]?></sup></span>
                                        <? } ?>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="disclaimer"><?=$post->disclaimer?></div>
                                    <? if ($post->legal) { ?>
                                    <div class="legal"><?=$post->legal?></div>
                                    <? } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                </div>

                <? if ($planCount > 0) { ?>
                <div class="span6">
                    <? foreach ($posts_left as $post) { ?>
                    <div class="<? if ($post->popular) { ?>popular<? } ?>">
                        <div class="plan">
                            <span class="plan-badge"></span>
                            <h4 class="title"><?=$post->title?></h4>

                            <div class="body">
                                <div class="row-fluid">
                                    <div class="features span8">
                                        <h5>Features:</h5>
                                        <?= $post->features?>
                                    </div>
                                    <div class="pricing span4">
                                        <? if (strlen($post->tribal_price) > 0) { ?>
                                        <span class="title">Tribal Lifeline</span>
                                        <span class="cost"><sup>$</sup><?=$post->tribal_price?>/month</span>
                                        <? } ?>

                                        <? if (strlen($post->lifeline) > 0) { ?>
                                        <span class="title">Lifeline</span>
                                        <span class="cost"><sup>$</sup><?=$post->lifeline?>/month</span>
                                        <? } ?>
                                        <? if (strlen($post->nontribal_price) > 0) { ?>
                                        <span class="title">Nontribal Lifeline</span>
                                        <span class="cost"><sup>$</sup><?=$post->nontribal_price?>/month</span>
                                        <? } ?>
                                        <? if ($post->price_range) {
                                        $parts = explode('-', $post->price_range);
                                        ?>
                                        <span class="range cost"><sup>$</sup><?=$parts[0]?>
                                            -<sup>$</sup><?=$parts[1]?></sup></span>
                                        <? } ?>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="disclaimer"><?=$post->disclaimer?></div>
                                    <? if ($post->legal) { ?>
                                    <div class="legal"><?=$post->legal?></div>
                                    <? } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <? } ?>

                </div>

                <? } ?>


                <div class="clearfix"></div>

            </div>
        <?php endif; ?>
        </div>
        <h4>Assist Wireless Text Messaging Rates</h4>
        <p>The standard rate to send or receive a text message on your Assist Wireless phone is
           $0.10 per tex t message for receiving, and $0.10 per text message for sending. Adding additional airtime
           or plans to your account may include incremental minute rates per text messages sent or received. Text
           messaging rates for FREE PLAN 68, FREE PLAN 125 and FREE PLAN 250 will be charged at 1 minute per text
           message for sending and 1 minute per text message for receiving text messages.         </p>

         <? if(!$term || $term->name == 'Oklahoma') { ?>
            <h4>Unlimited Does Not Mean Unreasonable</h4>
                    <p>To ensure that all customers have access to reliable services provided at a reasonable cost, you may not
                       use our service in a manner that interferes with another Assist Wireless Mobile customer’s use of our
                       service or disproportionally Assist Wireless, LLC’s network resources. Assist Wireless, LLC reserves the
                       right, without notice or limitation, to terminate individual calls, or after providing notice to you,
                       offer you a different service plan with no unlimited usage components, limit data throughput speeds or
                       quantities, or deny, terminate, end, modify, disconnect or suspend your service, or decline to renew
                       your service, if you engage in any of the prohibited voice or data uses detailed below or if Assist
                       Wireless, LLC, in its sole discretion, determines action is necessary to protect its wireless networks
                       from harm or degradation. Assist wireless may limit, alter, or discontinue your Service if you generate
                       abnormally high call volumes, abnormally long average call lengths, calls with abnormally high costs,
                       abnormally high use, or other disproportionate use when compared to those of other customers of Assist
                       Wireless.</p>
        <? } ?>





    </div>

      <? if (count($ordered_posts) < 2) { ?>
		<div class="span3 hidden-tablet">
			<? get_sidebar()?>
		</div>
	  <? } ?>


    <div class="clearfix"></div>

</div> <!-- Close the page div created in the header -->

<?php get_footer(); ?>