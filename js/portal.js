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
  // Modal recertification
  if(upForRecert === true){
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

  }
});