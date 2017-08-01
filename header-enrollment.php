<!DOCTYPE html>
<html>
<head>
<meta name="google-site-verification" content="eqC11EZVvKSqL_v2nldcQCvtmCNTnXA_oxFR1CP5_So" />
<title><?php wp_title(''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('template_url'); ?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/ico/favicon.gif">
    <?php  wp_head();  ?>
    <?
        require_once 'Mobile_Detect.php';
        $detect = new Mobile_Detect;
    ?>
    <?php if (!$detect->isMobile()) { ?>
        <script src="<?php bloginfo('template_url'); ?>/js/livehelp.js" type="text/javascript" charset="utf-8"></script>
    <? } ?>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory') ?>/fonts/font.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory') ?>/lib/jquery.fancybox.css" />
    <!--[if lt IE 9]>
    <link href="<?php bloginfo('template_url'); ?>/css/ie8.css" rel="stylesheet">
    <![endif]-->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-26605431-1']);
        _gaq.push(['_trackPageview']);
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script><!-- Quantcast Tag -->
    <script type="text/javascript">
        var _qevents = _qevents || [];
        (function() {
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
    <!-- End Quantcast tag -->
<!--Bing Contact Us Conversion Code-->
<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"4012877"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>
<style>
.tp-caption.big_text {
	font-family:'ariblk'!important;
	font-size:45px!important;
	line-height:52px!important;
	color:#000!important;
	letter-spacing: -2.5px;
}
.tp-caption.md_text {
	font-family:Arial!important;
	font-size:16px!important;
	line-height:24px!important;
	color:#000!important;
}
</style>
</head>
<body <?php body_class(); ?>>
<div id="page" class="container">
    <header id="header">
        <a class="brand pull-left hidden-phone" href="<?php bloginfo('url'); ?>"><?=bloginfo('name')?></a>
        <div class="navbar navbar-static-top hidden-desktop hidden-tablet">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php bloginfo('url'); ?>"><?=bloginfo('name')?></a>
                    <div class="nav-collapse collapse">
                        <?php wp_nav_menu(
                            array(  'theme_location' => 'mobile-menu',
                                    'container_class'=>'nav',
                                    'menu_id' => 'navbar-menu-header-menu')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-desktop hidden-tablet"></div>
        <div class="contact pull-left sales">
            <label>Toll Free Sales</label>
            <a href="callto:8554202449">1-855-420-2449</a>
        </div>
        <div class="contact pull-left customer-service">
            <label>Toll Free Customer Service</label>
            <a href="callto:8553927747">1-855-392-7747</a>
        </div>
        <span style="display:block;height:20px"></span>
        <!-- a href="<?=get_permalink(83)?>" class="cart-link pull-right">Shopping Cart</a -->
        <div id="lhnContainer" class="pull-right hidden-phone hidden-tablet"><div id="lhnChatButton">
            <script type="text/javascript">
    var lhnAccountN = "10805-1";
    var lhnButtonN = 5140;
    var lhnChatPosition = 'default';
    var lhnInviteEnabled = 1;
    var lhnWindowN = 0;
    var lhnDepartmentN = 0;
</script>
<a href="http://www.livehelpnow.net/products/live-chat-system" target="_blank" style="font-size:10px;" id="lhnHelp">Chat Support Software</a>
<script src="//commondatastorage.googleapis.com/lhn/chat/scripts/lhnchatbutton-current.min.js" type="text/javascript" id="lhnscript"></script>
        </div></div>
        <div class="clearfix"></div>
        <!--<p class="pull-right disclaimer hidden-phone hidden-tablet"><?= bloginfo('description')?></p>-->
    </header>
    <div class="clearfix"></div>
    <div class="hidden-phone">
		<div id="enrol-bar">
			LIFELINE ENROLLMENT APPLICATION <span>|</span>
			Get your FREE phone now! <span>|</span>
			No Contract! No Credit Check!
		</div>
    </div>