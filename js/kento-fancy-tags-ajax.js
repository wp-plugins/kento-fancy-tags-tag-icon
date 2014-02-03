
jQuery(document).bind('mousemove', function(e)
	{	
	
	
		var kft_popup_top = parseInt(jQuery("#kft-popup-top-value").text());
		var kft_popup_left = parseInt(jQuery("#kft-popup-left-value").text());


		jQuery('#kento-fancy-tags').css({
			
               left:  e.pageX+kft_popup_left,
               top:   e.pageY+kft_popup_top,
			});
	});











jQuery(document).ready(function(jQuery)
	{		
	
		
		jQuery("a.fancy-tags").mouseleave(function()
			{
				
				jQuery("#kento-fancy-tags").css("display","none");
				
			})		
		
		var kft_popup_hide = parseInt(jQuery("#kft-popup-hide-value").text());
		
		if(kft_popup_hide==1)
			{
		
				
			jQuery("a.fancy-tags").mouseenter(function()
				{	
					
					jQuery("#kento-fancy-tags").css("display","block");
										
					var tag_name = jQuery(this).text();
					var tag_id = jQuery(this).attr("tag-id");
					var tag_count = jQuery(this).attr("tag-count");				
					
					jQuery.ajax(
						{
					type: 'POST',
					url: kento_fancy_tags_ajax.kento_fancy_tags_ajaxurl,
					data: {"action": "kento_fancy_tags_ajax", "tag_name":tag_name, "tag_id":tag_id, "tag_count":tag_count},
					success: function(data)
							{	
								
								jQuery("#kento-fancy-tags").html(data);
							
							}
						});
	
	
					});	
				
			}

	});