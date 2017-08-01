jQuery(window).load(function(){
  var loggedIn = jQuery('body').hasClass('logged-in');
  var autoPayEnabled = jQuery('body').hasClass('page-template-portal-auto-payment');

  jQuery("#menu-item-93").click(function(){
    jQuery("#modalMinutes").modal('show');
  });
  jQuery("#menu-item-94").click(function(){
    jQuery("#modalText").modal('show');
  });
  jQuery("#menu-item-95").click(function(){
    jQuery("#modalData").modal('show');
  });
  if(loggedIn === false){
    // Register form - Modifying the 2nd phone input
    jQuery('form.register p label').each(function(){
      var label = jQuery(this).attr('for');
      jQuery(this).parent().addClass(label);
    });
    var secondPhone = jQuery('.reg_billing_phone');
    jQuery(secondPhone).insertAfter('.reg_register_phone');
    jQuery('.reg_billing_phone label').text('Confirm Phone');
    jQuery('.reg_billing_phone input').attr('required');
    jQuery('.hide-me, form.register .loading').toggle();
  }

  // Masking registration inputs
  jQuery(function($){
    $("#reg_register_dob").mask("99-99-9999",{placeholder: " "});
    $("#reg_register_phone").mask("(999)999-9999",{placeholder: " "});
    $("#reg_billing_phone").mask("(999)999-9999",{placeholder: " "});
  });

    

  jQuery("form.register").submit(function() {
    jQuery("#reg_register_phone").mask("9999999999",{placeholder: " "});
    jQuery("#reg_billing_phone").mask("9999999999",{placeholder: " "});
  });
  
  // Modal recertification
  if( jQuery('body').hasClass('logged-in')){
    if (upForRecert === true){

      var recertBody = '<iframe src="https://www.lifelinerenewal.com/" height="800"></iframe>';
      var warningText = '<strong>URGENT!</strong> Your account is due for annual recertification.';
      
      //show warning on dashboard
      // jQuery('.alerts-container .alert').show();
      // jQuery('.alerts-container .warningText').html(warningText);
      
      // show modal
      // jQuery("#modalRecert").modal('show');
      jQuery('#recertifyIframe').on('click', function(e){
        e.preventDefault();
        jQuery("#modalRecert, .modal-content").css({
          'width': '100%',
          'height': '800px'
        });
        jQuery("#modalRecert .modal-dialog").css({
          'width': '100%'
        });
        jQuery('#modalRecert .modal-body').replaceWith(recertBody);
      });

    } //end upforrecert
  } //end login page

  // if( jQuery('body').hasClass('page-template-portal-auto-payment') && autoPayEnabled == "Y"){
  //   jQuery('.autopay-page .enroll').hide();
  //   jQuery('.autopay-page .disenroll').show();
  // } else{
  //   jQuery('.autopay-page .enroll').show();
  //   jQuery('.autopay-page .disenroll').hide();
  // }//end enrolled in auto-pay
});

jQuery(function ($) {
  $("form.register").validate({
    rules: {
      reg_email: {
        required: true,
        email: true
      },
      reg_password: {
        required: true,
        minlength: 1
      },
      reg_register_phone: {
        required: true,
      },
      reg_billing_phone: {
        required: true,
        equalTo: "#reg_register_phone"
      },
      reg_register_dob: {
        required: true,
        date: true
      }
    },
    messages: {
      reg_email: {
        required: "Please enter a valid email address",
      },
      reg_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 1 character long"
      },
      reg_register_phone: {
        required: "Please provide a valid Assist Wireless phone #",
      },
      reg_billing_phone: {
        required: "Please confirm the Assist Wireless phone #",
        equalTo: "Please enter the same phone # as above"
      },
      reg_register_dob: {
        required: "Please provide a valid date",
      },
      
    }
  });
}) ;