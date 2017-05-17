/*
 *  Plugins
 */
$(function() {
	/*
	 *  Loading
	 -------------------------------------------------
	 *  ex: $element.loading();
	 */
	jQuery.fn.loading = function(config) {
		var $this = this,
			$element = jQuery(this);

		this.params = {
			action: 'set', // any alias from 'keywords' parameter
			message: '<div style="padding: 10px; border-radius: 5px; background: white; color: gray"><i class="fa fa-2x fa-gear fa-spin"></i></div>', // for block
			spinner: '<i class="fa fa-gear fa-spin"></i>', // for inline-block
			classNames: {
				overlay: 'wait-for-it-overlay',
				loader: 'wait-for-it-loader'
			},
			style: {
				zIndex: 1000,
				resizeDelay: 0, // some elements have animation for transition and the plugin cannot retrive the height correctly; for this use a delay
				minHeight: 50,
				element: {},
				overlay: {
					margin: '0',
					padding: '0',
					border: 'none',
					width: '100%',
					height: '100%',
					top: '0',
					left: '0',
					backgroundColor: 'rgb(85, 85, 85)',
					opacity: '0.5',
					cursor: 'wait'
				},
				loader: {
					margin: '0',
					textAlign: 'center',
					cursor: 'wait'
				}
			},
			keywords: {
				set: ['set', 'add', 'start', 'load'],
				clear: ['clear', 'end', 'done', 'remove', 'finish', 'finished', 'stop', 'break', 'continue']
			}
		};


		/**
		 * Initialize the plugin
		 */
		this.init = function() {
			/** * stop the plugin intialisation if it does not exists in the document */
			if($element.length === 0) {
				return false;
			}

			/**
			 * If the plugin was applyed for multiple elements,
			 * apply the plugin for each element at a time and...
			 */
			if($element.length > 1) {
				$element.each(function() {
					if(typeof( config ) !== 'undefined') {
						jQuery(this).loading(config);
					}
					else {
						jQuery(this).loading();
					}
				});

				return false; // ...stop the execution
			}

			if(typeof( GlobalLoadingOptions ) !== 'undefined' && typeof( GlobalLoadingOptions ) === 'object') {
				$this.params = jQuery.extend(true, {}, $this.params, GlobalLoadingOptions); // merge the default parametters with the given config
			}

			if(typeof( config ) !== 'undefined') { // arrange the config to be interpreted no matter the form was passed (string or object)
				if(typeof( config ) === 'string' && ( $this.params.keywords.set.indexOf(config) > -1 || $this.params.keywords.clear.indexOf(config) > -1 )) {
					config = {action: config};
				}

				$this.params = jQuery.extend(true, {}, $this.params, config); // merge the default parametters with the given config
			}

			/**
			 * Create aliases for loader.clear method
			 */
			if($this.params.keywords.clear.length > 0) {
				for(var i = 0; i < $this.params.keywords.clear.length; i++) {
					if($this.params.keywords.clear[i] === 'clear') {
						continue;
					}

					var alias = $this.params.keywords.clear[i];
					if(typeof( $this[alias] ) === 'undefiend') {
						$this[alias] = function() {
							$this.clear();

							return $this;
						};
					}
				}
			}

			if($this.params.keywords.clear.indexOf($this.params.action) > -1) {
				$this.clear();
			}
			else if($this.params.keywords.set.indexOf($this.params.action) > -1) {
				$this.apply();
			}
			else {
				console.error('Loading: Unknown action')
			}
		};


		/**
		 * Show loading and block the element
		 */
		this.apply = function(counter) {
			if(typeof( $element.data('loading') ) === 'undefined') {
				$element.trigger('loading.show.before'); // loading event

				if($element.is('a') || $element.is('button') || $element.is('input')) { // button elements
					$this.style
						.element('inline-block');
				}
				else { // block elements
					counter = typeof( counter ) === 'undefined' ? 0 : counter;

					/**
					 * If the $element is hidden try to delay the loader initialization
					 * for a maximum 1 second,
					 */
					if(!$element.is(':visible') && counter < 9) {
						setTimeout(function() {
							$this.apply(counter + 1);
						}, 100);

						return false;
					}

					$this.style
						.element('block')
						.overlay()
						.loader();
				}

				$element.attr('data-loading', 'element');

				$element.trigger('loading.show.after'); // loading event

				$this.events();
			}
		};


		/**
		 * Remove loading and unblock the element
		 */
		this.clear = function() {
			if(typeof( $element.data('loading') ) !== 'undefined') {
				$element.trigger('loading.close.before'); // loading event

				if($element.is('a') || $element.is('button') || $element.is('input')) { // button elements
					$element.find('[data-loading="loader"]').remove();

					if($element.is('a')) {
						$element
							.removeAttr('disabled');
					}
					else {
						$element.prop('disabled', false);
					}
				}
				else { // block elements
					if(typeof( $element.data('loading-initial-style') ) !== 'undefined' && $element.data('loading-initial-style') != '') {
						$element
							.attr('style', $element.data('loading-initial-style'))
							.removeData('loading-initial-style')
							.removeAttr('data-loading-initial-style');
					}
					else {
						$element
							.removeAttr('style');
					}

					if($element.is('body')) {
						/** * hide the first level of elements */
						if($element.find('>div, >section').length > 0) {
							$element.find('>div, >section').each(function() {
								var $firstLevelChild = jQuery(this);

								if(typeof( $firstLevelChild.attr('data-loading-initial-style') ) !== 'undefined' && $firstLevelChild.attr('data-loading-initial-style') != '') {
									$firstLevelChild.attr('style', $firstLevelChild.attr('data-loading-initial-style'));

									$firstLevelChild
										.removeData('loading-initial-style')
										.removeAttr('data-loading-initial-style');
								}
								else {
									$firstLevelChild.removeAttr('style');
								}
							});
						}
					}

					$element.find('[data-loading="loader"]').remove();
					$element.find('[data-loading="overlay"]').remove();
				}

				$element
					.removeData('loading')
					.removeAttr('data-loading')
					.trigger('loading.close.after'); // loading event
			}
		};


		/**
		 * Style loader elements including the blocked element
		 */
		this.style = {
			element: function(type) {
				if(type === 'inline-block') { // button, anchor..
					var $spinner = jQuery('<i/>')
						.addClass('fa fa-gear fa-spin');

					if($this.params.spinner) {
						$spinner = jQuery($this.params.spinner);
					}

					$spinner
						.attr('data-loading', 'loader')
						.css({marginRight: '3px'})

					$element.prepend($spinner);

					if($element.is('a')) {
						$element.attr('disabled', 'disabled');
					}
					else {
						$element.prop('disabled', true);
					}
				}
				else if(type === 'block') { // div, p, section..
					/** * set min-height */
					var borderWidth = parseInt($element.css('border-top-width')) > 0 ? parseInt($element.css('border-top-width')) : 0;
					borderWidth += parseInt($element.css('border-bottom-width')) > 0 ? parseInt($element.css('border-bottom-width')) : 0;
					if(parseInt($element.innerHeight()) < $this.params.style.minHeight) {
						$this.params.style.element.height = ( $this.params.style.minHeight + borderWidth ) + 'px';
					}
					else {
						$this.params.style.element.height = ( parseInt($element.innerHeight()) + borderWidth ) + 'px';
					}

					/** * set positioning */
					if($element.css('position') != 'absolute' && $element.css('position') !== 'relative' && $element.css('position') !== 'fixed') {
						$this.params.style.element.position = 'relative';
					}
				}

				if(!isEmpty($this.params.style.element)) {
					/** * if the container has an inline style, store the style in another attribute before change it */
					if(typeof( $element.attr('style') ) !== 'undefined' && $element.attr('style') !== '') {
						$element.attr('data-loading-initial-style', $element.attr('style'))
					}

					$element.css($this.params.style.element);
				}

				if($element.is('body')) {
					/** * hide the first level of elements */
					if($element.find('>div, >section').length > 0) {
						$element.find('>div, >section').each(function() {
							var $firstLevelChild = jQuery(this);

							if(typeof( $firstLevelChild.attr('style') ) !== 'undefined' && $firstLevelChild.attr('style') != '') {
								$firstLevelChild.attr('data-loading-initial-style', $firstLevelChild.attr('style'));
							}

							$firstLevelChild.attr('style', 'display: none !important;');
						});
					}
				}

				return this;
			},
			overlay: function() {
				var $overlay = jQuery('<div />');

				if(typeof( $this.params.classNames.overlay ) !== 'undefined') {
					$overlay.addClass($this.params.classNames.overlay);
				}

				if(typeof( $this.params.style.overlay.height ) === 'undefined') {
					$this.params.style.overlay.height = '100%';
				}

				if(typeof( $this.params.style.overlay.width ) === 'undefined') {
					$this.params.style.overlay.width = '100%';
				}

				$this.params.style.overlay.zIndex = $this.params.style.zIndex;
				$this.params.style.overlay.position = 'absolute';

				$overlay
					.attr('data-loading', 'overlay')
					.css($this.params.style.overlay);

				$element.append($overlay);

				return this;
			},
			loader: function() {
				var $loader = jQuery('<div />');

				if($this.params.message) {
					if(jQuery.type($this.params.message) === 'string') {
						$loader.html($this.params.message);
					}
					else if(jQuery.type($this.params.message) === 'object') {
						$loader = jQuery($this.params.message).clone();
					}
				}

				if(typeof( $this.params.classNames.loader ) !== 'undefined') {
					$loader.addClass($this.params.classNames.loader);
				}

				$this.params.style.loader.zIndex = $this.params.style.zIndex + 1;
				$this.params.style.loader.position = 'absolute';

				$loader
					.attr('data-loading', 'loader')
					.css($this.params.style.loader);

				if($loader.css('display') == 'none') {
					$loader.show();
				}

				$loader.css('visibility', 'hidden');

				$element.append($loader);

				this.position();

				$loader.css('visibility', 'visible');

				return this;
			},
			resize: function() { // used for resize
				var $style = this,
					resize = true;

				/**
				 * check if the fixed positioned elements had an initial height
				 * don't resize this type of element
				 */
				if($element.css('position') === 'fixed') {
					if(typeof( $element.data('loading-initial-style') ) != 'undefined' && $element.data('loading-initial-style') != '') {
						var $tmp = jQuery('<div />').css({'display': 'none'}).attr('style', $element.data('loading-initial-style'));
						if(parseInt($tmp.css('height')) > 0) {
							resize = false;
						}
					}
				}

				if(resize) {
					$element.css('height', 'auto');

					setTimeout(function() {
						/** * set min-height */
						var borderWidth = parseInt($element.css('border-top-width')) > 0 ? parseInt($element.css('border-top-width')) : 0;
						borderWidth += parseInt($element.css('border-bottom-width')) > 0 ? parseInt($element.css('border-bottom-width')) : 0;
						if(parseInt($element.innerHeight()) < $this.params.style.minHeight) {
							$element.css('height', ( $this.params.style.minHeight + borderWidth ) + 'px');
						}
						else {
							$element.css('height', ( parseInt($element.innerHeight()) + borderWidth ) + 'px');
						}

						$style.position();
					}, $this.params.style.resizeDelay);
				}

				return this;
			},
			position: function() {
				var $loader = $element.find('[data-loading="loader"]'),
					position = {};

				if(!$element.is(':visible')) {
					return this;
				}

				/** * fix the element height relative to loader */
				if(parseInt($element.innerHeight()) < parseInt($loader.outerHeight())) {
					$element.innerHeight($loader.outerHeight());
				}

				if(!$this.params.style.loader.top && !$this.params.style.loader.bottom) {
					position.top = parseInt(parseInt($element.innerHeight()) / 2) - parseInt(parseInt($loader.outerHeight()) / 2) + 'px';
				}

				if(!$this.params.style.loader.left && !$this.params.style.loader.right) {
					position.left = parseInt(parseInt($element.innerWidth()) / 2) - parseInt(parseInt($loader.outerWidth()) / 2) + 'px';
				}

				if(!isEmpty(position)) {
					if($loader.css('visibility') != 'hidden') {
						$loader.animate(position, 200);
					}
					else {
						$loader.css(position);
					}
				}

				return this;
			}
		};


		/**
		 * Apply a set of events on loading
		 */
		this.events = function() {
			if(!$element.is('a') && !$element.is('button') && !$element.is('input')) { // button elements
				jQuery(window).on('resize', function() {
					clearTimeout($this.resizerTimeout);
					$this.resizerTimeout = setTimeout(function() {
						$this.style.resize();
					}, 500);
				});
			}
		};


		this.init();


		return this;
	};
});

/*
 *  Useful jquery actions
 */
$(function() {
	$(document).on('click', '.ajax-btn', function(event) {
		if($(this).data('data-toggle') != 'modal') {
			event.preventDefault();
		}

		var $this = $(this),
			url = $this.data('url'),
			$target = $($this.data('target')),
			callback = $this.data('callback');

		if(url && $target) {
			$target.loading();

			$.ajax({
				type: "GET",
				url: url,
				success: function(result) {
					$target
						.loading('clear')
						.html(result);

					if(callback) {
						callFunction(callback, window, $this);
					}
				}
			});
		}
		else {
			event.preventDefault();
		}
	});

	$(document).on('submit', '.ajax-form', function(event) {
		var $this = $(this),
			url = $this.attr('action'),
			$target = $($this.data('target')),
			callback = $this.data('callback'),
			data = ajaxGetFormData($this.serializeArray());

		if(url && $target) {
			$target.loading();

			$.ajax({
				type: "GET",
				url: url,
				data: data,
				success: function(result) {
					$target
						.loading('clear')
						.html(result);

					if(callback) {
						callFunction(callback, window, $this);
					}
				}
			});
		}
		else {
			event.preventDefault();
		}
	});

	$(document).on('change paste keyup', '.ajax-input', function(event) {
		var $this = $(this),
			url = $this.data('url'),
			$target = $($this.data('target')),
			callback = $this.data('callback'),
			name = $this.attr('name'),
			value = $this.val();

		if(url && $target) {
			$target.loading();

			url = addParamToUrl(url, name, value);

			$.ajax({
				type: "GET",
				url: url,
				success: function(result) {
					$target
						.loading('clear')
						.html(result);

					if(callback) {
						callFunction(callback, window, $this);
					}
				}
			});
		}
		else {
			event.preventDefault();
		}
	});
});

/*
 *  Call function
 ------------------------------------------------
 *  Allow global functions to be called programmatically
 *  by the string name
 *
 *  ex: callFunction('function', window, arg1, arg2);
 */
function callFunction(functionName, context /*, args */) {
	var args = Array.prototype.slice.call(arguments).splice(2);
	console.log(args);

	var namespaces = functionName.split('.');
	var func = namespaces.pop();

	for(var i = 0; i < namespaces.length; i++) {
		context = context[namespaces[i]];
	}

	if(typeof( context[func] ) === 'function') {
		return context[func].apply(context, args);
	}

	return null;
}

/*
 * Object is empty
 ------------------------------------------------
 */
function isEmpty( target ){
	for( var prop in target ){
		if( target.hasOwnProperty( prop ) ){
			return false;
		}
	}

	return true;
}

/*
 *  Get form data (GET Method)
 ------------------------------------------------
 */
var ajaxGetFormData = function(data) {
	var formData = {};

	for(var i = 0; i < data.length; i++) {
		formData[data[i]['name']] = formData[i]['value'];
	}

	return formData;
};

var ajaxGetFormData2 = function(data) {
	var formData = new FormData();

	for(var key in data) {
		var input = data[key],
			name = input['name'],
			value = input['value'];

		formData.append(name, value);
	}

	return formData;
};


/*
 *  Add parameter to url
 ------------------------------------------------
 *  ex: addParamToUrl(oldUrl, ame, value);
 */
var addParamToUrl = function(url, paramName, paramValue) {
	if(url.indexOf('?') !== -1) {
		return url + '&' + paramName + '=' + paramValue;
	}
	else {
		return url + '?' + paramName + '=' + paramValue;
	}
};