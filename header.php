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
        if (false) {
            if( !is_admin() ) {
                // Set
                // $data = 'Hello, world!';
                // WC()->session->set('key', $data);
                // Get
                echo "<pre>";
                // echo(WC()->session->get('key'));
                echo(print_r(WC()->session));
                echo "</pre>";
            }
        }
        $user_ID = get_current_user_id();
        $customerId = get_field('field_561b01c3cecfb', 'user_' . $user_ID);
        $session_customerId = WC()->session->get('customerId');
        // If the sessions doesn't already exist... go get it from API
        if ($customerId && $session_customerId == '') {
            include_once(TEMPLATEPATH . "/portal/api/Api.php");
            include_once(TEMPLATEPATH . "/portal/api/Setting.php");
            include_once(TEMPLATEPATH . "/portal/api/RequestParams.php");
            include_once(TEMPLATEPATH . "/portal/api/BQ_Base.php");
            include_once(TEMPLATEPATH . "/portal/api/BQ_CustomerProfile.php");
            include_once(TEMPLATEPATH . "/portal/api/BQ_GetAirtimeBalance.php");
            $Api = new Api();
            $requestParams = new requestParams();
            $BQ = new BQ_CustomerProfile();
            $BQ->set_CustomerId($customerId);
            $requestParams->id = Setting::CLEC_ID;
            $requestParams->firstName = Setting::CLEC_FIRSTNAME;
            $requestParams->lastName = Setting::CLEC_LASTNAME;
            $requestParams->details = $BQ;
            $request = $Api->buildRequest($requestParams);
            $Api->callAPI(Setting::URL, $request);
            $BQ->set_response($Api->response);
            WC()->session->set('fullname', $BQ->get_fullname());
            WC()->session->set('customerId', $customerId); // $BQ->get_customerId()
            WC()->session->set('balance', $BQ->get_balance());
            WC()->session->set('balanceFloat', $BQ->get_balanceFloat());
            WC()->session->set('balancePastDue', $BQ->get_balancePastDue());
            
            WC()->session->set('planName', (string)$BQ->get_planName());
            WC()->session->set('planPrice', (string)$BQ->get_planPrice());
            WC()->session->set('mdn', $BQ->get_telephoneNumber1());
            WC()->session->set('daysLeft', $BQ->get_daysLeft());
            WC()->session->set('carrier', $BQ->get_carrier());
            // $_SESSION['fullname'] = WC()->session->get('fullname');
            // $_SESSION['customerId'] = WC()->session->get('customerId');
            // $_SESSION['balance'] = WC()->session->get('balance');
            // $_SESSION['balancePastDue'] = WC()->session->get('balancePastDue');
            // $_SESSION['planName'] = "TBD";
            // $_SESSION['planPrice'] = "TBD";
            // $_SESSION['mdn'] = WC()->session->get('mdn');
            // $_SESSION['daysLeft'] = WC()->session->get('daysLeft');
            // $_SESSION['fullname'] = $BQ->get_fullname();
            // $_SESSION['customerId'] = $BQ->get_customerId();
            // $_SESSION['balance'] = $BQ->get_balance();
            // $_SESSION['balancePastDue'] = $BQ->get_balancePastDue();
            // $_SESSION['planName'] = $BQ->get_planName();
            // $_SESSION['planPrice'] = $BQ->get_planPrice();
            // $_SESSION['mdn'] = $BQ->get_telephoneNumber1();
            // $_SESSION['daysLeft'] = $BQ->get_daysLeft();
        }
     ?>
        <div id="page" class="container">
            <header id="header">
                <a class="brand col-lg-2 col-md-2 col-sm-2 col-xs-12" href="http://assistwireless.com">
                    <?=bloginfo('name')?>
                </a>
                <div class="customer-name pull-right col-xs12">
                    <?php
                        if ( $user_ID ) {
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'upper-menu',
                                    'container_class'=>'menu-top-menu-container',
                                    'menu_id' => 'menu-top-menu'
                                )
                            ); 
                        }// else do nothing
                     ?>
                     <div class="contact pull-right customer-service">
                        <label>Toll Free Sales and Customer Service</label>
                        <a href="tel:8553927747">1-855-392-7747</a>
                    </div>
                </div>
                <div class="clearfix"></div>
               <!--  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2><?php echo WC()->session->get('fullname')?></h2>
                    <p><a href="/customer-logout" class="log">Log Out</a></p>
                </div> -->
               <!--  <div class="navbar navbar-static-top">
                    <div class="navbar-inner">
                        <div class="container">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>
                            <div class="collapse navbar-collapse">
                                <?php 
                                    wp_nav_menu(
                                    array(  
                                        'theme_location' => 'header-menu',
                                        'container_class'=>'nav navbar-nav',
                                        'menu_id' => 'menu-header-menu',
                                    )); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="clearfix hidden-desktop hidden-tablet"></div>
                <div class="contact pull-left sales"></div>
                
            </header>
            <div class="clearfix"></div>