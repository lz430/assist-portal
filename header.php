<!DOCTYPE html>
<html>

<head>
    <meta name="google-site-verification" content="eqC11EZVvKSqL_v2nldcQCvtmCNTnXA_oxFR1CP5_So" />
    <title>
        <?php wp_title(''); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/ico/favicon.gif">
    <?php  wp_head();  ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory') ?>/fonts/font.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory') ?>/lib/jquery.fancybox.css" />
        <!--[if lt IE 9]>
    <link href="<?php bloginfo('template_url'); ?>/css/ie8.css" rel="stylesheet">
    <![endif]-->
        <!-- <script>
        jQuery(document).ready(function() {
            // hack for the why assist page
            jQuery('#steps-box').insertAfter('.page-title');
            var pos = jQuery(document).width()/2 - jQuery('#violator').width()/2;
            pos = pos - 20; // make sure it doesnt touch form field
            jQuery('#violator').animate({'left': pos + 'px'},2000);
        });
    </script>-->
</head>

<body <?php body_class(); ?>>
    <?php 
        include_once(TEMPLATEPATH . "/portal/api/Api.php");
        include_once(TEMPLATEPATH . "/portal/api/Setting.php");
        include_once(TEMPLATEPATH . "/portal/api/RequestParams.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_Base.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_CustomerProfile.php");
        include_once(TEMPLATEPATH . "/portal/api/BQ_GetAirtimeBalance.php");
        $Api = new Api();
        $requestParams = new requestParams();
        $BQ = new BQ_CustomerProfile();

        // $user_ID = get_current_user_id();
        // $customerId = get_field('customer_id', 'user_' . strval($user_ID));

        // TODO: Remove default value
        if ($customerId) {
            $BQ->set_CustomerId($customerId);
        } else {
            $BQ->set_CustomerId('11114262');
        }

        $requestParams->id = Setting::CLEC_ID;
        $requestParams->firstName = Setting::CLEC_FIRSTNAME;
        $requestParams->lastName = Setting::CLEC_LASTNAME;
        $requestParams->details = $BQ;
        $request = $Api->buildRequest($requestParams);
        $Api->callAPI(Setting::URL, $request);
        $BQ->set_response($Api->response);
        $_SESSION['fullname'] = $BQ->get_fullname();
        $_SESSION['customerId'] = $BQ->get_customerId();
        $_SESSION['balance'] = $BQ->get_balance();
        $_SESSION['balancePastDue'] = $BQ->get_balancePastDue();
        $_SESSION['planName'] = $BQ->get_planName();
        $_SESSION['planPrice'] = $BQ->get_planPrice();
        $_SESSION['mdn'] = $BQ->get_telephoneNumber1();
        $_SESSION['daysLeft'] = $BQ->get_daysLeft();

     ?>
        <div id="page" class="container">
            <header id="header">
                <a class="brand pull-left hidden-phone" href="<?php bloginfo('url'); ?>">
                    <?=bloginfo('name')?>
                </a>
                <div class="navbar navbar-static-top hidden-desktop hidden-tablet">
                    <div class="navbar-inner">
                        <div class="container">
                            <a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                            <a class="brand" href="<?php bloginfo('url'); ?>">
                                <?=bloginfo('name')?>
                            </a>
                            <div class="nav-collapse collapse">
                                <?php wp_nav_menu(
                            array(  'theme_location' => 'header-menu',
                                    'container_class'=>'nav',
                                    'menu_id' => 'navbar-menu-header-menu')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix hidden-desktop hidden-tablet"></div>
                <div class="contact pull-left sales"></div>
                <div class="customer-name pull-right">
                    <h2><?php echo $_SESSION['fullname']?></h2>
                    <h5><a href="/customer-logout" class="log">Log Out</a></h5>
                </div>
            </header>
            <div class="clearfix"></div>
            <div class="nav">
                <?php wp_nav_menu(array('theme_location' => 'header-menu', 'menu_id' => 'menu-header-menu')); ?>
            </div>
