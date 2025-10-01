(function($){

	"use strict";

	$(document).ready(function() {

		var container     = $('.row-portfolio'),
			filters       = $('#filters'),
			loading_image = $('#loading-image'),
			max_page      = $('#next-projects').data('num-pages');

		$('a', filters).on('click', function() {
			container.one('arrangeComplete', function(event, filteredItems) {
				if ( filteredItems.length == 0 ) {
					loading_image.removeClass('d-none');
				}
				container.infinitescroll('scroll');
			});
		});

		container.infinitescroll({
			loading: {
				selector: '#next-projects',
				finishedMsg: '',
				msgText: '',
				speed: 0,
				img: ''
			},
			navSelector: '#next-projects',
			nextSelector: '#next-projects a',
			itemSelector: '.portfolio-item',
			maxPage: max_page,
			prefill: true
		},
		function(newElements) {
			var current_filter = $('.current').data('filter');
			if ( current_filter !== undefined ) {
				current_filter = current_filter.replace('.', '');
				if ( current_filter != '*' ) {
					for ( var index = 0; index < newElements.length; index++ ) {
						if ( ! $(newElements[index]).hasClass(current_filter) ) {
							$(newElements[index]).addClass('d-none');
						}
					}
					if ( $(newElements).hasClass(current_filter) ) {
						loading_image.addClass('d-none');
					}
				}
			}
			container.isotope('insert', newElements).resize();

			$(newElements).removeClass('d-none');
		});

		container.resize();
	});

})(jQuery);
