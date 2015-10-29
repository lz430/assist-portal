<div id="sidebar">
    <div class="customer-actions">

<? if (get_post_type() == "locations") { ?>

        <div id="sidebar-apply-now" class="hidden-phone">

        	<img src="<?php bloginfo('template_url'); ?>/images/apply-now-sidebar-header.jpg"/>
            <div class="apply-now-body">
				<h4>Become a partner</h4>

				<p>Earn $3,000 or more a month as an Assist Wireless Partner.</p>

				<p>Call PayGo Distributors at <strong>(844)-55-PAYGO</strong> to get started</p>

				<div style="text-align:center"><a  href="/partner-application/"><img src="<?php bloginfo('template_url'); ?>/images/apply-now-sidebar-button.png" border="0"/></a></div>
            </div>
        </div>
<? } ?>
        <a class="action enroll" href="<?=get_permalink(265)?>">
            <div class="hidden-phone">
                <h4><strong>ENROLL</strong> in Lifeline Cell Phone Service</h4>

                <p>It only takes a few minutes to sign up.</p>
            </div>
            <strong>Enroll Now &raquo;</strong>
        </a>

        <a class="action upgrade" href="https://www.assistwireless.com/prepaid-plans/">
                <div class="hidden-phone">
                    <h4><strong>PREPAID</strong> Cell Phone Service</h4>
                    <p>No Contract. No Credit Check. No Bull.</p>
                </div>
                <strong>Check It Out &raquo;</strong>
            </a>

        <a class="action reload" href="https://assist.telcoprovider.com/oss/web/customerportal" target="_pay">
            <div class="hidden-phone">
                <h4><strong>RELOAD</strong> My Minutes</h4>

                <p>Add more minutes to your plan.</p>
            </div>
            <strong>Reload Now &raquo;</strong>
        </a>

        <a class="action pay" href="https://assist.telcoprovider.com/oss/web/customerportal" target="_pay">
            <div class="hidden-phone">
                <h4><strong>PAY</strong> My Bill</h4>

                <p>Pay your bill instantly online.</p>
            </div>
            <strong>Pay Now &raquo;</strong>
        </a>
    </div>
</div>