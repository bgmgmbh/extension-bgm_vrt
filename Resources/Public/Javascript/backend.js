(function ($) {
	$('document').ready(function(){
		$('.comparisons h4').on('click', function () {
			$(this).parent('.comparisons').find('ul').toggle();
		});
		$('.comparisonTitle').on('click', function () {
			$(this).parent('li').find('.comparisonImages img').each(function () {
				if($(this).attr('src') != $(this).attr('data-src')){
					$(this).attr('src', $(this).attr('data-src'));
				}
			});
			$(this).parent('li').find('.comparisonImages .split-pane-component div').each(function () {
				if($(this).css('backgroundImage') != 'url(' + $(this).attr('data-src') + ')'){
					$(this).css('backgroundImage', 'url(' + $(this).attr('data-src') + ')');
				}
			});
			$(this).parent('li').find('.comparisonImages').toggle();

			$(this).parent('li').find('.comparisonImages .split-pane').splitPane();
		});
	});
})(jQuery);