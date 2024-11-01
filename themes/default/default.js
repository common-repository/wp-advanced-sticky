jQuery(document).ready(function(){
	var wws = jQuery('#wrap-was-sticky');
	
	
	var totalHeight =  wws.height();
	totalHeight += parseInt(wws.css("padding-top"), 10) + parseInt(wws.css("padding-bottom"), 10); //Total Padding Height
	totalHeight += parseInt(wws.css("margin-top"), 10) + parseInt(wws.css("margin-bottom"), 10); //Total Margin Height
	totalHeight += parseInt(wws.css("borderTopWidth"), 10) + parseInt(wws.css("borderBottomWidth"), 10); //Total Border Height
	
	jQuery('#was-sticky').height(totalHeight);
	var height = jQuery('#was-sticky').height()/2;
	// alert(totalHeight);
	
	jQuery('#was-sticky').css('marginTop', '-'+ height + 'px');
	
	if(jQuery('#wrap-was-sticky').hasClass('was-displaynone')) {
		jQuery('#open-close-was-sticky').css('left', 0);
		jQuery('#open-close-was-sticky').css('right', 'auto');
		jQuery('#was-close').addClass('was-disabled');
		jQuery('#was-open').removeClass('was-disabled');
	}
	
	jQuery('#was-close').click(function() {
		jQuery('#open-close-was-sticky').css('left', 0);
		jQuery('#open-close-was-sticky').css('right', 'auto');
		jQuery('#wrap-was-sticky').hide('normal', function() {
		
			jQuery('#was-sticky').width(jQuery('#open-close-was-sticky').width());
			
			jQuery('#was-close').addClass('was-disabled');
			jQuery('#was-open').removeClass('was-disabled');
			
			return false;
		});
	});
	
	jQuery('#was-open').click(function() {
		jQuery('#wrap-was-sticky').show('normal', function() {
		
			var totalWidth = wws.width();
			totalWidth += parseInt(wws.css("padding-left"), 10) + parseInt(wws.css("padding-right"), 10); //Total Padding Width
			totalWidth += parseInt(wws.css("margin-left"), 10) + parseInt(wws.css("margin-right"), 10); //Total Margin Width
			totalWidth += parseInt(wws.css("borderLeftWidth"), 10) + parseInt(wws.css("borderRightWidth"), 10); //Total Border Width
			
			jQuery('#was-sticky').width(jQuery('#open-close-was-sticky').width() + totalWidth);
			
			jQuery('#was-open').addClass('was-disabled');
			jQuery('#was-close').removeClass('was-disabled');
			jQuery('#open-close-was-sticky').css('left', 'auto');
			jQuery('#open-close-was-sticky').css('right', 0);
		});
		
		return false;
	});
});