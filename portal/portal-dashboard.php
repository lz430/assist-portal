<?php
  /*
  * * Template Name: Portal Dashboard 
  * * @package assist-portal 
  */
  get_header();
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
  $BQ->set_mdn(WC()->session->get("mdn"));

  $requestParams->id = Setting::CLEC_ID;
  $requestParams->firstName = Setting::CLEC_FIRSTNAME;
  $requestParams->lastName = Setting::CLEC_LASTNAME;
  $requestParams->details = $BQ;
  $request = $Api->buildRequest($requestParams);
  $Api->callAPI(Setting::URL, $request);
  $BQ->set_response($Api->response);

  WC()->session->set("remainingData", $BQ->get_remainingData());
  WC()->session->set("remainingMinutes", $BQ->get_remainingMinutes());
  WC()->session->set("remainingText", $BQ->get_remainingText());
?>
    <div class="portal-header">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 account-name">
            <h2>Hello <?php echo WC()->session->get("fullname") ?></h2>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 account-number">
            <h4>Account Number: <?php echo WC()->session->get("customerId") ?> </h4>
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
                <div id="gauge-minutes"></div>
                <h4><?php echo WC()->session->get("remainingMinutes") ?></h4>
                <a href="#" class="btn btn-primary top-up-voice">Top Up</a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-balance summary-box"> <i class="fa fa-comments"></i>
                <h3>Text</h3>
                <div id="gauge-text"></div>
                <h4><?php echo WC()->session->get("remainingText") ?></h4> <a href="#" class="btn btn-primary top-up-text">Top Up</a> </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 data-balance summary-box"> <i class="fa fa-rss"></i>
                <h3>Data</h3>
                <div id="gauge-data"></div>
                <h4><?php echo WC()->session->get("remainingData") ?></h4> <a href="#" class="btn btn-primary top-up-data">Top Up</a> </div>
        </div>
        <!-- end row-->
    </div>
    <!-- end account-balance-summary-->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 summary-days-left">
      <h4><?php echo WC()->session->get('daysLeft') ?></h4>
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
                    <?php echo WC()->session->get('balance') ?>
                </p>
                <p>Past Due Balance:
                    <?php echo WC()->session->get('balancePastDue') ?>
                </p>
            </div>
            <div class="balance col-lg-5 col-md-5 col-sm-5 col-xs-12"> <img src="https://placehold.it/450x150" alt="Ad space"> </div>
        </div>
        <!-- end row-->
    </div>
    <!-- end container-->

    <script>
      jQuery(document).ready(function(){
        var remainingMinutes = "<?php echo WC()->session->get('remainingMinutes') ?>";
        var remainingText    = "<?php echo WC()->session->get('remainingText') ?>";
        var remainingData    = "<?php echo WC()->session->get('remainingData') ?>";

        /* -------------------------------------- *\
            Convert everything to numbers
        \* -------------------------------------- */
        remainingMinutes = remainingMinutes.replace(/\,/g,'');
        remainingMinutes = parseInt(remainingMinutes, 10);

        remainingText = remainingText.replace(/\,/g,'');
        remainingText = parseInt(remainingText, 10);

        remainingData = remainingData.replace(/\,/g,'');
        remainingData = parseInt(remainingData, 10);

        console.log(remainingMinutes);
        
        var gg1 = new JustGage({
          id: "gauge-minutes",
          value : remainingMinutes,
          min: 0,
          max: 250,
          decimals: 0,
          hideInnerShadow: true,
          gaugeWidthScale: 0.8,
          customSectors: [{
            color : "#F44336",
            lo : 0,
            hi : 50
          },{
            color : "#FFEB3B",
            lo : 49,
            hi : 149
          }, {
            color : "#4CAF50",
            lo : 150,
            hi : 250
          }],
          counter: true
        });

        var gg2 = new JustGage({
          id: "gauge-text",
          value : remainingText,
          min: 0,
          max: 250,
          decimals: 0,
          hideInnerShadow: true,
          gaugeWidthScale: 0.8,
          customSectors: [{
            color : "#F44336",
            lo : 0,
            hi : 50
          },{
            color : "#FFEB3B",
            lo : 49,
            hi : 149
          }, {
            color : "#4CAF50",
            lo : 150,
            hi : 250
          }],
          counter: true
        });

        var gg3 = new JustGage({
          id: "gauge-data",
          value : remainingData,
          min: 0,
          max: 500,
          decimals: 0,
          hideInnerShadow: true,
          gaugeWidthScale: 0.8,
          customSectors: [{
            color : "#F44336",
            lo : 0,
            hi : 100
          },{
            color : "#FFEB3B",
            lo : 101,
            hi : 249
          }, {
            color : "#4CAF50",
            lo : 250,
            hi : 500
          }],
          counter: true
        });
      });
    </script>

    <?php get_footer(); ?>
