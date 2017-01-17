jQuery(document).ready(function(){
  jQuery("#menu-item-93").click(function(){
    jQuery("#modalMinutes").modal('show');
  });
  jQuery("#menu-item-94").click(function(){
    jQuery("#modalText").modal('show');
  });
  jQuery("#menu-item-95").click(function(){
    jQuery("#modalData").modal('show');
  });
  
});
jQuery(window).load(function(){
  // Register form - Modifying the 2nd phone input
  jQuery('form.register p label').each(function(){
    var label = jQuery(this).attr('for');
    jQuery(this).parent().addClass(label);
  });
  var secondPhone = jQuery('.reg_billing_phone');
  jQuery(secondPhone).insertAfter('.reg_register_phone');
  jQuery('.reg_billing_phone label').contents()[0].textContent='Confirm Phone';
  jQuery('.reg_billing_phone label').append('<span class="sub-text">(+1XXXXXXXXX format)</span>');

  // Show form once we're done moving things around
  jQuery('form.register .loading').hide();
  jQuery('form.register .hide-me').fadeIn(500);


  // Modal recertification
  if( jQuery('body').hasClass('logged-in') && upForRecert === true){
    var recertBody = '<iframe src="https://www.lifelinerenewal.com/" width="1170" height="800"></iframe>';
    var warningText = '<strong>URGENT!</strong> Your account is due for annual recertification.';
    
    //show warning on dashboard
    jQuery('.alerts-container .alert').show();
    jQuery('.warningText').html(warningText);
    
    //show modal
    jQuery("#modalRecert").modal('show');
    jQuery('#recertifyIframe').on('click', function(e){
      e.preventDefault();
      jQuery("#modalRecert, .modal-content").css({
        'width': '100%',
        'height': '800px'
      });
      jQuery("#modalRecert .modal-dialog").css({
        'width': '1170px'
      });
      jQuery('#modalRecert .modal-body').replaceWith(recertBody);
    })
  } //end upforrecert
});