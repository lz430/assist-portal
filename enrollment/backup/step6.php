<?php

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
        <tr>
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-upload.png" />
                </div>
                <div class="document-details">
                    Upload a digital copy of your documents from your computer or phone.
                </div>
            </td>
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-phone.png" />
                </div>
                <div class="document-details">
                    Send an MMS message(s) containing ENROLL <span class="enrollment-id"><? echo $enrollmentId ?></span> to 343434 with a picture of your Photo ID and Eligibility Document attached.
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-webcam.png" />
                </div>
                <div class="document-details">
					<a href="#modal-webcam" role="button" class="enrollment-submit" data-toggle="modal">Take a photo</a> of your documents using your computers webcam, then upload them »
                </div>
			</td>
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-fax.png" />
                </div>
                <div class="document-details">
                    Fax a copy of your Photo ID and Eligibility Documents with a COVER SHEET with <span class="enrollment-id"><? echo $enrollmentId ?></span> written on it to Toll-Free 1-877-447-7798.
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-email.png" />
                </div>
                <div class="document-details">
                    Send an email with ENROLL <span class="enrollment-id"><? echo $enrollmentId ?></span> as the SUBJECT to <a class='new-orders-email' href="mailto:neworders@assistwireless.com">neworders@assistwireless.com</a> with a picture of your Photo ID and Eligibility Document attached
                </div>
            </td>
            <td>
                <div class="document-label">
	                <img src="<?php bloginfo('template_directory') ?>/images/icn-mail.png" />
                </div>
                <div class="document-details">
                    Mail a copy of your Photo ID and Eligibility Document with <span class="enrollment-id"><? echo $enrollmentId ?></span> written on it to Assist Wireless, Attn: New Sales, 2402 Gravel Dr, Fort Worth, TX 76118.
                </div>
            </td>
        </tr>
    </table>


		<p style="text-align: center;">
			<a href="/lifeline.php?uid=<? echo $uid ?>" target="_blank"  class="enrollment-status-label">
				<img src="<?php bloginfo('template_directory') ?>/images/icn-print.png" style="vertical-align: middle;" /> 
				Print Enrollment Application
			</a>
		</p>

      <div class="document-container doc-upload">
          <div style="margin:25px">
                <div class="document-label">
                  Upload
                </div>
                <div class="document-details">
                  Click below to upload a scanned or electronic copy of your Photo ID and Eligibility Document. (JPG, PNG, GIF, TIF or PDF)
				  <p><a href="#bs-modal-upload" role="button" class="enrollment-submit" data-toggle="modal">Click to Upload</a>   </p>
                </div>
          </div>
        <span style="clear:both;display:block"></span>
      </div>

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

    <div id="step6-button-wrapper">
        <input id="step6-submit" onclick="Assist.submitForm()" type="button" class="enrollment-submit" value="Next"/>
    </div>

</li>