<?php
  /*
  * * Template Name: Portal Auto Payment
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

  $autopayenabled = WC()->session->get('autopayenabled');

  echo '<script>';
  echo 'var autopayenabled = ' . json_encode($autopayenabled) . ';';
  echo '</script>';
?>

<style type="text/css" media="screen">
  .has-error input {
    border-width: 2px;
  }
  .validation.text-danger:after {
    content: 'Validation failed';
  }
  .validation.text-success:after {
    /*content: 'Validation passed';*/
  }
</style>
  <div class="container autopay-page">
    <div class="form-group checkout-table col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="table-responsive">
        <h1>Enroll in Auto-Pay</h1>
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
             <!--  <tr class="border-top">
                <td><b>Enrolled Plan:</b> </td>
                <td class="text-right"><?php echo WC()->session->get('planName'); ?></td>
              </tr> -->
              <tr class="border-top">
                <td><b>Invoice Amount:</b></td>
                <td class="text-right"><?php echo WC()->session->get('balance'); ?></td>
              </tr>
              
              <!-- <tr class="border-top">
                <td>
                  <b>Monthly Plan Amount: </b> <br>
                  <sub>(without discounts)</sub>
                </td>
                <td class="text-right">
                  $<?php echo WC()->session->get('planPrice'); ?>
                </td>
              </tr> -->
              <tr class="border-top">
                <td colspan="2">
                  <div class="alert alert-info">
                    Disclaimer: When enrolling in auto pay the total amount due will be deducted on the due date.
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div><!-- end checkout-table -->
      <?php 
        if($autopayenabled === "N"){
      ?>
      <div class="enroll col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#credit-card">Credit Card</a></li>
          <li><a data-toggle="tab" href="#bank-ach">Bank Account/ACH</a></li>
        </ul>
        <div class="tab-content">
          <div id="credit-card" class="tab-pane fade in active">
            <h2>Enroll with a credit card</h2>
            <form novalidate autocomplete="on" method="POST">
              <div class="form-group">
                <!-- Placeholder for Instructions -->
              </div>
              <h2 class="validation"></h2>
              <div class="form-group">
                <label for="cc-name" class="control-label">Cardholder Name</label>
                <input id="cc-name" type="text" class="input-lg form-control cc-name" autocomplete="cc-name" required>
              </div>
              <div class="form-group">
                <label for="cc-number" class="control-label">Card Number</label>
                <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" required>
              </div>
              <div class="form-group">
                <label for="cc-exp" class="control-label">Card Expiration Date</label>
                <input id="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="•• / ••••" required>
              </div>
              <div class="form-group">
                <label for="ccCV" class="control-label">Card CCV(3-digit security code)</label>
                <input id="ccCV" type="tel" class="input-lg form-control ccCV" autocomplete="ccCV" placeholder="•••" required>
              </div>
              <div class="form-group">
                <label for="cc-zip" class="control-label">Billing Zip Code</label>
                <input id="cc-zip" type="tel" class="input-lg form-control cc-zip" autocomplete="off" placeholder="•••••" required>
              </div>
              <input type="hidden" id="customerId" value="<?php echo WC()->session->get('customerId'); ?>" />
              <button type="submit" class="btn btn-lg btn-primary">Submit</button>
            </form> <!-- end enroll form-->
          </div>
          <div id="bank-ach" class="tab-pane fade">
            <h2>Enroll with your bank account</h2>
            <form novalidate autocomplete="on" method="POST">
              <div class="form-group">
                <!-- Placeholder for Instructions -->
              </div>
              <h2 class="validation"></h2>
              <div class="form-group">
                <label for="ach-name" class="control-label">Account Number</label>
                <input id="ach-name" type="text" class="input-lg form-control ach-name" autocomplete="ach-name" required>
              </div>
              <div class="form-group">
                <label for="ach-number" class="control-label">Routing Number</label>
                <input id="ach-number" type="tel" class="input-lg form-control ach-number" autocomplete="ach-number" placeholder="•••• •••• •••• ••••" required>
              </div>
              <input type="hidden" id="customerId" value="<?php echo WC()->session->get('customerId'); ?>" />
              <button type="submit" class="btn btn-lg btn-primary">Submit</button>
            </form> <!-- end enroll form-->
          </div>
        </div> <!-- end tab-content -->
      </div>
      <?php }else{ ?>
      <div class="disenroll col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <form novalidate autocomplete="on" method="POST">
          <div class="form-group">
            <!-- Placeholder for Instructions -->
          </div>
          <h2 class="validation"></h2>
          <div class="form-group disenroll">
            <label for="disenroll" class="clearfix">
              <input type="checkbox" class="disenroll" id="disenroll" value="N">
              Unenroll from auto-payment
            </label>
            <input value="" id="cc-name" type="hidden" class="hidden input-lg form-control cc-name" autocomplete="cc-name">
            <input value="" id="cc-number" type="hidden" class="hidden input-lg form-control cc-number" autocomplete="cc-number" placeholder="•••• •••• •••• ••••">
            <input value="" id="cc-exp" type="hidden" class="hidden input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="•• / ••••">
            <input value="" id="ccCV" type="hidden" class="hidden input-lg form-control ccCV" autocomplete="ccCV" placeholder="•••">
            <input value="" id="cc-zip" type="hidden" class="hidden input-lg form-control cc-zip" autocomplete="off" placeholder="•••••">
            <div class="clearfix"></div>
            <input type="hidden" id="customerId" value="<?php echo WC()->session->get('customerId'); ?>" />
            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
          </div><!-- end form-group-hidden -->
        </form> <!-- end dis-enroll form-->
      </div> <!-- end disenroll -->
      <?php } ?>
  </div> <!-- end payment-page -->

  <!-- Modal for processing -->
    <div class="modal fade bs-example-modal-sm processing-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title">Processing...</h4>
          </div>
          <div class="modal-body">
            <p>Please wait while we process your request</p>
            <p><img class="loader" src="<?php echo bloginfo('template_directory') ?>/images/loading.gif" alt=""></p>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<script>

  jQuery(function($) {
    $('.cc-number').payment('formatCardNumber');
    $('.cc-exp').payment('formatCardExpiry');
    $('.ccCV').payment('formatCardCVC');
    $.fn.toggleInputError = function(erred) {
      this.parent('.form-group').toggleClass('has-error', erred);
      return this;
    };
    $('form').submit(function(e) {
      e.preventDefault();
      // TODO: ???
      if ($('.disenroll').is(":checked")) {
        $('.processing-modal').modal('show');
        $.ajax({
          url: "/wp-content/themes/assistv2/portal/process-auto-payment.php",
          data: {
            'customerId'     : $('#customerId').val()
            ,'disenroll'     : 'Y'
          }
        }).done(function(data) {
          $('.validation').removeClass('text-danger text-success');
          if (data.status == "error") {
            $('.processing-modal').modal('hide');
            $('.validation').addClass('alert alert-danger');
            $('.validation').text(data.message);
          } else {
            window.location.href = ('/thank-you/')
            $('.validation').addClass('text-success');
            $('.validation').text('Payment successful.');
          }
        });
      } else {
        var cardType = $.payment.cardType($('.cc-number').val());
        $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
        $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
        $('.ccCV').toggleInputError(!$.payment.validateCardCVC($('.ccCV').val(), cardType));
        $('.cc-brand').text(cardType);
        $('.validation').removeClass('text-danger text-success');
        $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
        if (!$('.has-error').length) {
          // $('.validation').text("Processing payment...");
          $('.processing-modal').modal('show');
          $.ajax({
            url: "/wp-content/themes/assistv2/portal/process-auto-payment.php",
            data: {
              'customerId'     : $('#customerId').val()
              ,'totalDue'      : Number($('#payment-amount').val())
              ,'paymentType'   : 'Credit Card'
              ,'paymentSource' : 'Assist Wireless Portal'
              ,'ccNum'         : $('#cc-number').val().replace(/\s/g, '')
              ,'ccName'        : $('#cc-name').val()
              ,'ccExpDate'     : $('#cc-exp').val().replace(/\s/g, '')
              ,'ccCV'          : $('#ccCV').val()
              ,'ccZip'         : $('#cc-zip').val()
              ,'disenroll'     : 'N'
            }
          }).done(function(data) {
            $('.validation').removeClass('text-danger text-success');
            if (data.status == "error") {
              $('.processing-modal').modal('hide');
              $('.validation').addClass('text-danger');
              $('.validation').text(data.message);
            } else {
              window.location.href = ('/thank-you/')
              $('.validation').addClass('text-success');
              $('.validation').text('Payment successful.');
            }
          });
        }
      }
    });
  });
</script>
<?php get_footer(); ?>
  