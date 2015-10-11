<?php

//require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
 

$submissionMethod = null;
if ($enrollment != null){
  $submissionMethod = $enrollment->submission_method;
  if ($submissionMethod == '')
      $submissionMethod = null;
}

?>

<li id="enrollment-step6" class="enrollment-step" style="display:<? echo $isReview ? "" : "none" ?>">
  <h2><span class="step">Step 6</span> Eligibility Documents</h2>

  <p><strong>Upload your eligibility documents to complete your enrollment!</strong></p>

  <p style="font-size:18px">
    Enrollment ID: <span  class="enrollment-status-label"><? echo $enrollmentId ?></span>
	&nbsp;&nbsp;&nbsp;&nbsp;
    Enrollment Status: <span class="enrollment-status-label">Pending</span>
  </p>

    
  <?if ($isCompletedUpload){ ?>
  <p>
    Thank you for completing the Assist Wireless Online Enrollment process! An Assist Wireless representative will be contacting you in the near future.
    If you did not choose to upload your documents now, you must choose to submit your Photo ID and
    Eligibility Document using one of the following submission options. Thank you!
  </p>

  <? } else { ?>

  <p class="thankyou-msg">
    Your personal information has been received, but your enrollment is not yet complete! All we need now is a copy of your Photo ID and proof of participation in a Government Program. <strong>Your application will NOT be approved until we receive your eligibility documents.</strong>
  </p>

  <? } ?>

  <hr />
  
  <h3>How do you submit proof?</h3>
  <p>Choose one of the methods below to upload and submit your eligibility documents:</p>

    <table style="width:100%;margin:auto;">
        <tr valign="top">
            <td>
                <div class="document-label">
	                <a href="#bs-modal-upload" data-toggle="modal"><img src="<?php bloginfo('template_directory') ?>/images/icn-upload.png" /></a>
                </div>
                <div class="document-details">
                    Upload a digital copy of your documents from your computer or phone.

                    <br /><a data-toggle="modal" class="enrollment-submit" role="button" href="#bs-modal-upload">Upload now > </a>
                </div>
            </td>
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-fax.png" />
                </div>
                <div class="document-details">
	                
	                Fax your documents.
	                
                    <br /><a data-toggle="modal" class="enrollment-submit" role="button" href="#bs-modal-mms">Learn how > </a>

                </div>
            </td>
        </tr>
        <tr valign="top">
            <?php if ( !$detect->isMobile() ) { ?>
            <td>
                <div class="document-label">
	                <a id="webcam-activate" href="#modal-webcam" data-toggle="modal"><img src="<?php bloginfo('template_directory') ?>/images/icn-webcam.png" /></a>
                </div>
                <div class="document-details">
					Take a photo of your documents using your computers webcam.

                    <br /><a id="webcam-activate2" data-toggle="modal" class="enrollment-submit" role="button" href="#modal-webcam">Take it now > </a>
                </div>
			</td>
			<?php } ?>
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-mail.png" />
                </div>
                <div class="document-details">
	                Mail your documents.

                    <br /><a data-toggle="modal" class="enrollment-submit" role="button" href="#bs-modal-mail">Learn how > </a>

                </div>
            </td>
        </tr>
        <tr valign="top">
            <td>
                <div class="document-label">
	                <a class='new-orders-email' href="mailto:neworders@assistwireless.com"><img src="<?php bloginfo('template_directory') ?>/images/icn-email.png" /></a>
                </div>
                <div class="document-details">
                    Send an email with your documents. 
                    
                    <br /><a data-toggle="modal" class="enrollment-submit" role="button" href="#bs-modal-email">Learn how > </a>
                                        
                </div>
            </td>
            <td>
                <div class="document-label">
	                <a class='new-orders-print' href="/lifeline.php?wpid=<? echo get_current_user_id(); ?>" target="_blank"><img src="<?php bloginfo('template_directory') ?>/images/icn-print2.png" /></a>
                </div>
                <div class="document-details">
                    Print Enrollment application for mailing or visiting a store 
                    
                    <br /><a class="enrollment-submit" role="button" target="_blank" href="/lifeline.php?wpid=<? echo get_current_user_id(); ?>">Print now > </a>
                                        
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-phone.png" />
                </div>
                <div class="document-details">
					Send a text MMS message with your documents.

                    <br /><a data-toggle="modal" class="enrollment-submit" role="button" href="#bs-modal-mms">Learn how > </a>
					
                </div>
            </td>
			<td>
			</td>
        </tr>
    </table>


		<!--
		<p style="text-align: center;">
			<a href="/lifeline.php?wpid=<? echo get_current_user_id(); ?>" target="_blank"  class="enrollment-status-label">
				<img src="<?php bloginfo('template_directory') ?>/images/icn-print.png" style="vertical-align: middle;" /> 
				Print Enrollment Application
			</a>
		</p>
		-->
		
		<!--
		<div class="document-container doc-upload">
			<span style="border-right: 1px solid rgb(177, 11, 31); display: inline-block; width: 20%; text-align: right; vertical-align: middle; height: 75px; line-height: 75px; margin: 25px 0px; font-weight: bold; color: rgb(177, 11, 31); padding: 0px 4% 0px 0px;">			
			Upload
			</span>
			<span style="display: inline-block; vertical-align: middle; text-align: center; padding: 0px 5%; width: 65%; margin: 25px 0px;">			
			Click below to upload a scanned or electronic copy of your Photo ID and Eligibility Document. (JPG, PNG, GIF, TIF or PDF)
			<p><a data-toggle="modal" class="enrollment-submit" role="button" href="#bs-modal-upload">Click to Upload</a>   </p>
			</span>
		</div>
		-->
		
    <span style="clear:both;display:block"></span>

	  <h3>Most common types of proof submitted:</h3>
	  
	  <table>
	  <tr valign="top">
		  <td>
			• Drivers License<br />
			• State ID<br />
			• Military ID<br />
			• Food Stamps/EBT Card or Award Letter
		  </td>
		  <td>
			• Medicaid Card<br />
			• Supplemental Security Income (SSI) Award Letter<br />
			• Section 8 or Federal Public Housing Assistance<br />
			• Low income Energy Assistance Program
		  </td>
	  </tr>
	  </table>

	  <h3>Need further assistance?</h3>

	  <p>Should you need help or assistance, contact out customer service line Toll-Free at 1-855-392-7747</p>

	
		<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"4012880"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>
		
		<!--
	    <div id="step6-button-wrapper">
	        <input id="step6-submit" onclick="Assist.submitForm()" type="button" class="enrollment-submit" value="Next"/>
	    </div>
		-->
		
      </div>

</li>