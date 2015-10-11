<?php

    $zip = null;
    if (isset($_REQUEST['home-zip'])){
        $zip = $_REQUEST['home-zip'];
    }

?>
<li id="enrollment-step1" class="enrollment-step" style="display:<? echo $isReview ? "none" : "" ?>">
    <h2><span class="step">Step 1</span> Enter Your Location</h2>

    <p class="intro">
        Start by entering your Zip Code. This will let you know if you qualify for Lifeline cell phone service from Assist Wireless.
    </p>

    <div class="control-group" style="margin-top:15px">
        <label class="control-label" for="zip">Zip Code</label>
        <div class="controls">
            <input class="input-block" type="text" name="zip" id="zip" maxlength="5" value="<?= $zip != null ? $zip : $enrollment->zip ?>"/>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="email">Email Address</label>
        <div class="controls">
            <input class="input-block" type="text" name="email" id="email" maxlength="255" value="<?=$enrollment->email?>"/>
        </div>
    </div>

    <div id="household-field-wrapper">
        Does anyone else in your house currently receive Lifeline?

        <input type="radio" name="household" id="household-yes" value="true" <? if ($enrollment->household) {
            echo "checked='checked'";
        } ?>/>
        <span class="radio-label">Yes</span>

        <input type="radio" name="household" id="household-no" value="false" <? if ($enrollment && !$enrollment->household) {
            echo "checked='checked'";
        } ?>/>
        <span class="radio-label">No</span>

    </div>

    <div id="step1-button-wrapper">
        <input id="step1-submit" onclick="Assist.submitStep1()" type="button" class="enrollment-submit" value="Search"/>
    </div>

    <div style="text-align:center">
        Please note: Do not use the back button at the top of this page during the online enrollment process or your
        order may not be complete.
    </div>
</li>