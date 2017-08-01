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
  WC()->session->set("remainingDataFloat", $BQ->get_remainingDataFloat());
  WC()->session->set("remainingData", $BQ->get_remainingData());
  WC()->session->set("remainingMinutes", $BQ->get_remainingMinutes());
  WC()->session->set("remainingText", $BQ->get_remainingText());
  $upForRecert = WC()->session->get("recert");
  // NOTE: Maybe we should consolidate and add the autopayEnabled method to the BQ_GetAirtimeBalance
  // or grab it in the header?
  $BQ = new BQ_CustomerProfile();
  $BQ->set_CustomerMdn(WC()->session->get("mdn"));
  $requestParams->id = Setting::CLEC_ID;
  $requestParams->firstName = Setting::CLEC_FIRSTNAME;
  $requestParams->lastName = Setting::CLEC_LASTNAME;
  $requestParams->details = $BQ;
  $request = $Api->buildRequest($requestParams);
  $Api->callAPI(Setting::URL, $request);
  $BQ->set_response($Api->response);

  WC()->session->set("autopayEnabled", $BQ->get_autopayEnabled());

  $days    = date("t");
  $dateEnd = WC()->session->get('daysLeft');

  $daysLeft = ($dateEnd / $days)*100;
  // echo "<pre>";
  // echo  print_r(WC()->session);
  // echo "</pre>";

  // NEW API
  // Note: The new methods are attached to the BQ_CustomerProfile object.
  WC()->session->set("lastInvoiceAmount", $BQ->get_lastInvoiceAmount());
  WC()->session->set("lastInvoiceAmountFloat", $BQ->get_lastInvoiceAmountFloat());
  WC()->session->set("lastInvoiceDueDate", $BQ->get_lastInvoiceDueDate());
  WC()->session->set("lastPaymentTransactionDate", $BQ->get_lastPaymentTransactionDate());
  
  $autopayenabled = WC()->session->get('autopayenabled');
  echo '<script>';
  echo 'var upForRecert = ' . json_encode($upForRecert) . ';';
  echo '</script>';
?>
<div class="portal-header">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 account-name">
        <h2>Hello <?php echo WC()->session->get("fullname"); ?></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 account-number">
        <h4><b>Account Number:</b> <?php echo WC()->session->get("customerId") ?> </h4>
        <h4><b>Phone Number:</b> <?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', WC()->session->get("mdn")); ?> </h4>
        <!-- <h4>Carrier: <?php //echo WC()->session->get("carrier"); ?> </h4> -->
    </div>
</div> <!-- end portal-header-->
<div class="clearfix"></div>
<div class="container account-balance-summary">
  <div class="row alerts-container">
    <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="warningText"></div>
    </div>
  </div><!-- end alerts-container -->
  
  <?php 
    if($autopayenabled === "N"){ //not enrolled
  ?>
  <div class="row notification-container">
    <!-- <div class="alert alert-info alert-dismissible" role="alert" style="display: block;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="warningText">We now offer auto payment. <a href="/auto-payment">Click here to enroll</a></div> -->
      <a href="/auto-payment"><img src="<?php echo get_template_directory_uri(); ?>/images/autopay-promo-banner-01.png" alt="Enroll in Autopay today"></a>
    </div> <!-- end notification-container -->
  <?php } else{ //enrolled?>  
    <div class="row notification-container">
      <!-- div class="alert alert-info alert-dismissible" role="alert" style="display: block;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="warningText">You are enrolled in auto-pay. <a href="/auto-payment">Click here</a> to unenroll.</div>
      </div> -->
      <!-- <img src="http://placehold.it/960x150/4CAF50/ffffff/?text=Enrolled!"> -->
    </div> <!-- end notification-container -->
  <?php } ?>
  <div class="row">
    <h3 class="center">Available Balances</h3>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 voice-balance summary-box">
      <i class="fa fa-mobile"></i>
      <h3>Voice</h3>
      <div id="gauge-minutes" class="gauge-container"></div>
      <h4><?php echo WC()->session->get("remainingMinutes") ?></h4>
      <a href="#" class="btn btn-primary top-up-voice" data-toggle="modal" data-target="#modalMinutes">Top Up</a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-balance summary-box"> 
      <i class="fa fa-comments"></i>
      <h3>Text</h3>
      <div id="gauge-text" class="gauge-container"></div>
      <h4><?php echo WC()->session->get("remainingText") ?></h4> 
      <a href="#" class="btn btn-primary top-up-text" data-toggle="modal" data-target="#modalText">Top Up</a> 
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 data-balance summary-box"> 
      <i class="fa fa-rss"></i>
      <h3>Data</h3>
      <div id="gauge-data" class="gauge-container"></div>
      <h4><?php echo WC()->session->get("remainingData") ?></h4> 
      <a href="#" class="btn btn-primary top-up-data" data-toggle="modal" data-target="#modalData">Top Up</a> 
    </div>
  </div><!-- end row-->
</div><!-- end account-balance-summary-->

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 summary-days-left">
  <div class="progress">
    <div class="progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="<?php echo number_format($daysLeft); ?>"
    aria-valuemin="0" aria-valuemax="31" style="width: <?php echo number_format($daysLeft); ?>%">
      <h4><?php echo WC()->session->get('daysLeft'); ?> day(s) left in period</h4>
    </div>
  </div>
</div>
<div class="row marketing-row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div id="sign-up">
      <!-- Begin MailChimp Signup Form -->
      <!-- <link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css"> -->
      <style type="text/css">
        /* #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; } */
        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
      </style>
      <div id="mc_embed_signup">
      <form action="//assistwireless.us16.list-manage.com/subscribe/post?u=b895bc8df7a669463bc35ba3a&amp;id=11ff801235" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <div id="mc_embed_signup_scroll">
            <label for="mce-EMAIL" style="text-align: center;">Sign up to receive special offers!</label>
            <input type="email" value="" name="EMAIL" class="email input-sm form-control" id="mce-EMAIL" placeholder="email address" required>
              <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
              <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_b895bc8df7a669463bc35ba3a_11ff801235" tabindex="-1" value=""></div>
              <div class="clearfix">
                <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">
                <div class="clearfix"></div>
              </div>
          </div>
      </form>
      </div>

      <!--End mc_embed_signup-->
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <img src="http://placehold.it/960x150/4CAF50/ffffff/?text=Marketing!">
  </div>
</div><!-- end row-->

<div class="container">
    <div class="row">
        <div class="account-summary col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h4>Plan &amp; Account Info</h4>
            <p><b>Enrolled Plan:</b>
                <?php echo WC()->session->get('planName'); ?>
            </p>
            <!-- NEW API -->
            <p><b>Last Invoice: </b><?php echo WC()->session->get("lastInvoiceAmount") ?></p>
            <!-- <p><b>Last Invoice (Float): </b><?php echo WC()->session->get("lastInvoiceAmountFloat") ?></p> -->
            <p><b>Last Invoice Due Date: </b><?php echo WC()->session->get("lastInvoiceDueDate") ?></p>
            <p><b>Last Payment Transaction Date: </b><?php echo WC()->session->get("lastPaymentTransactionDate") ?></p>
            <p><b>Current Balance:</b>
                <?php echo WC()->session->get('balance'); ?>
            </p>
            <p><b>Past Due Balance:</b>
                <?php echo WC()->session->get('balancePastDue'); ?> <br>
                <a href="<?php echo "/make-payment/?paymentAmount=" . (string)WC()->session->get('balanceFloat'); ?>" class="btn btn-primary make-payment">Make Payment</a>
            </p>
        </div>
        <div class="balance col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
          <img src="<?php bloginfo('template_url'); ?>/images/portal-image-1.png" alt="Ad space"> 
        </div> <!-- end balance-->
    </div><!-- end row-->
</div><!-- end container-->
<!-- Button trigger modal -->
<!-- Modal for Minutes-->
<div class="modal fade" id="modalMinutes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Top Ups</h4>
      </div>
      <div class="modal-body">
        <?php 
          // http://stackoverflow.com/a/30978923
          $args = array(
              'posts_per_page' => -1,
              'product_cat' => 'voice-minutes',
              'post_type' => 'product',
              'orderby' => 'meta_value_num',
              'meta_key' => '_price',
              'order' => 'asc'
          );
          // Product SKUs vary based on the carrier
          $args['product_tag'] = WC()->session->get("carrier");
          $the_query = new WP_Query( $args );
          // The Loop
          while ( $the_query->have_posts() ) {
            $the_query->the_post();
            wc_get_template_part( 'content', 'product-modal' );
            // woocommerce_template_loop_add_to_cart();
          }
          wp_reset_postdata();
        ?>
         <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal for Text-->
<div class="modal fade" id="modalText" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Top Ups</h4>
      </div>
      <div class="modal-body">
        <?php 
        // http://stackoverflow.com/a/30978923
        $args = array(
            'posts_per_page' => -1,
            'product_cat' => 'text-messages',
            'post_type' => 'product',
            'orderby' => 'meta_value_num',
            'meta_key' => '_price',
            'order' => 'asc'
        );
        // Product SKUs vary based on the carrier
        $args['product_tag'] = WC()->session->get("carrier");
        $the_query = new WP_Query( $args );
        // The Loop
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          wc_get_template_part( 'content', 'product-modal' );
          // woocommerce_template_loop_add_to_cart();
        }
        wp_reset_postdata();
         ?>
         <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal for Data-->
<div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Top Ups</h4>
      </div>
      <div class="modal-body">
        <?php 
        // http://stackoverflow.com/a/30978923
        $args = array(
            'posts_per_page' => -1,
            'product_cat' => 'data',
            'post_type' => 'product',
            'orderby' => 'meta_value_num',
            'meta_key' => '_price',
            'order' => 'asc'
        );
        // Product SKUs vary based on the carrier
        $args['product_tag'] = WC()->session->get("carrier");
        
        $the_query = new WP_Query( $args );
        // The Loop
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          wc_get_template_part( 'content', 'product-modal' );
          // woocommerce_template_loop_add_to_cart();
        }
        wp_reset_postdata();
         ?>
         <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Modal for Recertification -->
<div class="modal fade" id="modalRecert" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">URGENT!</h4>
      </div>
      <div class="modal-body">
        <h1>Your account is due for annual recertification.</h1>
        <p>You must prove lifeline eligibility annually to keep your lifeline service active according to FCC regulations. Failure to prove eligibility annually will result in disconnection of your wireless services.</p>
        <h2>Recertifying is EASY!</h2>
        <a href=" https://www.assistwireless.com/annual-recertification/" target="_blank" class="btn btn-warning">More Info</a>
        <a href="" class="btn btn-primary pull-right" id="recertifyIframe">Recertify Now</a>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Do not remove -->
</div>
</div>
</div>
<!-- Do not remove -->
<script>
  jQuery(document).ready(function(){
    var remainingMinutes            = "<?php echo WC()->session->get('remainingMinutes') ?>";
    var remainingText               = "<?php echo WC()->session->get('remainingText') ?>";
    var remainingData               = "<?php echo WC()->session->get('remainingData') ?>";
    var remainingDataUnformatted    = "<?php echo WC()->session->get('remainingDataFloat') ?>";
    /* -------------------------------------- *\
        Convert everything to numbers
    \* -------------------------------------- */
    remainingMinutes = remainingMinutes.replace(/\,/g,'');
    remainingMinutes = parseInt(remainingMinutes, 10);
    remainingText = remainingText.replace(/\,/g,'');
    remainingText = parseInt(remainingText, 10);
    remainingData = remainingData.replace(/\,/g,'');
    remainingData = parseInt(remainingData, 10);
    // Minutes Gauge
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
    // Text Gauge
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
    // Data gauge
    var gg3 = new JustGage({
      id: "gauge-data",
      value : remainingDataUnformatted,
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
