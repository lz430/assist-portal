<?php /* <!-- Begin WordPress Cache (DO NOT MODIFY) --> *//* <!-- End WordPress Cache --> */ ?><div id="page-footer" class="hidden-phone" xmlns="http://www.w3.org/1999/html">
    <div class="row-fluid">
        <div class="pull-left company-info span7">
            <h5>Company Information</h5>
            <?php wp_nav_menu(array('theme_location' => 'page-footer-menu')); ?>
        </div>
        <div class="pull-right commercials span5 hidden-tablet">
            <h5><a href="<?=get_post_type_archive_link("commercials"); ?>">View Our Commercials</a></h5>

            <ul>
                <?
                query_posts(array(
                    'posts_per_page' => 3,
                    'post_type'      => 'commercials'
                ));
                while (have_posts()) : the_post();
                    ?>
                    <li>
                        <a href="<?=the_permalink()?>"><?= types_render_field("thumbnail", array("output"=> "html"))?></a>
                    </li>
                    <? endwhile; wp_reset_query(); ?>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</div>

<div id="footer" class="container">
    <div class="row-fluid">
        <div class="span2 hidden-phone">
            <a href="<?php bloginfo('url'); ?>">
                <img src="<?php bloginfo('template_url'); ?>/images/logo_footer.png" width="150" height="45" alt="<?=bloginfo('name')?>" title="<?=bloginfo('name')?>"/>
            </a>
        </div>

        <div class="locations span7 hidden-phone">
            <ul>
                <?
                $seen_cities = array();
                query_posts(array(
                    'posts_per_page' => 100,
                    'order'          => 'ASC',
                    'orderby'        => 'ID',
                    'post_type'      => 'locations'
                ));
                while (have_posts()) : the_post();
                    if (in_array(get_the_title(), $seen_cities)) {
                        continue;
                    }
                    $seen_cities[] = get_the_title();
                    ?>
                    <li><a href="<?=the_permalink()?>"><? the_title()?></a></li>
                    <? endwhile; wp_reset_query(); ?>
            </ul>
        </div>

        <div class="social span3">
            <p>Get Social with Assist Wireless</p>
            <ul class="pull-left">
                <li class="facebook"><a href="https://www.facebook.com/AssistWireless" target="_fb">Assist Wireless on Facebook</a></li>
                <li class="twitter"><a href="https://twitter.com/AssistWireless" target="_twitter">Assist Wireless on Twitter</a></li>
                <li class="linkedin"><a href="http://www.linkedin.com/company/2171239" target="_linked">Assist Wireless on LinkedIn</a></li>
            </ul>

            <!-- img class="pull-right bbb-logo" src="<?php bloginfo('template_url'); ?>/images/bbb_logo.png" width="46" height="45" alt="Better Business Bureau" title="Better Business Bureau"/ -->
            <div class="clearfix"></div>
            <p class="copyright">&copy;<?=date("Y")?> Assist Wireless. All Rights Reserved.<br/>
            </p>
        </div>
    </div>
</div>

<div id="mask"></div>

<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/lib/jquery.fancybox.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery(".fancybox").fancybox({
			width		: '533',
			height		: 'auto',
			autoSize	: false
		});
	});
</script>

<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-26605431-1']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'https://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);

    })();

</script><!-- Quantcast Tag -->

<script type="text/javascript">
    var _qevents = _qevents || [];

    (function () {
        var elem = document.createElement('script');
        elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
        elem.async = true;
        elem.type = "text/javascript";
        var scpt = document.getElementsByTagName('script')[0];
        scpt.parentNode.insertBefore(elem, scpt);
    })();

    _qevents.push({
        qacct:"p-96SKIBrYv1gqQ"
    });
</script>
</body>
</html>