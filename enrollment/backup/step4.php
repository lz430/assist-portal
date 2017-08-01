<li id="enrollment-step4" class="enrollment-step" style="display:none">
  <h2>Let's See if you qualify for Lifeline. </h2>
  <p>
    You may only select one qualifying eligibility method from below. You will need to send us a photo or scan of your eligibility document later.  If you qualify through multiple means, please select the option that you can prove eligibility most easily.
  </p>
  <h3>Eligibility Information</h3>
  <p>
    If you chose Income at or below 135% of FPG please select the income level you are at and how many people are in your household.
  </p>

  <div class="field-wrapper">
    <label>Select Program or Income</label>
    <select name="program" id="program" onchange='Assist.selectProgram()' orig-value="<?=$enrollment->program?>">
      <option value="">Select</option>
      <option>Income At or Below 135% of FPG</option>
      <option>Supplemental Security Income (SSI)</option>
      <option>Federal Housing Assistance (Section 8)</option>
      <option>Food Stamps (SNAP)</option>
      <option>Low Income Home Energy Assistance Program (LIHEAP)</option>
      <option>Medicaid</option>
      <option>Head Start Program</option>
      <option>Vocational Rehabilitation</option>
      <option>National School Lunch Free Program (NSL)</option>
      <option>Oklahoma Sales Tax Relief</option>
      <option>Food Distribution Program on Indian Reservations (FDPIR)</option>
      <option>Bureau of Indian Affairs General Assistance (BIA)</option>
      <option>Tribally-Administered Temporary Assistance to Needy Families (TTANF)</option>
    </select>
  </div>

  <div id="poverty-details" style="<? if ($enrollment->program != 'Income At or Below 135% of FPG') echo 'display:none' ?>">
    <div class="field-wrapper">
      <label># of People in Household</label>
      <select name="number_household" orig-value="<?=$enrollment->number_household?>">
        <option value="1" selected='true'>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
    </div>

    <div class="field-wrapper">
      <label>Annual Household Income</label>
      <input type="text" name="income" id="income" value="<?=$enrollment->income?>"/>
    </div>
  </div>

  <table border="0" cellspacing="0" cellpadding="0" style="<? if ($enrollment->program != 'Income At or Below 135% of FPG') echo 'display:none' ?>" class='poverty-table'  id="poverty-table">
    <thead>
      <tr class="bg">
        <th colspan="8" align="center" valign="middle">Annual Income at 135% of Federal Poverty Guideline - Number of Household Individuals</th>
      </tr>
    </thead>
    <tr class="bg">
      <th align="center" valign="middle" scope="col">1</th>
      <th align="center" valign="middle" scope="col">2</th>
      <th align="center" valign="middle" scope="col">3</th>
      <th align="center" valign="middle" scope="col">4</th>
      <th align="center" valign="middle" scope="col">5</th>
      <th align="center" valign="middle" scope="col">6</th>
      <th align="center" valign="middle" scope="col">7</th>
      <th align="center" valign="middle" scope="col">Addt'l</th>
    </tr>

    <tr>
      <td align="center" valign="middle">$15,889</td>
      <td align="center" valign="middle">$21,505</td>
      <td align="center" valign="middle">$27,121</td>
      <td align="center" valign="middle">$32,737</td>
      <td align="center" valign="middle">$38,353</td>
      <td align="center" valign="middle">$43,969</td>
      <td align="center" valign="middle">$49,585</td>
      <td align="center" valign="middle">+$5,616</td>
    </tr>

  </table>

  <div id="mobile-poverty-table" >
 		<div class="header">Annual Income at 135% of Federal Poverty Guideline - Number of Household Individuals</div>
 		<ul>
 			<li><label>1</label> $15,889</li>
 			<li><label>2</label> $21,505</li>
 			<li><label>3</label> $27,121</li>
 			<li><label>4</label> $32,737</li>
 			<li><label>5</label> $38,353</li>
 			<li><label>6</label> $43,969</li>
 			<li><label>7</label> $49,585</li>
 			<li><label>Addt'l</label> +$5,616</li>
 		</ul>
  </div>

  <p  style="height:100px;overflow:scroll;border:1px solid #ccc;padding:5px;">
    Lifeline is a government program that provides a monthly discount on home or mobile telephone services. Only ONE Lifeline discount is allowed per household. Members of a household are not permitted to receive Lifeline service from multiple telephone companies. Your household is everyone who lives together at your address as one economic unit (including children and people who are not related to you). The adults you live with are part of your economic unit if they contribute to and share in the income and expenses of the household. An adult is any person 18 years of age or older, or an emancipated minor (a person under age 18 who is legally considered to be an adult). Household expenses include food, health care expenses (such as medical bills) and the cost of renting or paying a mortgage on your place of residence (a house or apartment, for example) and utilities (including water, heat and electricity). Income includes salary, public assistance benefits, social security payments, pensions, unemployment compensation, veteran's benefits, inheritances, alimony, child support payments, worker's compensation benefits, gifts, and lottery winnings. Spouses and domestic partners are considered to be part of the same household. Children under the age of 18 living with their parents or guardians are considered to be part of the same household as their parents or guardians. If an adult has no income, or minimal income, and lives with someone who provides financial support to that adult, both people are considered part of the same household.
  </p>
  <p>
    Does your spouse or domestic partner currently receive Lifeline-discounted phone service? <span class="parens">(Check No if you do not have a spouse or partner)</span>
  </p>
  <div>
    <input type="radio" name="spouse" value="Yes" <? if($enrollment->spouse) { echo "checked='checked'"; } ?>/>
     Yes
    <br/>
    <input type="radio" name="spouse" value="No" <? if($enrollment && !$enrollment->spouse) { echo "checked='checked'"; } ?>/>
    No
    <br/>
  </div>
  <p>
    Other than a spouse or partner, do other adults <span class="parens">(people over the age of 18 or emancipated minors)</span> live with you at your address?
  </p>
  <div class="check-boxes">
    	<div>
      <input type="checkbox" name="other_adults" value="No" <? if(strpos($enrollment->other_adults,'No')===0 || strpos($enrollment->other_adults,'No')>0) { echo "checked='checked'"; } ?>/>
      No
      </div>
      <div>
      <input type="checkbox" name="other_adults" value="Parent" <? if(strpos($enrollment->other_adults,'Parent')===0 || strpos($enrollment->other_adults,'Parent')>0) { echo "checked='checked'"; } ?>/>
      Parent
     </div>
      <div>

      <input type="checkbox" name="other_adults" value="Adult Roommate" <? if(strpos($enrollment->other_adults,'Adult Roommate')===0 || strpos($enrollment->other_adults,'Adult Roommate')>0) { echo "checked='checked'"; } ?>/>
      Adult Roommate
      </div>
      <div>

      <input type="checkbox" name="other_adults" value="Adult Child" <? if(strpos($enrollment->other_adults,'Adult Child')===0 || strpos($enrollment->other_adults,'Adult Child')>0) { echo "checked='checked'"; } ?>/>
      Adult Child
      </div>
      <div>
      <input type="checkbox" name="other_adults" value="Other" <? if(strpos($enrollment->other_adults,'Other')===0 || strpos($enrollment->other_adults,'Other')>0) { echo "checked='checked'"; } ?>/>
      Other
      </div>

  </div>
  <p>
    Do you share living expenses <span class="parens">(bills, food, etc.)</span> and share income <span class="parens">(either your income, the other person's income or both incomes together)</span> with at least one of the adults listed above? <span class="parens">(Check No if you selected None from above)</span>
  </p>
  <div>
    <input type="radio" name="share_expenses" value="Yes"  <? if($enrollment->share_expenses) { echo "checked='checked'"; } ?>/>
    Yes
    <br/>
    <input type="radio" name="share_expenses" value="No"  <? if($enrollment && !$enrollment->share_expenses) { echo "checked='checked'"; } ?>/>
    No
    <br/>
  </div>

  <p>
    Please complete if benefits selected are in a name other than applicant - <span class="parens">(i.e. Free Lunch Program)</span>
  </p>
  <div class="field-wrapper" >
    <label style="width:90px;text-align:left">First Name</label>
    <input class="stdText" type="text" name="alt_fname" id="alt_fname" maxlength="20" value="<?=$enrollment->alt_fname?>"/>
  </div>
  <div class="field-wrapper">
    <label  style="width:90px;text-align:left">Middle Initial</label>
    <input class="stdText" style="width:15px" type="text" name="alt_mname" id="alt_mname" maxlength="1" value="<?=$enrollment->alt_mname?>"/>
  </div>
  <div class="field-wrapper">
    <label  style="width:90px;text-align:left">Last Name</label>
    <input class="stdText" type="text" name="alt_lname" id="alt_lname" maxlength="20" value="<?=$enrollment->alt_lname?>"/>
  </div>
  <div class="field-wrapper" style="margin-top:15px">
    <label>Initial</label>
    <input class="stdText" type="text" name="initial_text" id="initial_text" maxlength="20" length="3" style="width:50px" value="<?=$enrollment->initial_text?>"/>
  </div>
  <p>
    <div style="float:left;width:25px;height:70px">
      <input type="checkbox" name="fcc" <? if($enrollment && $enrollment->step > '3') { echo "checked='checked'"; } ?>/>
    </div> I understand that violation of the one-per-household requirement is against the Federal Communication Commission's rules and may result in me losing my Lifeline benefits, and potentially, prosecution by the United States government.
  </p>

  <div id="step4-button-wrapper">
    <input id="step4-quit" onclick="Assist.next('enrollment-step3')" type="button" class="enrollment-submit" value="Back"/>
    <input id="step4-submit" onclick="Assist.submitStep4()" type="button" class="enrollment-submit" value="Next"/>
  </div>

</li>