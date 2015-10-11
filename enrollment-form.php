<?php
/*
Template Name: Enrollment Form Template
*/
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
include (TEMPLATEPATH . '/enrollment/enrollment-form-process.php');
get_header('enrollment');
?>

<script src="<?php bloginfo('template_url'); ?>/js/webcam/webcam.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
    jQuery(document).ready(function ($) {
        $('#nav-enroll').addClass('active');
        $(".phone-mask").mask("999-999-9999");
		
		
		/** Initialize Web Camera **/
		$("#webcam-activate, #webcam-activate2").click(function(){
			Webcam.set({
				width: 320,
				height: 240,
				image_format: 'jpeg',
				jpeg_quality: 90
			});
			Webcam.attach( '#camera' );
		});

        /** Initialize any values */
        $("#state").val($("#state").attr('orig-value'));
        $("#number_household").val($("#number_household").attr('orig-value'));
        $("#program").val($("#program").attr('orig-value'));
        $("#dob-month").val($("#dob-month").attr('orig-value'));

        /** Load the current step **/
        if ('<?=$currentStep?>' && '<?=$currentStep?>' != '1') {
            Assist.next('enrollment-step<?=$currentStep?>');
        }
    });

	function take_snapshot() {
		
		Webcam.snap( function(data_uri) {
			// display results in page

	        Webcam.upload( data_uri, '<?php echo get_bloginfo('home'); ?>/enrollment-form/?fileupload=true&enrollmentId=<?php echo $enrollmentId; ?>&type=webcam', function(code, text) {

				alert("Photo saved.");
	            // Upload complete!
	            // 'code' will be the HTTP response code from the server, e.g. 200
	            // 'text' will be the raw response content
	        } );
        
		} );
	}
    
    //window.onbeforeunload = Assist.ShowCoupon;

</script>
<div id="content" class="row-fluid">
<div class="span11 main">
    <?php if (have_posts()) : ?>

    <div class="breadcrumbs">
        <?php if (function_exists('bcn_display')) {
        bcn_display();
    }?>
    </div>
    <?php while (have_posts()) : the_post(); ?>

        <h1 class="page-title"><? the_title() ?></h1>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <div class="featured-image">
                <? if (has_post_thumbnail()) {
                the_post_thumbnail();
            } ?>
            </div>
            <?php the_content('Read the rest of this entry &raquo;'); ?>
        </div>
        <?php endwhile; ?>

	<?php
	if (is_user_logged_in()) {
	?>
	

    <form id="enrollment-form" action="" method="post" class="form-horizontal">
        <input type="hidden" name="submitted" value="true"/>
        <input type="hidden" name="wpid" value="<?= get_current_user_id(); ?>"/>
        <input type="hidden" name="enrollmentId" value="<?= $enrollmentId ?>"/>
        <input type="hidden" name="submission-method" id="submission-method" value=""/>

        <div id="enrollment-form-container">
            <div id="step1">
                <div id="enrollment-form-intro">
                    <? if (!$isReview) { ?>
                    <p id="intro-summary">
                        Begin our simple online process. It will only take a few minutes to
                        see if you qualify for a phone from Assist Wireless.
                    </p>
                    <? } ?>
                </div>

                <div id="enrollment-form-steps">
                    <ul>
                        <li class="steps-enrollment-step1 <? echo $isReview ? "" : "active" ?>">Location</li>
                        <li class="steps-enrollment-step2">Personal <br />Information</li>
                        <li class="steps-enrollment-step3">Select <br />Your Plan</li>
                        <li class="steps-enrollment-step4">Government <br />Assistance</li>
                        <li class="steps-enrollment-step5">Terms & <br />Conditions</li>
                        <li class="steps-enrollment-step6 <? echo $isReview ? "active" : "" ?>">Eligibility <br />Documents</li>
                    </ul>
                </div>

                <ul id="enrollment-steps">
                    <?php include (TEMPLATEPATH . '/enrollment/step1.php'); ?>
                    <?php include (TEMPLATEPATH . '/enrollment/step2.php'); ?>
                    <?php include (TEMPLATEPATH . '/enrollment/step3.php'); ?>
                    <?php include (TEMPLATEPATH . '/enrollment/step4.php'); ?>
                    <?php include (TEMPLATEPATH . '/enrollment/step5.php'); ?>
                    <?php include (TEMPLATEPATH . '/enrollment/step6.php'); ?>
                </ul>
            </div>
        </div>


        <?php
        $date = new DateTime();
        $date->modify('+1 month');

        $couponUrl = "/wp-content/themes/assistv2/enrollment/coupon.php?d=" . $date->format('m/d/Y');
        ?>

        <div class="Coupon" style="display:none">
            <img onclick="Assist.closeCoupon()" style="position:absolute;right:-18px;top:-18px;" src="/wp-content/themes/assistv2/images/close.png" style="width:36px;height:36px;"/>
            <div onclick="" style="width:100%;text-align:center;font-weight:bold"><a href="<?php echo $couponUrl ?>" onclick="Assist.ClearUnload()">Click to Print</a></div>
            <div id="coupon-date" style="position:relative;left:279px;top:302px"><?php echo $date->format('m/d/Y'); ?></div>
            <a onclick="Assist.ClearUnload()" href="<?php echo $couponUrl ?>"><img src="/wp-content/themes/assistv2/images/coupon.jpg" style="width:719px;height:335px;"/></a>


        </div>


        <? if ($isReview) { ?>

        <a href="/" class="home-button enrollment-submit">Home</a>

        <? } ?>
        <div style="clear:both"></div>
        <div id="modal-documents" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2>Please Select Document Submission Method</h2>
            </div>
            <div class="modal-body">
                <div class="body">
                    <p>
                        Before your enrollment for Lifeline Service is submitted to Assist Wireless, you MUST submit a
                        copy of your Photo ID and Eligibility Documents.
                    </p>

                    <p class="upload-examples"><img src="<?php bloginfo('template_url'); ?>/images/documents-example.jpg"/></p>

                    <p>
                        To help us ensure timely processing of your documents, please select the method of submission
                        you plan to use:

                        <br/>

                    <table class="options-table">
                        <tr>
                            <td align="left"><input type="radio" name="submission" value="upload" checked="true"/><span class="download-option">Upload</span>
                            </td>
                            <td align="left"><input type="radio" name="submission" value="fax"/><span class="download-option">Fax</span></td>
                            <td align="left"><input type="radio" name="submission" value="mail"/><span class="download-option">Mail</span></td>
                        </tr>

                        <tr>
                            <td align="left">
                                <input type="radio" name="submission" value="email"/>
                                <span class="download-option">Email</span>
                            </td>
                            <td align="left">
                                <input type="radio" name="submission" value="text"/>
                                <span class="download-option">Text Message</span>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                    </p>
                    <!-- p>
                        Instructions to fully complete your document submissions will follow on the next page.
                    </p -->
                </div>
            </div>
            <div class="modal-footer">
                <div class="buttons-wrapper">
                    <input type="button" onclick="Assist.submitForm()" class="btn btn-primary" value="Submit"/>
                </div>
            </div>
        </div>
    </form>
    
    <?php } ?>

    <?php endif; ?>
</div>


<div id="modal-no-service" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2>No Service in Your Area</h2>
    </div>
    <div class="modal-body">
        <div class="body">
            <p>
                Sorry, but Assist Wireless is not currently available in your area. Check back at a later time.
            </p>
        </div>
    </div>

    <div class="modal-footer">
        <div class="buttons-wrapper">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>

</div>

<div id="modal-existing-line" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2>Sorry, Only One Lifeline Benefit per Household</h2>
    </div>
    <div class="modal-body">
        <div class="body">
            <p>
                We cannot fill your request. There can only be one Lifeline benefit per eligible household.
            </p>
        </div>
    </div>

    <div class="modal-footer">
        <div class="buttons-wrapper">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>

<div id="modal-validation" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2>Please Correct The Following Errors</h2>
    </div>
    <div class="modal-body">
        <div class="body"></div>
    </div>

    <div class="modal-footer">
        <div class="buttons-wrapper">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>

<div id="bs-modal-email" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2>Email</h2>
    </div>
    <div class="modal-body">
        <div class="body">
	        Send an email with ENROLL <? echo $enrollmentId ?> as the SUBJECT to <a href="mailto:neworders@assistwireless.com">neworders@assistwireless.com</a> with a picture of your Photo ID and Eligibility Document attached.
            <br /><br /><a href="#">I Emailed My Documents</a>
	    </div>
    </div>

    <div class="modal-footer">
        <div class="buttons-wrapper">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>

<div id="bs-modal-mail" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2>Mail</h2>
    </div>
    <div class="modal-body">
        <div class="body">
			Mail a copy of your Photo ID and Eligibility Document with <? echo $enrollmentId ?> written on it to Assist Wireless, Attn: New Sales, 2402 Gravel Dr, Fort Worth, TX 76118. 
            <br /><br /><a href="/enrollment-thankyou/">I Mailed My Documents.</a>
		</div>
    </div>

    <div class="modal-footer">
        <div class="buttons-wrapper">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>

<div id="bs-modal-mms" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2>MMS</h2>
    </div>
    <div class="modal-body">
        <div class="body">
	        Send an MMS message(s) containing ENROLL <span class="enrollment-id"><? echo $enrollmentId ?></span> to 343434 with a picture of your Photo ID and Eligibility Document attached.
            <br /><br /><a href="/enrollment-thankyou/">I Sent a Text Message.</a>
        </div>
    </div>

    <div class="modal-footer">
        <div class="buttons-wrapper">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>

                    
<div id="bs-modal-fax" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2>Fax</h2>
    </div>
    <div class="modal-body">
        <div class="body">	                
            Fax a copy of your Photo ID and Eligibility Documents with a COVER SHEET with <span class="enrollment-id"><? echo $enrollmentId ?></span> written on it to Toll-Free 1-877-447-7798. 
            <br /><br /><a href="/enrollment-thankyou/">I Faxed My Documents</a>
		</div>
    </div>

    <div class="modal-footer">
        <div class="buttons-wrapper">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>

<div id="bs-modal-upload" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 style="color:#fff">Please select your files below:</h3>
    </div>
    <div class="modal-body">
        <form id="file-upload-form" method="POST"   enctype="multipart/form-data">
            <input type="hidden" name="enrollmentId" value="<?= $enrollmentId ?>"/>
            <input type="hidden" name="fileupload" value="true"/>
            <input id="file1" type="file" name="documents[]"/>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="jQuery('#bs-modal-upload').modal('hide')">Close</a>
        <a href="#" onclick="Assist.addFile()" class="btn">Add Another File</a>
        <a href="#" onclick="Assist.uploadFiles()" class="btn btn-primary">Upload Files</a>
    </div>
</div>

<div id="modal-webcam" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 style="color:#fff">Use your webcam to capture your data now:</h3>
    </div>
    <div class="modal-body">
		<div id="camera"></div>
		<div id="camera-results"></div>
		<div><canvas id="canvas" height="240" width="320"></canvas></div>
    </div>
    <div class="modal-footer">
		<a href="#" onClick="take_snapshot()" id="camera-save" class="btn btn-primary">Take a picture instantly</a>
		<br /><br /><a href="/enrollment-thankyou/">I've taken my photos</a>
    </div>
</div>

<div id="modal-address" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h2>Was this your address?</h2>
    </div>

    <input type="hidden" id="m-address" name="m-address"/>
    <input type="hidden" id="m-apt" name="m-apt"/>
    <input type="hidden" id="m-city" name="m-city"/>
    <input type="hidden" id="m-state" name="m-state"/>
    <input type="hidden" id="m-zip" name="m-zip"/>


    <div class="modal-body">
        <div class="body" style="text-align:center;margin-top:20px;">
            <span id="address-loading">One moment please...</span>
            <span id="full-address" style="display:block;margin-bottom:15px"></span>
        </div>
    </div>

    <div class="modal-footer">
        <div class="buttons-wrapper">
            <input type="button" class="btn btn-primary" id="address-accept" onclick='Assist.AcceptAddress()'
                   data-dismiss="modal" value="That Is My Address"/>
            <input type="button" data-dismiss="modal" class="btn" value="Close"/>
        </div>
    </div>
</div>

</div>


<?php get_footer('enrollment'); ?>