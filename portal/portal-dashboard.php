<?php
  /*
  * * Template Name: Portal Dashboard 
  * * @package assist-portal 
  */
  get_header('portal');
  // TODO: Why doesn't this work?
  // Check in various folders if autoload doesn't work
  function __autoload($class_name) {
    
  }
  include_once(TEMPLATEPATH."/portal/api/Api.php");
  include_once(TEMPLATEPATH."/portal/api/Setting.php");
  include_once(TEMPLATEPATH."/portal/api/RequestParams.php");
  include_once(TEMPLATEPATH."/portal/api/BQ_Base.php");
  include_once(TEMPLATEPATH."/portal/api/BQ_CustomerProfile.php");
  include_once(TEMPLATEPATH."/portal/api/BQ_GetAirtimeBalance.php");
  $Api = new Api();
  $requestParams = new RequestParams();
  // TODO: Remove hard-coded values
  $BQ = new BQ_GetAirtimeBalance();
  // $BQ->set_esn($_SESSION["esn"]);
  $BQ->set_mdn($_SESSION["mdn"]);
  $requestParams->id = Setting::CLEC_ID;
  $requestParams->firstName = Setting::CLEC_FIRSTNAME;
  $requestParams->lastName = Setting::CLEC_LASTNAME;
  $requestParams->details = $BQ;
  $request = $Api->buildRequest($requestParams);
  $Api->callAPI(Setting::URL, $request);
  $BQ->set_response($Api->response);
  $_SESSION["remainingData"] = $BQ->get_remainingData();
  $_SESSION["remainingMinutes"] = $BQ->get_remainingMinutes();
  $_SESSION["remainingText"] = $BQ->get_remainingText();
?>
    <div class="portal-header">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <h2>Hello <?php echo $_SESSION["fullname"] ?></h2>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <h4>Account Number: <?php echo $_SESSION["customerId"] ?> </h4>
        </div>
    </div>
    <!-- end portal-header-->
    <div class="clearfix"></div>
    <div class="container-fluid account-balance-summary">
        <div class="row">
            <h3 class="center">Available Balances</h3>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 voice-balance summary-box">
                <i class="fa fa-mobile"></i>
                <h3>Voice</h3>
                <h4><?php echo $_SESSION["remainingMinutes"] ?></h4>
                <a href="#" class="btn btn-primary top-up-voice">Top Up</a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-balance summary-box"> <i class="fa fa-comments"></i>
                <h3>Text</h3>
                <h4><?php echo $_SESSION["remainingText"] ?></h4> <a href="#" class="btn btn-primary top-up-text">Top Up</a> </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 data-balance summary-box"> <i class="fa fa-rss"></i>
                <h3>Voice</h3>
                <h4><?php echo $_SESSION["remainingData"] ?></h4> <a href="#" class="btn btn-primary top-up-data">Top Up</a> </div>
        </div>
        <!-- end row-->
    </div>
    <!-- end account-balance-summary-->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 summary-days-left">
      <h4><?php echo $_SESSION['daysLeft'] ?></h4>
    </div>
    <div class="container">
        <div class="row">
            <div class="account-summary col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h4>Plan &amp; Account Info</h4>
                <p>Enrolled Plan:
                    <?php echo $_SESSION['planName'] ?>
                </p>
                <p>Monthly Fee:
                    <?php echo $_SESSION['planPrice'] ?>
                </p>
                <p>Current Balance:
                    <?php echo $_SESSION['balance'] ?>
                </p>
                <p>Past Due Balance:
                    <?php echo $_SESSION['balancePastDue']?>
                </p>
            </div>
            <div class="balance col-lg-5 col-md-5 col-sm-5 col-xs-12"> <img src="https://placehold.it/450x150" alt="Ad space"> </div>
        </div>
        <!-- end row-->
    </div>
    <!-- end container-->
    <?php get_footer(); ?>
