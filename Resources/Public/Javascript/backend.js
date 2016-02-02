(function ($) {
	// for better performance, define regexes once, before the code
	var pxRegex = /px/, percentRegex = /%/, urlRegex = /url\(['"]*(.*?)['"]*\)/g;
	$.fn.getBackgroundSize = function (element, callback) {
		var img = new Image(), width, height, backgroundSize = this.css('background-size').split(' ');

		if (pxRegex.test(backgroundSize[0])) width = parseInt(backgroundSize[0]);
		if (percentRegex.test(backgroundSize[0])) width = this.parent().width() * (parseInt(backgroundSize[0]) / 100);
		if (pxRegex.test(backgroundSize[1])) height = parseInt(backgroundSize[1]);
		if (percentRegex.test(backgroundSize[1])) height = this.parent().height() * (parseInt(backgroundSize[0]) / 100);
		// additional performance boost, if width and height was set just call the callback and return
		if ((typeof width != 'undefined') && (typeof height != 'undefined')) {
			callback(element, {width: width, height: height});
			return this;
		}
		img.onload = function () {
			if (typeof width == 'undefined') width = this.width;
			if (typeof height == 'undefined') height = this.height;
			callback(element, {width: width, height: height});
			return this;
		};
		img.src = this.css('background-image').replace(urlRegex, '$1');
		return this;
	};

	$('document').ready(function () {
		$('.comparisons h4').on('click', function () {
			$(this).parent('.comparisons').find('ul').toggle();
		});
		$('.comparisonTitle').on('click', function () {
			$(this).parent('li').find('.comparisonDetails').toggle();

			$(this).parent('li').find('.comparisonImages img').each(function () {
				if ($(this).attr('src') != $(this).attr('data-src')) {
					$(this).attr('src', $(this).attr('data-src'));
				}
			});
			$(this).parent('li').find('.comparisonImages .comparisonImage').each(function () {
				if ($(this).css('backgroundImage') != 'url(' + $(this).attr('data-src') + ')') {
					$(this).css('backgroundImage', 'url(' + $(this).attr('data-src') + ')');
				}
			});

			if($(this).parent('li').find('.comparisonImages .split-pane .comparisonBaseImage').first().css('background-size') == 'contain'){
				$(this).parent('li').find('.comparisonImages .split-pane .comparisonBaseImage').first().getBackgroundSize($(this), function (element, size) {
					var baseSize = size;
					element.parent('li').find('.comparisonImages .split-pane .comparisonDiffImage').first().getBackgroundSize(element, function (element, size) {

						var maxWidth = element.parent('li').find('.comparisonImages .split-pane .comparisonBaseImage').first().width();
						var maxHeight = element.parent('li').find('.comparisonImages .split-pane .comparisonBaseImage').first().height();

						var baseRatio = Math.min(maxWidth / baseSize.width, maxHeight / baseSize.height);
						var diffRatio = Math.min(maxWidth / size.width, maxHeight / size.height);

						var smallestRation = baseRatio < diffRatio ? baseRatio : diffRatio;

						element.parent('li').find('.comparisonImages .split-pane .comparisonBaseImage').first().css('background-size', baseSize.width * smallestRation + 'px ' + baseSize.height * smallestRation + 'px');
						element.parent('li').find('.comparisonImages .split-pane .comparisonDiffImage').first().css('background-size', size.width * smallestRation + 'px ' + size.height * smallestRation + 'px');
					});
				});
			}

			$(this).parent('li').find('.comparisonImages .split-pane').splitPane();
		});
	});

})(TYPO3.jQuery);