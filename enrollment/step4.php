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
    <div class="radio-block" style="display: block;">
	    <label>Select Program or Income</label><br />
    
	    <input type="radio" name="program" value="Food Stamps – Supplemental Nutrition Assistance Program (SNAP)">Food Stamps – Supplemental Nutrition Assistance Program (SNAP)<br>
	    <input type="radio" name="program" value="Medicaid">Medicaid<br>
	    <input type="radio" name="program" value="Supplemental Security Income (SSI)">Supplemental Security Income (SSI)<br>
	    <input type="radio" name="program" value="Federal Housing Assistance (Section 8)">Federal Housing Assistance (Section 8)<br>
	    <input type="radio" name="program" value="Low Income Home Energy Assistance Program (LIHEAP)">Low Income Home Energy Assistance Program (LIHEAP)<br>
	    <input type="radio" name="program" value="National School Lunch Program’s Free Lunch Program (NSL)">National School Lunch Program’s Free Lunch Program (NSL)<br>
	    <input type="radio" name="program" value="Temporary-Assistance for Needy Families (TANF)">Temporary-Assistance for Needy Families (TANF)<br>
	    <input type="radio" name="program" value="Bureau of Indian Affairs General Assistance (BIA)">Bureau of Indian Affairs General Assistance (BIA)<br>
	    <input type="radio" name="program" value="Food Distribution Program on Indian Reservations (FDPIR)">Food Distribution Program on Indian Reservations (FDPIR)<br>
	    <input type="radio" name="program" value="Tribally-Administered Temporary Assistance to Needy Families (TTANF)">Tribally-Administered Temporary Assistance to Needy Families (TTANF)<br>
	    <input type="radio" name="program" value="Head Start Program">Head Start Program<br>
	    <input type="radio" name="program" value="Income At or Below 135% of FPG">Income At or Below 135% of FPG<br>
    </div>        
  </div>

  <div id="step4-button-wrapper">
    <input id="step4-quit" onclick="Assist.next('enrollment-step3')" type="button" class="enrollment-submit" value="Back"/>
    <input id="step4-submit" onclick="Assist.submitStep4()" type="button" class="enrollment-submit" value="Next"/>
  </div>

</li>