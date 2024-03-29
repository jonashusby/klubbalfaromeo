(function( $ ) {
	'use strict';

	jQuery(document).ready(function(){
		jQuery('.xt_datepicker').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
	
	jQuery(document).ready(function(){
		jQuery('#import_type').on('change', function(){
			if( jQuery(this).val() != 'onetime' ){
				jQuery('.hide_frequency .import_frequency').show();
			}else{
				jQuery('.hide_frequency .import_frequency').hide();
			}
		});

		jQuery("#import_type").trigger('change');
	});	

	jQuery(document).ready(function(){
		jQuery('#facebook_import_by').on('change', function(){

			if( jQuery(this).val() == 'facebook_event_id' ){
				jQuery('.import_type_wrapper').hide();

				jQuery('.facebook_page_wrapper').hide();
				jQuery('.facebook_page_wrapper .facebook_page_username').removeAttr( 'required' );

				jQuery('.facebook_eventid_wrapper').show();
				jQuery('.facebook_eventid_wrapper .facebook_event_ids').attr('required', 'required');

			} else {
				jQuery('.import_type_wrapper').show();

				jQuery('.facebook_eventid_wrapper').hide();
				jQuery('.facebook_eventid_wrapper .facebook_event_ids').removeAttr( 'required' );

				jQuery('.facebook_page_wrapper').show();
				jQuery('.facebook_page_wrapper .facebook_page_username').attr('required', 'required');

			}

		});

		jQuery("#facebook_import_by").trigger('change');
	});	

	// Render Dynamic Terms.
	jQuery(document).ready(function() {
	    jQuery('.fb_event_plugin').on( 'change', function() {

	    	var event_plugin = jQuery(this).val();
	    	var data = {
	            'action': 'ife_render_terms_by_plugin',
	            'event_plugin': event_plugin
	        };

	        var terms_space = jQuery('.event_taxo_terms_wraper');
	        terms_space.html('<span class="spinner is-active" style="float: none;"></span>');
	        // send ajax request.
	        jQuery.post(ajaxurl, data, function(response) {
	            if( response != '' ){
	            	terms_space.html( response );
	            }else{
	            	terms_space.html( '' );
	            }	            
	        });    
	    });
	    jQuery(".fb_event_plugin").trigger('change');                  
	});

})( jQuery );
