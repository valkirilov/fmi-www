
var Generator = (function() {

	var generator = {
		image: {
			width: null,
			height: null,
			category: null,
			result: null
		},
		text: {
			paragraphs: null,
			len: null,
			result: null
		}
	};

	var init = function() {
		initGenerator();
		attachEventListeners();
	};

	/**
	 * Init the generator fields
	 * @return {[type]} [description]
	 */
	var initGenerator = function() {
		// Image generator fields
		generator.image.width = $('#generator-image-width');
		generator.image.height = $('#generator-image-height');
		generator.image.category = $('#generator-image-category');
		generator.image.result = $('#generator-image-result');

		// Text generator fields
		generator.text.paragraphs = $('#generator-text-paragraphs');
		generator.text.len = $('.generator-text-length');
		generator.text.result = $('#generator-text-result');
	};

	/**
	 * Attach all of the event listeners for the generator
	 * @return {[type]} [description]
	 */
	var attachEventListeners = function() {

		// Images generator events
		generator.image.width.on('change', function() {
			generateImageResult();
		});
		generator.image.height.on('change', function() {
			generateImageResult();
		});
		generator.image.category.on('change', function() {
			generateImageResult();
		});

		// Text generator events
		generator.text.paragraphs.on('change', function() {
			generateTextResult();
		});
		generator.text.len.on('change', function() {
			generateTextResult();
		});

	};

	/**
	 * Generate a new url for the images and display it
	 * @return {[type]} [description]
	 */
	var generateImageResult = function() {
		var generatedUrl = '';

		if (generator.image.width.val() !== '') {
			generatedUrl += (generatedUrl.length > 0 ? '&' : '') + 'w=' + generator.image.width.val();
		}
		if (generator.image.height.val() !== '') {
			generatedUrl += (generatedUrl.length > 0 ? '&' : '') + 'h=' + generator.image.height.val();
		}
		if (generator.image.category.val() !== '') {
			generatedUrl += (generatedUrl.length > 0 ? '&' : '') + 'c=' + generator.image.category.val();
		}

		generator.image.result.val('/i.php?' + generatedUrl);
	};

	/**
	 * Generate a new url for the text and display it
	 * @return {[type]} [description]
	 */
	var generateTextResult = function() {
		var generatedUrl = '';

		if (generator.text.paragraphs.val() !== '') {
			generatedUrl += (generatedUrl.length > 0 ? '&' : '') + 'p=' + generator.text.paragraphs.val();
		}
		if (generator.text.len.val() !== '') {
			generatedUrl += (generatedUrl.length > 0 ? '&' : '') + 'l=' + generator.text.len.val();
		}

		generator.text.result.val('/t.php?' + generatedUrl);
	};

	return {
		init: init
	};
})();

$(document).ready(function() {
	Generator.init();
});