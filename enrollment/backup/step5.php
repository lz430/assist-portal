<li id="enrollment-step5" class="enrollment-step" style="display:none">

  <h3>PLEASE READ THE FOLLOWING AND CHECK. BY SIGNING BELOW YOU ARE AGREEING TO THE FOLLOWING PROGRAM RULES.</h3>
  <p style="clear:both">
    <div style="float:left;width:25px;height:25px;">
      <input class="initial_list"  type="checkbox" value="true" id="initial1" name="initial1" <? if($enrollment->initial1) { echo "checked='checked'"; } ?>/>
    </div>
    I certify under penalty of perjury that I either participate in the indicated qualifying federal program or I meet the income qualification to establish
    my eligibility for Lifeline.
  </p>

  <p style="clear:both">
    <div style="float:left;width:25px;height:25px;">
      <input class="initial_list"  type="checkbox" value="true"  id="initial2" name="initial2"  <? if($enrollment->initial2) { echo "checked='checked'"; } ?>/>
    </div>
    If required to do so, I have provided accurate documentation of my eligibility.
  </p>

  <p style="clear:both">
    <div style="float:left;width:25px;height:35px;x">
      <input class="initial_list"  type="checkbox" value="true"  id="initial3" name="initial3"  <? if($enrollment->initial3) { echo "checked='checked'"; } ?>/>
    </div>
    I certify I am head of the household, I am not listed as a dependent on another person’s tax return (unless over the age of 60) and the address
    listed is my primary residence.
  </p>

  <p style="clear:both">
    <div style="float:left;width:25px;height:85px;">
      <input class="initial_list"  type="checkbox" value="true"  id="initial4" name="initial4"  <? if($enrollment->initial4) { echo "checked='checked'"; } ?>/>
    </div>
    I confirm local voice service discounts under the low income programs are limited to one per household and that my household is receiving no
    more than one Lifeline supported service. If I am participating in another Lifeline program at the time I apply for Assist Wireless Lifeline service, I
    agree to cancel that Lifeline service with any other provider. I certify that I will only receive one Lifeline connection, will not have simultaneous or
    multiple Lifeline discounts with another provider.
  </p>


    <h3>PLEASE READ THE FOLLOWING AND CHECK. BY SIGNING BELOW YOU ARE AGREEING TO THE FOLLOWING PROGRAM RULES.</h3>

    <p style="clear:both">
    <div style="float:left;width:25px;height:35px;">
        <input class="initial_list"  type="checkbox" value="true"  id="initial5" name="initial5"  <? if($enrollment->initial5) { echo "checked='checked'"; } ?>/>
    </div>
    I acknowledge that I may be required to re-certify my continued eligibility for Lifeline at any time, and that failure to do so will result in the
    termination of the my Lifeline benefits.

    </p>

    <p style="clear:both">
    <div style="float:left;width:25px;height:120px;">
        <input class="initial_list" type="checkbox" value="true"  id="initial6" name="initial6"  <? if($enrollment->initial6) { echo "checked='checked'"; } ?>/>
    </div>
    I understand that I must inform Assist Wireless within 30 days if I (1) no longer participate in a federal qualifying program or programs or my
    annual household income exceeds 135% of the Federal Poverty Guidelines; (2) I am receiving more than one Lifeline-supported service per
    household; or (3) I, for any other reason, no longer satisfy the criteria for receiving Lifeline support. I attest under penalty of perjury that I
    understand this notification requirement, and that I may be subject to penalties if I fail to follow this rule.
    </p>

    <p style="clear:both">
    <div style="float:left;width:25px;height:35px;">
        <input class="initial_list"  type="checkbox" value="true"  id="initial7" name="initial7"  <? if($enrollment->initial7) { echo "checked='checked'"; } ?>/>
    </div>
    I understand that Lifeline service is a non-transferable benefit, and that I may not transfer my service to any other individual, including another
    eligible low-income consumer.

    </p>

    <p style="clear:both">
    <div style="float:left;width:25px;height:95px;">
        <input class="initial_list" type="checkbox" value="true"  id="initial8" name="initial8"  <? if($enrollment->initial8) { echo "checked='checked'"; } ?>/>
    </div>
    I acknowledge and consent to the use of my name, telephone number, and address to be given to the Universal Service Administrative Company
    (USAC) (the administrator of the program) and/or its agents for the purpose of verifying that I ‘m not receive more than one Lifeline benefit. I
    understand that refusal to grant this permission will mean I am not eligible for Lifeline service. I also authorize Assist Wireless to access any
    records required to verify my statements herein and to confirm my continued eligibility for Lifeline assistance.
    </p>

    <p style="clear:both">
    <div style="float:left;width:25px;height:35px;">
        <input class="initial_list" id="initial9" type="checkbox" value="true" name="initial9"  <? if($enrollment->initial9) { echo "checked='checked'"; } ?>/>
    </div>
    I understand that if I move, I must provide a new address to Assist Wireless within 30 days of my move.
    </p>

    <p style="clear:both">
    <div style="float:left;width:25px;height:35px">
        <input class="initial_list"   id="initial10" type="checkbox" value="true" name="initial10"  <? if($enrollment->initial10) { echo "checked='checked'"; } ?>/>
    </div>
    I understand that if I provided a Temporary Address, I must verify with Assist Wireless every 90 days that I am using the same address. I
    understand that if I fail to do so, I will lose my Lifeline discount.

    </p>

    <div class="field-wrapper signature">
        <label>Signature (type) First and Last Name</label>
        <input class="stdText" type="text" name="signature" id="signature" maxlength="255" value="<?=$enrollment->signature?>"/>
    </div>

    <p>
    <div style="float:left;width:25px;height:90px">
        <input type="checkbox" name="signature-conf" value="True" <? if($enrollment->step > '3') { echo "checked='checked'"; } ?>/>
    </div>
    By entering my name above, I certify under penalty of perjury that I have read and understood this form and I attest the information, which I have provided in this application, is true and correct to the best of my knowledge and I acknowledge that providing false or fraudulent information to receive Lifeline benefits is punishable by law.
    </p>

    <h2>Lifeline Terms &amp; Conditions</h2>

    <p class="fine-print" style="height:100px;overflow:scroll;border:1px solid #ccc;padding:5px;">
        Lifeline benefits are federal benefits and Applicants that make false statements in order to obtain the Lifeline
        benefit can be punished by fine or imprisonment, de-enrollment or can be barred from the program. Only one Lifeline
        service is available per household. A household is defined, for purposes of the Lifeline program, as any individual or group of
        individuals who live together at the same address and share income and expenses. A household may not receive
        multiple Lifeline benefits from multiple providers. A violation of the one-per-household requirement constitutes
        a violation of the Federal Communication Commissions rules and will result in de-enrollment from the program,
        and could result in criminal prosecution by the United States government. The Lifeline benefit may be applied to
        either one landline or one wireless number, but cannot be applied to both. Note that not all Lifeline services
        are currently marketed under the name Lifeline.
    </p>

    <div class="acknowledge" >
        <div style="float:left;width:25px;height:25px;">
            <input type="checkbox" name="step5-ack1" <? if ($enrollment->step > '1') {
                echo "checked='checked'";
            } ?>/>
        </div>
        I understand and agree to the Terms &amp; Conditions of the Lifeline
        program and certify that I do not currently receive Lifeline service from another carrier or provider.
    </div>

    <h2>Assist Wireless Terms &amp; Conditions</h2>

    <p class="fine-print" style="height:100px;overflow:scroll;border:1px solid #ccc;padding:5px;">
        I certify under penalty of perjury that I either participate in the indicated qualifying federal program or I
        meet the income qualification to establish my eligibility for Lifeline. If required to do so, I have provided
        accurate documentation of my eligibility. I certify I am head of the household, I am not listed as a dependent
        on another person's tax return (unless over the age of 60) and the address listed is my primary residence. I
        confirm local voice service discounts under the low income programs are limited to one per household and that my
        household is receiving no more than one Lifeline supported service. If I am participating in another Lifeline
        program at the time I apply for Assist Wireless Lifeline service, I agree to cancel that Lifeline service with
        any other provider. I certify that I will only receive one Lifeline connection, will not have simultaneous or
        multiple Lifeline discounts with another provider. I acknowledge that I may be required to re-certify my
        continued eligibility for Lifeline at any time, and that failure to do so will result in the termination of the
        Lifeline benefits. I understand that I must inform Assist Wireless within 30 days if I (1) no longer participate
        in a federal qualifying program or programs or my annual household income exceeds 135% of the Federal Poverty
        Guidelines; (2) I am receiving more than one Lifeline supported service per household; or (3) I, for any other
        reason, no longer satisfy the criteria for receiving Lifeline support. I attest under penalty of perjury that I
        understand this notification requirement, and that I may be subject to penalties if I fail to follow this rule.
        I understand that Lifeline service is a non-transferable benefit, and that I may not transfer my service to any
        other individual, including another eligible low-income consumer. I acknowledge and consent to the use of my
        name, telephone number, and address to be given to the Universal Service Administrative Company (USAC) (the
        administrator of the program) and/or its agents for the purpose of verifying that I 'm not receiving more than
        one Lifeline benefit. I understand that refusal to grant this permission will mean I am not eligible for
        Lifeline service. I also authorize Assist Wireless to access any records required to verify my statements herein
        and to confirm my continued eligibility for Lifeline assistance. I understand that if I move, I must provide a
        new address to Assist Wireless within 30 days of my move. I understand that if I provided a Temporary Address, I
        must verify with Assist Wireless every 90 days that I am using the same address. I understand that if I fail to
        do so, I will lose my Lifeline discount. By my signature, I certify under penalty of perjury that I have read
        and understood this form and that I attest that the information contained in this application that I have
        provided is true and correct to the best of my knowledge and that I acknowledge that providing false or
        fraudulent information to receive Lifeline benefits is punishable by law.
    </p>

    <div class="acknowledge">
        <div style="float:left;width:25px;height:25px;">
            <input type="checkbox" name="step5-ack2" <? if ($enrollment->step > '1') {
                echo "checked='checked'";
            } ?>/>
        </div>
        I understand and agree to the Terms &amp; Conditions of this provider
        and agree to accept Lifeline service for 12 continuous months.
    </div>
    <div id="step5-button-wrapper">
        <input id="step5-disagree" onclick="Assist.next('enrollment-step4')" type="button" class="enrollment-submit" value="Back"/>
        <input id="step5-agree" onclick="Assist.step5Agree()" type="button" class="enrollment-submit" value="Next"/>
    </div>
</li>
