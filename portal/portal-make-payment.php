<?php
  /*
  * * Template Name: Portal Make Payment
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
  
  $paymentAmount = preg_replace("/[^0-9,.]/", "", $_GET["paymentAmount"]);
  if ( !isset( $paymentAmount ) ) {
    // TODO: What should happen if nothing is passed in via paymentAmount?
    $paymentAmount = 0;
  }
?>
<style type="text/css" media="screen">
  .has-error input {
    border-width: 2px;
  }
  .validation.text-danger:after {
    content: 'Validation failed';
  }
  .validation.text-success:after {
    content: 'Validation passed';
  }
</style>
  <div class="container payment-page">
    <div class="form-group checkout-table col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="table-responsive">
          <h1>Account Info</h1>
          <table class="make-payment">
            <tbody>
              <tr>
                <td><b>Customer ID: </b></td>
                <td class="text-right static-width"><?php echo WC()->session->get("customerId"); ?></td>
              </tr>
              <tr class="border-top">
                <td class="static-width"><b>Phone Number: </b></td>
                <td class="text-right phone-no"><?php echo preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', WC()->session->get("mdn")); ?></td>
              </tr>
              <tr class="border-top">
                <td><b>Enrolled Plan:</b> </td>
                <td><?php echo WC()->session->get('planName'); ?></td>
              </tr>
              <tr class=" alert alert-warning">
                <td class=""><b>Payment: </b></td>
                <td class="text-right">$<?php //echo WC()->session->get('balancePastDue'); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!-- end checkout-table -->
      <form novalidate autocomplete="on" method="POST" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
        </div>
      </div><!-- end checkout-table -->
      <form novalidate autocomplete="on" method="POST" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
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
      <div class="container payment-page">
        <div class="form-group checkout-table col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="table-responsive">
              <h1>Review Order</h1>
              <table class="checkout-totals">
                <tbody>
                  <tr>
                    <td><b><?php echo $BQ->get_sku_description(); ?></b></td>
                    <td class="text-right static-width">$<?php echo $BQ->get_sku_price(); ?></td>
                  </tr>
                  <tr class="border-top">
                    <td class=""><b>Tax: </b></td>
                    <td class="text-right static-width">$<?php echo $BQ->get_tax_total(); ?></td>
                  </tr>
                  <tr class=" alert alert-warning">
                    <td class=""><b>Total: </b></td>
                    <td class="text-right static-width">$<?php echo $BQ->get_total_due(); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div> <!-- end checkout-table -->
      <form novalidate autocomplete="on" method="POST">
        <div class="form-group">
          Placeholder for Instructions
        </div>
        <h2 class="validation"></h2>
        <div class="form-group">
          <label for="payment-amount" class="control-label">Payment Amount</label>
          <input id="payment-amount" class="input-lg form-control payment-amount" required value="<?php echo (string)$paymentAmount; ?>">
        </div>
        <div class="form-group">
          <label for="cc-number" class="control-label">Card Number</label>
          <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" required>
        </div>
        <div class="form-group">
          <label for="cc-name" class="control-label">Cardholder Name</label>
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
        <input type="hidden" id="customerId" value="<?php echo WC()->session->get('customerId'); ?>" />
        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
      </form>
  </div> <!-- end payment-page -->
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
          url: "/wp-content/themes/assistv2/portal/process-payment.php",
          data: {
            'customerId': $('#customerId').val()
            ,'totalDue': Number($('#payment-amount').val())
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
      });
    </script>
    <?php get_footer(); ?>
