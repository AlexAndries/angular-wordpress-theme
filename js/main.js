/**
 * Created by Alexandru on 2/10/2016.
 */
var loadingEvent = function (event) {
		$('.loader-section .loader-center .loader-effect').css('height', event.progress * 100 + '%');
	},
	doneLoader = function () {
		jQuery('.loader-section').addClass('close-loader').on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function (event) {
			if (event.eventPhase === 2) {
				jQuery(this).remove();
				$('body').removeClass('loader-open');
			}
		});
	};
jQuery('.loader-section').on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function (event) {
	if (event.eventPhase === 2) {
		jQuery(this).remove();
		$('body').removeClass('loader-open');
	}
});