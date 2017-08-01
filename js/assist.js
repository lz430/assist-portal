jQuery(document).ready(function ($) {
    /* Superfish menu */
    $('#menu-header-menu').superfish();

    $(".commercial object").each(function() {
        var original_width = 720;
        var original_height = 405;
        var container_width = $(this).closest('.commercial').width();
        var container_ratio = container_width / original_width;
        console.log(container_width);
        $(this).attr('width', container_width);
        $(this).attr('height', original_height * container_ratio);
    })

	var maxHeight = 0;
	if ($('.add_to_cart_button').length > 0){

		$('.add_to_cart_button').each(function(){
			var offset = $(this).offset().top;
			if (offset > maxHeight)
				maxHeight = offset;
		});

		$('.add_to_cart_button').each(function(){
			var offset = $(this).offset().top;
			if (offset < maxHeight)
				$(this).css('margin-top', maxHeight - offset);
		});
	}



})