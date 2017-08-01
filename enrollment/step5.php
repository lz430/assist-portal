
    <li id="enrollment-step5" class="enrollment-step" style="display:none">

    <h3>PLEASE READ THE FOLLOWING AND CHECK. BY SIGNING BELOW YOU ARE AGREEING TO THE FOLLOWING PROGRAM RULES.</h3>
	
    <div style="clear:both">
        <input class="initial_list" type="checkbox" value="true" id="initial1" name="initial1" <? if($enrollment->initial1) { echo "checked='checked'"; } ?>> 
        <label style="opacity: 1;">I certify under penalty of perjury that I either participate in the indicated qualifying federal program or I meet the income qualification to establish my eligibility for Lifeline.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" type="checkbox" value="true" id="initial2" name="initial2" <? if($enrollment->initial2) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial1) { echo 'style="opacity: 1;"'; } ?>>If required to do so, I have provided accurate documentation of my eligibility.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" type="checkbox" value="true" id="initial3" name="initial3" <? if($enrollment->initial3) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial2) { echo 'style="opacity: 1;"'; } ?>>I certify I am head of the household, I am not listed as a dependent on another person’s tax return (unless over the age of 60) and the address listed is my primary residence.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" type="checkbox" value="true" id="initial4" name="initial4" <? if($enrollment->initial4) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial3) { echo 'style="opacity: 1;"'; } ?>>I confirm local voice service discounts under the low income programs are limited to one per household and that my household is receiving no more than one Lifeline supported service. If I am participating in another Lifeline program at the time I apply for Assist Wireless Lifeline service, I agree to cancel that Lifeline service with any other provider. I certify that I will only receive one Lifeline connection, will not have simultaneous or multiple Lifeline discounts with another provider.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" type="checkbox" value="true" id="initial5" name="initial5" <? if($enrollment->initial5) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial4) { echo 'style="opacity: 1;"'; } ?>>I acknowledge that I may be required to re-certify my continued eligibility for Lifeline at any time, and that failure to do so will result in the termination of the my Lifeline benefits.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" type="checkbox" value="true" id="initial6" name="initial6" <? if($enrollment->initial6) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial5) { echo 'style="opacity: 1;"'; } ?>>I understand that I must inform Assist Wireless within 30 days if I (1) no longer participate in a federal qualifying program or programs or my annual household income exceeds 135% of the Federal Poverty Guidelines; (2) I am receiving more than one Lifeline-supported service per household; or (3) I, for any other reason, no longer satisfy the criteria for receiving Lifeline support. I attest under penalty of perjury that I understand this notification requirement, and that I may be subject to penalties if I fail to follow this rule.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" type="checkbox" value="true" id="initial7" name="initial7" <? if($enrollment->initial7) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial6) { echo 'style="opacity: 1;"'; } ?>>I understand that Lifeline service is a non-transferable benefit, and that I may not transfer my service to any other individual, including another eligible low-income consumer.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" type="checkbox" value="true" id="initial8" name="initial8" <? if($enrollment->initial8) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial7) { echo 'style="opacity: 1;"'; } ?>>I acknowledge and consent to the use of my name, telephone number, and address to be given to the Universal Service Administrative Company (USAC) (the administrator of the program) and/or its agents for the purpose of verifying that I ‘m not receive more than one Lifeline benefit. I understand that refusal to grant this permission will mean I am not eligible for Lifeline service. I also authorize Assist Wireless to access any records required to verify my statements herein and to confirm my continued eligibility for Lifeline assistance.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" id="initial9" type="checkbox" value="true" name="initial9" <? if($enrollment->initial9) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial8) { echo 'style="opacity: 1;"'; } ?>>I understand that if I move, I must provide a new address to Assist Wireless within 30 days of my move.</label>
    </div>

    <div style="clear:both">
        <input class="initial_list" id="initial10" type="checkbox" value="true" name="initial10" <? if($enrollment->initial10) { echo "checked='checked'"; } ?>> 
        <label <? if($enrollment->initial9) { echo 'style="opacity: 1;"'; } ?>>I understand that if I provided a Temporary Address, I must verify with Assist Wireless every 90 days that I am using the same address. I understand that if I fail to do so, I will lose my Lifeline discount.</label>
    </div>

    <p>By clicking the E-Sign and Submit button you are electronically signing this form.</p>

    <div id="step5-button-wrapper">
        <p><input id="step5-agree" onclick="Assist.step5Agree()" type="button" class="enrollment-submit large" value="E-Sign &amp; Submit"></p>
    </div>

    <p><span style="font-size: 13px;">By clicking the E-Sign button above, I certify under penally of perjury that I have read and understood this form and i attest the information, which I have provided in this application, is true and correct to the best of my knowledge and i acknowledge that providing false or fraudulent information to receive Lifeline benefits is punishable by law.</span></p>

    <div id="step5-button-wrapper2">
        <input id="step5-disagree" onclick="Assist.next('enrollment-step4')" type="button" class="enrollment-submit" value="Back">
    </div>
    
    </li>
    