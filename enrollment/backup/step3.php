<li id="enrollment-step3" class="enrollment-step" style="display:none">
    <h2><span class="step">Step 3</span> Plan Selection</h2>

    <p class="intro">
        Please select a plan below.
    </p>

    <div id="plans-table">
        <ul class='plans-header'>
            <li class="checkbox">&nbsp;</li>
            <li class="name">Plan Description</li>
            <li class="activation-cost">Activation Cost</li>
            <li class="monthly-cost">Monthly Cost</li>
            <li class="minutes">Minutes</li>
            <li class="rollover">Rollover</li>
            <li class="txts">TXTs to Minutes</li>
        </ul>
        <div class="clearfix"></div>
        <?
        $sql = "select * from plans where active = 1 order by states, sort ";
        $rows = $wpdb->get_results($sql, ARRAY_A);

        foreach ($rows as $row) {
            ?>
            <ul class="plans-row <?= $row['states'] ?>">
                <li class="checkbox">
                    <input type="radio" name="plan" value="<?=htmlspecialchars($row['description']) ?>"  <? if ($enrollment->plan == $row['description']) {
                        echo "checked='checked'";
                    } ?>/>
                </li>
                <li class="name"><?=htmlspecialchars($row['description']) ?></li>
                <li class="activation-cost"><label>Activation Cost: </label><?=htmlspecialchars($row['activation_cost']) ?></li>
                <li class="monthly-cost"><label>Monthly Cost: </label><?=htmlspecialchars($row['monthly_cost']) ?></li>
                <li class="minutes"><label>Minutes: </label><?=htmlspecialchars($row['minutes']) ?></li>
                <li class="rollover"><label>Rollover: </label><?=htmlspecialchars($row['rollover']) ?></li>
                <li class="txts"><label>TXT to Minutes:</label><?= htmlspecialchars($row['txt_to_minutes']) ?></li>
            </ul>
            <div class="clearfix"></div>
            <?
        }
        ?>
        </div>
        <div id="step3-button-wrapper">
            <input id="step3-disagree" onclick="Assist.next('enrollment-step2')" type="button" class="enrollment-submit" value="Back"/>
            <input id="step3-agree" onclick="Assist.step3Agree()" type="button" class="enrollment-submit" value="Next"/>
        </div>
</li>