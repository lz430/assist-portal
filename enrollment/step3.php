<li id="enrollment-step3" class="enrollment-step" style="display:none">
    <h2><span class="step">Step 3</span> Plan Selection</h2>

    <p class="intro">
        Please select a plan below.
    </p>

    <div id="plans-table">
        <ul class='plans-header'>
            <li class="checkbox">&nbsp;</li>
            <li class="popular">&nbsp;</li>
            <li class="name">Plan</li>
            <li class="minutes">Talk</li>
            <li class="txts">Text/Data</li>
            <li class="monthly-cost">Monthly Cost</li>
        </ul>
        <div class="clearfix"></div>
        <?
        $sql = "select * from plans where active = 1 order by states, sort ";
        $rows = $wpdb->get_results($sql, ARRAY_A);
		$c = 1;
        foreach ($rows as $row) {
            ?>
            <ul class="plans-row <?php if($c === 1) { echo 'alt'; } ?> <?= $row['states'] ?> p<?= $row['id'] ?>">
                <li class="checkbox">
                    <input type="radio" name="plan" value="<?=htmlspecialchars($row['description']) ?>"  <? if ($enrollment->plan == $row['description']) {
                        echo "checked='checked'";
                    } ?>/>
                </li>
                <li class="popular">
                	<?php if($row['id'] == 10) { ?>
		            <img src="<?php bloginfo('template_url'); ?>/images/plans-popular.png" />
	                <?php }?>
                </li>
                <li class="name"><?=htmlspecialchars($row['description']) ?></li>
                <li class="minutes"><label>Talk: </label><?=htmlspecialchars($row['minutes']) ?></li>
                <li class="txts"><label>Text/Data:</label><?= htmlspecialchars($row['txt_to_minutes']) ?></li>
                <li class="monthly-cost"><label>Monthly Cost: </label><?=htmlspecialchars($row['monthly_cost']) ?></li>
            </ul>
            <div class="clearfix"></div>
            <?
	    $c++;
	    if($c > 2) { $c = 1; }
        }
        ?>
        </div>
        <div id="step3-button-wrapper">
            <input id="step3-disagree" onclick="Assist.next('enrollment-step2')" type="button" class="enrollment-submit" value="Back"/>
            <input id="step3-agree" onclick="Assist.step3Agree()" type="button" class="enrollment-submit" value="Next"/>
        </div>
</li>