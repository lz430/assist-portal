<?php
  /*
  * * Template Name: Portal Checkout
  * * @package assist-portal 
  */
function add_jquery_payment() {
  wp_enqueue_script( 'jquery_payment', get_template_directory_uri() . '/js/jquery.payment/jquery.payment.min.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'add_jquery_payment' );
  get_header();
  // TODO: Why doesn't this work?
  // Check in various folders if autoload doesn't work
  function __autoload($class_name) {
    
  }
  
  $sku = preg_replace("/[^0-9,.]/", "", $_GET["sku"]);
  if (isset($sku)) {
    include_once(TEMPLATEPATH . "/portal/api/Api.php");
    include_once(TEMPLATEPATH . "/portal/api/Setting.php");
    include_once(TEMPLATEPATH . "/portal/api/RequestParams.php");
    include_once(TEMPLATEPATH . "/portal/api/BQ_Base.php");
    include_once(TEMPLATEPATH . "/portal/api/BQ_CustomerManualInvoiceQuoteRequest.php");
    $Api = new Api();
    $requestParams = new requestParams();
    $BQ = new BQ_CustomerManualInvoiceQuoteRequest();
    $BQ->set_customerId(WC()->session->get('customerId'));
    $skus = array($sku);
    $BQ->set_Skus($skus);
    $requestParams->id = Setting::CLEC_ID;
    $requestParams->firstName = Setting::CLEC_FIRSTNAME;
    $requestParams->lastName = Setting::CLEC_LASTNAME;
    $requestParams->details = $BQ;
    $request = $Api->buildRequest($requestParams);
    $Api->callAPI(Setting::URL, $request);
    $BQ->set_response($Api->response);
    // echo '<pre>' . var_export( $BQ->get_tax_total(), true ) . '</pre>';
    // echo '<pre>' . var_export( $BQ->get_sku_description(), true ) . '</pre>';
    // echo '<pre>' . var_export( $BQ->get_sku_price(), true ) . '</pre>';
  }
?>
    <style type="text/css" media="screen">
      .has-error input {
        border-width: 2px;
      }
      .validation.text-danger:after {
        content: 'Validation failed';
      }
/*      .validation.text-success:after {
        content: 'Validation passed';
      }
*/    </style>
    <div class="container">
      <div class="form-group">
          <div class="table-responsive">
            <table class="checkout-totals table-bordered">
              <thead>
                <tr>
                  <th>Product: </th>
                  <th>Price: </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $BQ->get_sku_description(); ?></td>
                  <td class="text-right">$<?php echo $BQ->get_sku_price(); ?></td>
                </tr>
                <tr>
                  <td class="text-right">Tax: </td>
                  <td class="text-right">$<?php echo $BQ->get_tax_total(); ?></td>
                </tr>
                <tr>
                  <td class="text-right"><b>Total: </b></td>
                  <td class="text-right">$<?php echo $BQ->get_total_due(); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      <form novalidate autocomplete="on" method="POST">
        <h2 class="validation"></h2>
        <div class="form-group">
          <label for="cc-number" class="control-label">Card Number <small class="text-muted">[<span class="cc-brand"></span>]</small></label>
          <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" required>
        </div>
        <div class="form-group">
          <label for="cc-name" class="control-label">Cardholder Name </label>
          <input id="cc-name" type="tel" class="input-lg form-control cc-name" autocomplete="cc-name" required>
        </div>
        <div class="form-group">
          <label for="cc-exp" class="control-label">Card Expiration Date</label>
          <input id="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="•• / ••••" required>
        </div>
        <div class="form-group">
          <label for="cc-cvc" class="control-label">Card CVC</label>
          <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="•••" required>
        </div>
        
        
        <div class="form-group">
          <input type="hidden" id="sku" value="<?php echo $sku; ?>" />
          <input type="hidden" id="customerId" value="<?php echo WC()->session->get('customerId'); ?>" />
          <input type="hidden" id="totalDue" value="<?php echo $BQ->get_total_due(); ?>" />
          <button type="submit" class="btn btn-lg btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <script>
      jQuery(function($) {
        $('.cc-number').payment('formatCardNumber');
        $('.cc-exp').payment('formatCardExpiry');
        $('.cc-cvc').payment('formatCardCVC');
        $.fn.toggleInputError = function(erred) {
          this.parent('.form-group').toggleClass('has-error', erred);
          return this;
        };
        $('form').submit(function(e) {
          e.preventDefault();
          var cardType = $.payment.cardType($('.cc-number').val());
          $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
          $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
          $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
          $('.cc-brand').text(cardType);
          $('.validation').removeClass('text-danger text-success');
          $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
          if (!$('.has-error').length) {
            $('.validation').text("Processing payment...");
            $.ajax({
              url: "/wp-content/themes/assistv2/portal/process-order.php",
              data: {
                'sku': $('#sku').val()
                ,'customerId': $('#customerId').val()
                ,'totalDue': Number($('#totalDue').val())
                ,'paymentType': 'Credit Card'
                ,'paymentSource': 'Assist Wireless Portal'
                ,'ccNum': $('#cc-number').val().replace(/\s/g, '')
                ,'ccName': $('#cc-name').val()
                ,'ccExpDate': $('#cc-exp').val().replace(/\s/g, '')
                ,'ccCV': $('#cc-cvc').val()
              }
            }).done(function(data) {
              $('.validation').removeClass('text-danger text-success');
              if (data.status == "error") {
                $('.validation').addClass('text-danger');
                $('.validation').text(data.message);
              } else {
                $('.validation').addClass('text-success');
                $('.validation').text('Payment successful.');
              }
            });
          }
        });
      });
    </script>
    <?php get_footer(); ?>
