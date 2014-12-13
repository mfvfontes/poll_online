/**
 *  jQuery Avgrund Popin Plugin
 *  http://github.com/voronianski/jquery.avgrund.js/
 *
 *  (c) 2012-2013 http://pixelhunter.me/
 *  MIT licensed
 */
 
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// CommonJS
		module.exports = factory;
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function ($) {
	$.fn.avgrund = function (options) {
		var defaults = {
			width: 400, // max = 640
			height: 500, // max = 350
			showClose: true,
			showCloseText: '',
			closeByEscape: true,
			closeByDocument: true,
			holderClass: '',
			overlayClass: '.avgrund-ready',
			enableStackAnimation: false,
			onBlurContainer: '',
			openOnEvent: false,
			setEvent: 'click',
			onLoad: true,
			onUnload: false,
			template: '<p>This is test popin content!</p>'
		};
		
		options = $.extend(defaults, options);

		return this.each(function() {
			var self = $(this),
				body = $('body'),
				maxWidth = options.width,
				maxHeight = options.height,
				template = inner_html.responseJSON;

			//alert(inner_html.responseJSON);
			body.addClass('avgrund-ready');

			if ($('.avgrund-overlay').length === 0) {
				body.append('<div class="avgrund-overlay ' + options.overlayClass + '"></div>');
			}

			if (options.onBlurContainer !== '') {
				$(options.onBlurContainer).addClass('avgrund-blur');
			}

			function onDocumentKeyup (e) {
				if (options.closeByEscape) {
					if (e.keyCode === 27) {
						document.documentElement.style.height = "";
						deactivate();
					}
				}
			}

			function onDocumentClick (e) {
				if (options.closeByDocument) {
					if ($(e.target).is('.avgrund-overlay, .avgrund-close')) {
						document.documentElement.style.height = "";
						e.preventDefault();
						deactivate();
					}
				} else if ($(e.target).is('.avgrund-close')) {
						document.documentElement.style.height = "";
						e.preventDefault();
						deactivate();
				}
				document.documentElement.style.height = "";
			}

			function activate () {
				if (typeof options.onLoad === 'function') {
					options.onLoad(self);
				}

				setTimeout(function() {
					body.addClass('avgrund-active');
				}, 100);

				var $popin = $('<div class="avgrund-popin ' + options.holderClass + '"></div>');
				$popin.append(template);
				body.append($popin);

				$('.avgrund-popin').css({
					'width': maxWidth + 'px',
					'height': maxHeight + 'px',
					'margin-left': '-' + (maxWidth / 2 + 10) + 'px',
					'margin-top': '-' + (maxHeight / 2 + 10) + 'px'
				});
								
				if (options.showClose) {
					$('.avgrund-popin').append('<a href="#" class="avgrund-close">' + options.showCloseText + '</a>');
				}

				if (options.enableStackAnimation) {
					$('.avgrund-popin').addClass('stack');
				}

				body.bind('keyup', onDocumentKeyup)
					.bind('click', onDocumentClick);
					
				
			}

			function deactivate () {
				body.unbind('keyup', onDocumentKeyup)
					.unbind('click', onDocumentClick)
					.removeClass('avgrund-active');

				setTimeout(function() {
					$('.avgrund-popin').remove();
				}, 500);

				if (typeof options.onUnload === 'function') {
					options.onUnload(self);
				}
			}

			if (options.openOnEvent) {
				self.bind(options.setEvent, function (e) {
					e.stopPropagation();

					if ($(e.target).is('a')) {
						e.preventDefault();
					}

					activate();
				});
			} else {
				activate();
			}
		});
	};
}));

if(inner_html){

	$('.show').avgrund({
		height: 400,
		holderClass: 'custom',
		showClose: true,
		showCloseText: 'close',
		onBlurContainer: '',
	});

}
