(function($){

	"use strict";

	$(document).ready(function() {

		var wpcf7_container = $( 'div.wpcf7' );

		if ( wpcf7_container.length ) {

			var form_controls = [
				'select',
				'textarea',
				'input[type=text]',
				'input[type=email]',
				'input[type=url]',
				'input[type=tel]',
				'input[type=number]',
				'input[type=date]'
			].join( ', ' );

			wpcf7_container.find( form_controls ).addClass( 'form-control' );

			wpcf7_container.find( 'br' ).addClass('d-none');

			wpcf7_container.find( '.wpcf7-form-control-wrap' ).addClass( 'form-group d-block' );

			wpcf7_container.find( 'input[type=submit]' ).addClass( 'btn' );

			wpcf7_container.find( '.wpcf7-list-item.first' ).addClass( 'm-0' );
		}
	});
})(jQuery);
