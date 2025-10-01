(function($){

	"use strict";

	var link_objects = [
		'a.core-smooth-scroll',
		'.core-smooth-scroll a',
		'.header a',
		'.post-meta a',
		'.comment-reply a',
		'.comment-meta-date a'
	].join( ', ' );

	$(link_objects).on('click', function(e) {
		var target_hash = this.hash;
		if (target_hash) {
			var target = $(target_hash);
			if ( target.offset() !== undefined ) {
				e.preventDefault();
				var header = $('.header');
				$('html, body').stop().animate({
					'scrollTop': target.offset().top - header.height()
				}, 600, 'swing');
			}
		}
	});

})(jQuery);
