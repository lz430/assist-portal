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
  var recertURL = 'https://www.lifelinerenewal.com/';
  var recertModal = jQuery('#modalRecert .modal-body');

  if(upForRecert === true){
    jQuery("#modalRecert").modal('show');
    jQuery("#modalRecert iframe").attr({
      'src': recertURL,
      'height': 600,
      'width': 1170
    });
  }
});