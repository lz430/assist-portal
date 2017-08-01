<li id="enrollment-step2" class="enrollment-step" style="display:none">
  <h2><span class="step">Step 2</span> Enter Your Personal Information</h2>
  <p>
    Congratulations, your application for Lifeline supported cell phone service from Assist Wireless is pending approval. We need
    just a little more information to complete your application. Because Lifeline is a government supported program, we are required
    to gather personal information to identify you and approve your Lifeline service. Your information WILL NOT be shared with any outside party.
  </p>
  <h3>Personal Information</h3>
  <div class="field-wrapper">
    <label>First Name</label>
    <input class="stdText" type="text" name="first_name" id="fname" maxlength="255" value="<?=$enrollment->first_name?>"/>
  </div>
  <div class="field-wrapper">
    <label>Middle Initial</label>
    <input class="stdText" style="width:15px"  type="text" name="middle_initial" id="middle_initial" maxlength="1"  value="<?=$enrollment->middle_initial?>"/>
  </div>
  <div class="field-wrapper">
    <label>Last Name</label>
    <input class="stdText" type="text" name="last_name" id="last_name" maxlength="255" value="<?=$enrollment->last_name?>"/>
  </div>
  <div class="field-wrapper">
    <label>Date of Birth</label>
    <select name="dob-month" style="width:80px" id="dob-month" onchange="" size="1" orig-value="<?if($enrollment->dob != '0000-00-00') { echo substr($enrollment->dob,5,2); }?>">
      <option value="01">Jan</option>
      <option value="02">Feb</option>
      <option value="03">Mar</option>
      <option value="04">Apr</option>
      <option value="05">May</option>
      <option value="06">June</option>
      <option value="07">July</option>
      <option value="08">Aug</option>
      <option value="09">Sept</option>
      <option value="10">Oct</option>
      <option value="11">Nov</option>
      <option value="12">Dec</option>
    </select>
    <input style="width:60px" type="text" name="dob-day" id="dob-day" maxlength="2" value="<? if($enrollment->dob != '0000-00-00') { echo substr($enrollment->dob,8,2); }?>"/>
    <input style="width:64px" type="text" name="dob-year" id="dob-year" maxlength="4" value="<? if($enrollment->dob != '0000-00-00') { substr($enrollment->dob,0,4); }?>"/>
  </div>
  <div class="field-wrapper">
    <label>Last 4 of SSN or
      <br/>
      tribal ID Number</label>
    <input class="stdText" type="text" name="ssn" id="ssn" maxlength="4"  value="<?=$enrollment->ssn?>"/>
  </div>
  <div class="field-wrapper">
    <label>Email Address</label>
    <input class="stdText" type="text" name="email" id="second-email" maxlength="255" value="<?=$enrollment->email?>"/>
  </div>

  <div class="field-wrapper">
    <label>Phone Number (Optional)</label>
    <input class="stdText phone-mask" type="text" name="phone" id="phone" maxlength="255" value="<?=$enrollment->phone?>"/>
  </div>
  <p>
    Is your address a temporary residence?
    <br/>
    <input type="radio" name="temporary" value="True" <? if($enrollment->temporary) { echo "checked='checked'"; } ?>/>
    Yes
    <br/>
    <input type="radio" name="temporary" value="False" <? if($enrollment && !$enrollment->temporary) { echo "checked='checked'"; } ?>/>
    No
    <br/>
    <span style="font-size:11px;line-height:14px">If providing a temporary residential address in this application, you are required to contact Assist Wireless every 90 days to verify your temporary address.</span>
  </p>
  <p>
     Does more than one family live at your address?
    <br/>
    <input type="radio" name="share_household" value="True" <? if($enrollment->share_household) { echo "checked='checked'"; } ?>/>
    Yes
    <br/>
    <input type="radio" name="share_household" value="False" <? if($enrollment && !$enrollment->share_household) { echo "checked='checked'"; } ?>/>
    No
    <br/>
  </p>

  <h2>Household Information</h2>
  <p class="intro">
    <b>Thank you for accepting the Terms &amp; Conditions!</b> We will need to verify that you or
    someone in your home does
    not already receive Lifeline service and check whether your household qualifies for government supported cell
    phone services.
  </p>

  <p class="address-warning">
    Please Note: the address you enter <u>must</u> match the address on your identification documents.
  </p>

  <div class="field-wrapper">
    <label>Street Address (No P.O. Boxes)</label>
    <input class="stdText" type="text" name="address" id="address" maxlength="255" value="<?=$enrollment->address?>"/>
  </div>

  <div class="field-wrapper">
    <label>Apt/Unit/Other (Optional)</label>
    <input class="stdText" type="text" name="apt" id="apt" maxlength="255" value="<?=$enrollment->apt?>"/>
  </div>

  <div class="field-wrapper">
    <label>City</label>
    <input class="stdText" type="text" name="city" id="city" maxlength="255" value="<?=$enrollment->city?>"/>
  </div>

  <div class="field-wrapper">
    <label>State</label>
    <input type="hidden" name="state" id="state" value="<?=$enrollment->state?>"/>
    <span id="address-state"><?=$enrollment->state?></span>
  </div>

  <div class="field-wrapper">
    <label>Zip</label>
    <!-- input class="stdText" type="text" name="zip-code" id="zip-code" maxlength="5"/ -->
    <span id="address-zip"><?=$enrollment->zip?></span>
  </div>


  <div id="step2-button-wrapper">
    <input id="step2-quit" onclick="Assist.next('enrollment-step1')" type="button" class="enrollment-submit" value="Back"/>
    <input id="step2-submit" onclick="Assist.submitStep2()" type="button" class="enrollment-submit" value="Next"/>
  </div>

</li>
