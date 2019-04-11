/**
 * jQuery lightBox plugin
 * This jQuery plugin was inspired and based on Lightbox 2 by Lokesh Dhakar (http://www.huddletogether.com/projects/lightbox2/)
 * and adapted to me for use like a plugin from jQuery.
 * @name jquery-lightbox-0.5.js
 * @author Leandro Vieira Pinho - http://leandrovieira.com
 * @version 0.5
 * @date April 11, 2008
 * @category jQuery plugin
 * @copyright (c) 2008 Leandro Vieira Pinho (leandrovieira.com)
 * @license CCAttribution-ShareAlike 2.5 Brazil - http://creativecommons.org/licenses/by-sa/2.5/br/deed.en_US
 * @example Visit http://leandrovieira.com/projects/jquery/lightbox/ for more informations about this jQuery plugin
 */

// Offering a Custom Alias suport - More info: http://docs.jquery.com/Plugins/Authoring#Custom_Alias
(function($) {
	/**
	 * $ is an alias to jQuery object
	 *
	 */
	$.fn.lightBox = function(settings) {
		// Settings to configure the jQuery lightBox plugin how you like
		settings = jQuery.extend({
			// Configuration related to overlay
			overlayBgColor: 		'#000',		// (string) Background color to overlay; inform a hexadecimal value like: #RRGGBB. Where RR, GG, and BB are the hexadecimal values for the red, green, and blue values of the color.
			overlayOpacity:			0.8,		// (integer) Opacity value to overlay; inform: 0.X. Where X are number from 0 to 9
			// Configuration related to navigation
			fixedNavigation:		false,		// (boolean) Boolean that informs if the navigation (next and prev button) will be fixed or not in the interface.
			// Configuration related to images
			imageLoading: 'data:image/gif;base64,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',
			imageBtnPrev:'data:image/gif;base64,R0lGODlhPwAgAOYAAP////39/fv7+/n5+fj4+Pb29vT09PLy8vDw8O7u7urq6unp6efn5+Xl5ePj4+Hh4d/f393d3dvb29ra2tjY2NbW1tTU1NDQ0M7OzszMzMvLy8nJycfHx8XFxcPDw8HBwb+/v729vby8vLq6uri4uLa2trKysq6urq2traurq6mpqaenp6Ojo6GhoZ+fn56enpycnJqampiYmJSUlJCQkI+Pj42NjYWFhYODg4GBgYCAgHx8fHp6enh4eHZ2dnR0dHJycnFxcW9vb21tbWtra2lpaWVlZWNjY2JiYmBgYF5eXlxcXFpaWlhYWFZWVlRUVFNTU1FRUU9PT01NTUtLS0lJSUdHR0JCQkBAQP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEHAFkALAAAAAA/ACAAAAf/gACCg4SFhoeIiYqGWVmLj5CRj46SlZaXmJmam5ydnp+goaKjpKWmp6ipmwMYICAfFQSCE64hGQuCBx4fvLwMGhwBgwMbG6IFOVFJyzsQAC1QSkpIRikAEUtOS0xMShc1URKDE0o2xzpCBQclVDYCLUsSAxFBTRQOUjQQFPwBH1MuBqmoguEcEAEAAjDxYYCFkgaCVkT5wGDKikIIiAwpAKCAjyDCQhXQEQRBgRJWbARgsUTEhBBHkkBw8ARHiBEkPCCM8UQDAAtVRIwqgCOKkiVJekwAwAKKkSVPgHQAIGGJkiJGjuAYAGDCFBkAZCRhMDSHEQ8dKMh6tkQDCiojnQRJiDLDAYQIDkLuEALhyAyE534YcpFEgQAfSA5QnWLNEIcpN5IUHKoDCFdCLpQ4ACCCyotrUWhUGG0hgaAEQ6rwCHmMB5HLg2A8cWagR5UND55YucIbiwlBAWBcOVEqwIIGrAUpkLBWQYUFAyRMmD4dwaADFDiq2n6JwIABAsIL+E4gOfdEAgKoX7/+vPv38OPLn0+//iVK9hU1CgQAOw==',
			imageBtnNext:'data:image/gif;base64,R0lGODlhPwAgAOYAAP////39/fv7+/n5+ff39/X19fPz8/Hx8e/v7+3t7evr6+np6efn5+bm5uTk5OLi4uDg4N7e3tzc3NjY2NbW1tLS0tDQ0M7OzsrKysjIyMbGxsLCwsDAwLy8vLq6ura2trS0tLOzs7Gxsa+vr62traurq6mpqaenp6WlpaOjo52dnZubm5mZmZGRkY+Pj42NjYuLi4eHh4WFhYODg4GBgYCAgH5+fnp6enh4eHZ2dnR0dHBwcG5ubmxsbGpqamhoaGZmZmRkZGJiYmBgYF5eXlxcXFpaWlhYWFZWVlRUVFJSUlBQUE5OTk1NTUtLS0lJSUdHR0VFRUNDQ////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEHAFMALAAAAAA/ACAAAAf/gFNTAISFhoeIiYqLjIiDjZCRkpOUlZaXmJmam5ydnp+goaKjpKWmp6igARomF4UCHCIABiAlJrcnDxQoroQKJRsOKSYlIyUnIASeAS5PQxGEAzZFAAxCSUFCQkUXDD1GEADMTRgWSEJGSkNDOAfLLUlMMsoDNUQAC0UzCQz9yhhNYATIwGRFgAENFqh4UmHBggDLXPx4wQQEAAE07i0w8iIRCyUhdvBAYKgElAWhmPlogOOIAwAZ8Q3hUQJFChIFCBG4scRIhUMmoDRIKZHAhCTzYi4IYkSHyBruxM14UiScoaBDVUk8ECBFkxIxhuArIgNBAgUKIAIQoeSEkBtRiQlhJfqDZIEeRYIAwWekBaIIR2oA+PDkxFWhdEkCMLfkBz4iOTpI9vBgAA0kEgAMuJFkQqG5qlrsiJtCSQ98QJpAWS3lhAgnhglRODJabpSsoAgQUCtOt7gDCMwmSFDgQFpDBxYIIFRAwfJU0CkFEBCgunXr0TXxzs69u/fv4MOLdzRekqDykAIBADs=',
			imageBtnClose:'data:image/gif;base64,R0lGODlhQgAWANUAAP////39/fr6+vj4+PX19fDw8Ovr6+np6ebm5uTk5N/f39zc3Nra2tfX19XV1dLS0svLy8jIyL6+vre3t7S0tLKysq+vr6ioqKOjo56enpubm5aWlpGRkY+Pj4yMjIeHh4KCgoCAgH19fXZ2dnNzc3FxcW5ubmlpaWdnZ2RkZGJiYl9fX11dXVpaWlVVVVNTU1BQUE5OTktLS0lJSUZGRgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAAHAP8ALAAAAABCABYAAAb/QIBwSCwaj8ikcslsOp/QqLQZmFqvRAHngYxsBEaCw3EYHhwE5IFykZSLZ7RQPK4PBxzaimGEtGgcaXMZL4UvH0IXLw5HEoaFF0MEIo8RAA6PhUMWNC8xKw1EES0xLzQYQ5QfY2yJi0YRh2UKlBRCHC8XDhEZZZgcdYxCBiQzLzIqC0KjpTMhBUIULxlHisJEKCiCAAQoLEIvJEaYkUcGIzKeKAt+pTQgA0Pe20TWRQrTRYSMLyjjuUnOGYOBgtQxENsOHEJij4g0S6IA4gpEBJOICxjfEDmXDgaMYx/iDSHH8FU9kyMBTnrBguKlTNeIFCjx0ZMGMBUBVkPpKubL2XKXKLFQ8HNJgRM1Y3Qwgo9DSZ+ObBFxJKGIIxFFkywwUcrjMQ1ViLDwt9OnQkREcGkcQuJF1iMLUKSLkWLFRxlgTwK91NMIJaJC8GE14u1tkQUr0skgkSCCV7xhubUF5gCXJUUcMGJkpIAFCwkOKHgGnCHDmA/5LGoGyiCxCxkjDAiZ8DjvHEqFWFADoChTOQcoDKEADAC1od2YMglhwEIxCdlDKsjwSKMCnDFQFJAxEqdJgQ4yZjw3UiGGjBN8sKjP4mH8EQsnEKyfP0QAvSIB5NPfz7+/+iAAOw==',		// (string) Path and the name of the close btn
			imageBlank:'data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==',			// (string) Path and the name of a blank image (one pixel)
			// Configuration related to container image box
			containerBorderSize:	10,			// (integer) If you adjust the padding in the CSS for the container, #lightbox-container-image-box, you will need to update this value
			containerResizeSpeed:	400,		// (integer) Specify the resize duration of container image. These number are miliseconds. 400 is default.
			// Configuration related to texts in caption. For example: Image 2 of 8. You can alter either "Image" and "of" texts.
			txtImage:				'Image',	// (string) Specify text "Image"
			txtOf:					'of',		// (string) Specify text "of"
			// Configuration related to keyboard navigation
			keyToClose:				'c',		// (string) (c = close) Letter to close the jQuery lightBox interface. Beyond this letter, the letter X and the SCAPE key is used to.
			keyToPrev:				'p',		// (string) (p = previous) Letter to show the previous image
			keyToNext:				'n',		// (string) (n = next) Letter to show the next image.
			// Don't alter these variables in any way
			imageArray:				[],
			activeImage:			0
		},settings);
		// Caching the jQuery object with all elements matched
		var jQueryMatchedObj = this; // This, in this context, refer to jQuery object
		/**
		 * Initializing the plugin calling the start function
		 *
		 * @return boolean false
		 */
		function _initialize() {
			_start(this,jQueryMatchedObj); // This, in this context, refer to object (link) which the user have clicked
			return false; // Avoid the browser following the link
		}
		/**
		 * Start the jQuery lightBox plugin
		 *
		 * @param object objClicked The object (link) whick the user have clicked
		 * @param object jQueryMatchedObj The jQuery object with all elements matched
		 */
		function _start(objClicked,jQueryMatchedObj) {
			// Hime some elements to avoid conflict with overlay in IE. These elements appear above the overlay.
			$('embed, object, select').css({ 'visibility' : 'hidden' });
			// Call the function to create the markup structure; style some elements; assign events in some elements.
			_set_interface();
			// Unset total images in imageArray
			settings.imageArray.length = 0;
			// Unset image active information
			settings.activeImage = 0;
			// We have an image set? Or just an image? Let's see it.
			if ( jQueryMatchedObj.length == 1 ) {
				settings.imageArray.push(new Array(objClicked.getAttribute('href'),objClicked.getAttribute('title')));
			} else {
				// Add an Array (as many as we have), with href and title atributes, inside the Array that storage the images references		
				for ( var i = 0; i < jQueryMatchedObj.length; i++ ) {
					settings.imageArray.push(new Array(jQueryMatchedObj[i].getAttribute('href'),jQueryMatchedObj[i].getAttribute('title')));
				}
			}
			while ( settings.imageArray[settings.activeImage][0] != objClicked.getAttribute('href') ) {
				settings.activeImage++;
			}
			// Call the function that prepares image exibition
			_set_image_to_view();
		}
		/**
		 * Create the jQuery lightBox plugin interface
		 *
		 * The HTML markup will be like that:
			<div id="jquery-overlay"></div>
			<div id="jquery-lightbox">
				<div id="lightbox-container-image-box">
					<div id="lightbox-container-image">
						<img src="../fotos/XX.jpg" id="lightbox-image">
						<div id="lightbox-nav">
							<a href="#" id="lightbox-nav-btnPrev"></a>
							<a href="#" id="lightbox-nav-btnNext"></a>
						</div>
						<div id="lightbox-loading">
							<a href="#" id="lightbox-loading-link">
								<img src="../images/lightbox-ico-loading.gif">
							</a>
						</div>
					</div>
				</div>
				<div id="lightbox-container-image-data-box">
					<div id="lightbox-container-image-data">
						<div id="lightbox-image-details">
							<span id="lightbox-image-details-caption"></span>
							<span id="lightbox-image-details-currentNumber"></span>
						</div>
						<div id="lightbox-secNav">
							<a href="#" id="lightbox-secNav-btnClose">
								<img src="../images/lightbox-btn-close.gif">
							</a>
						</div>
					</div>
				</div>
			</div>
		 *
		 */
		function _set_interface() {
			// Apply the HTML markup into body tag
			$('body').append('<div id="jquery-overlay"></div><div id="jquery-lightbox"><div id="lightbox-container-image-box"><div id="lightbox-container-image"><img id="lightbox-image"><div style="" id="lightbox-nav"><a href="#" id="lightbox-nav-btnPrev"></a><a href="#" id="lightbox-nav-btnNext"></a></div><div id="lightbox-loading"><a href="#" id="lightbox-loading-link"><img src="' + settings.imageLoading + '"></a></div></div></div><div id="lightbox-container-image-data-box"><div id="lightbox-container-image-data"><div id="lightbox-image-details"><span id="lightbox-image-details-caption"></span><span id="lightbox-image-details-currentNumber"></span></div><div id="lightbox-secNav"><a href="#" id="lightbox-secNav-btnClose"><img src="' + settings.imageBtnClose + '"></a></div></div></div></div>');	
			// Get page sizes
			var arrPageSizes = ___getPageSize();
			// Style overlay and show it
			$('#jquery-overlay').css({
				backgroundColor:	settings.overlayBgColor,
				opacity:			settings.overlayOpacity,
				width:				arrPageSizes[0],
				height:				arrPageSizes[1]
			}).fadeIn();
			// Get page scroll
			var arrPageScroll = ___getPageScroll();
			// Calculate top and left offset for the jquery-lightbox div object and show it
			$('#jquery-lightbox').css({
				top:	arrPageScroll[1] + (arrPageSizes[3] / 10),
				left:	arrPageScroll[0]
			}).show();
			// Assigning click events in elements to close overlay
			$('#jquery-overlay,#jquery-lightbox').click(function() {
				_finish();									
			});
			// Assign the _finish function to lightbox-loading-link and lightbox-secNav-btnClose objects
			$('#lightbox-loading-link,#lightbox-secNav-btnClose').click(function() {
				_finish();
				return false;
			});
			// If window was resized, calculate the new overlay dimensions
			$(window).resize(function() {
				// Get page sizes
				var arrPageSizes = ___getPageSize();
				// Style overlay and show it
				$('#jquery-overlay').css({
					width:		arrPageSizes[0],
					height:		arrPageSizes[1]
				});
				// Get page scroll
				var arrPageScroll = ___getPageScroll();
				// Calculate top and left offset for the jquery-lightbox div object and show it
				$('#jquery-lightbox').css({
					top:	arrPageScroll[1] + (arrPageSizes[3] / 10),
					left:	arrPageScroll[0]
				});
			});
		}
		/**
		 * Prepares image exibition; doing a image's preloader to calculate it's size
		 *
		 */
		function _set_image_to_view() { // show the loading
			// Show the loading
			$('#lightbox-loading').show();
			if ( settings.fixedNavigation ) {
				$('#lightbox-image,#lightbox-container-image-data-box,#lightbox-image-details-currentNumber').hide();
			} else {
				// Hide some elements
				$('#lightbox-image,#lightbox-nav,#lightbox-nav-btnPrev,#lightbox-nav-btnNext,#lightbox-container-image-data-box,#lightbox-image-details-currentNumber').hide();
			}
			// Image preload process
			var objImagePreloader = new Image();
			objImagePreloader.onload = function() {
				$('#lightbox-image').attr('src',settings.imageArray[settings.activeImage][0]);
				// Perfomance an effect in the image container resizing it
				_resize_container_image_box(objImagePreloader.width,objImagePreloader.height);
				//	clear onLoad, IE behaves irratically with animated gifs otherwise
				objImagePreloader.onload=function(){};
			};
			objImagePreloader.src = settings.imageArray[settings.activeImage][0];
		};
		/**
		 * Perfomance an effect in the image container resizing it
		 *
		 * @param integer intImageWidth The image's width that will be showed
		 * @param integer intImageHeight The image's height that will be showed
		 */
		function _resize_container_image_box(intImageWidth,intImageHeight) {
			// Get current width and height
			var intCurrentWidth = $('#lightbox-container-image-box').width();
			var intCurrentHeight = $('#lightbox-container-image-box').height();
			// Get the width and height of the selected image plus the padding
			var intWidth = (intImageWidth + (settings.containerBorderSize * 2)); // Plus the image's width and the left and right padding value
			var intHeight = (intImageHeight + (settings.containerBorderSize * 2)); // Plus the image's height and the left and right padding value
			// Diferences
			var intDiffW = intCurrentWidth - intWidth;
			var intDiffH = intCurrentHeight - intHeight;
			// Perfomance the effect
			$('#lightbox-container-image-box').animate({ width: intWidth, height: intHeight },settings.containerResizeSpeed,function() { _show_image(); });
			if ( ( intDiffW == 0 ) && ( intDiffH == 0 ) ) {
				// if ( $.browser.msie ) {
				// 	___pause(250);
				// } else {
					___pause(100);	
				// }
			} 
			$('#lightbox-container-image-data-box').css({ width: intImageWidth });
			$('#lightbox-nav-btnPrev,#lightbox-nav-btnNext').css({ height: intImageHeight + (settings.containerBorderSize * 2) });
		};
		/**
		 * Show the prepared image
		 *
		 */
		function _show_image() {
			$('#lightbox-loading').hide();
			$('#lightbox-image').fadeIn(function() {
				_show_image_data();
				_set_navigation();
			});
			_preload_neighbor_images();
		};
		/**
		 * Show the image information
		 *
		 */
		function _show_image_data() {
			$('#lightbox-container-image-data-box').slideDown('fast');
			$('#lightbox-image-details-caption').hide();
			if ( settings.imageArray[settings.activeImage][1] ) {
				$('#lightbox-image-details-caption').html(settings.imageArray[settings.activeImage][1]).show();
			}
			// If we have a image set, display 'Image X of X'
			if ( settings.imageArray.length > 1 ) {
				$('#lightbox-image-details-currentNumber').html(settings.txtImage + ' ' + ( settings.activeImage + 1 ) + ' ' + settings.txtOf + ' ' + settings.imageArray.length).show();
			}		
		}
		/**
		 * Display the button navigations
		 *
		 */
		function _set_navigation() {
			$('#lightbox-nav').show();

			// Instead to define this configuration in CSS file, we define here. And it's need to IE. Just.
			$('#lightbox-nav-btnPrev,#lightbox-nav-btnNext').css({ 'background' : 'transparent url(' + settings.imageBlank + ') no-repeat' });
			
			// Show the prev button, if not the first image in set
			if ( settings.activeImage != 0 ) {
				if ( settings.fixedNavigation ) {
					$('#lightbox-nav-btnPrev').css({ 'background' : 'url(' + settings.imageBtnPrev + ') left 15% no-repeat' })
						.unbind()
						.bind('click',function() {
							settings.activeImage = settings.activeImage - 1;
							_set_image_to_view();
							return false;
						});
				} else {
					// Show the images button for Next buttons
					$('#lightbox-nav-btnPrev').unbind().hover(function() {
						$(this).css({ 'background' : 'url(' + settings.imageBtnPrev + ') left 15% no-repeat' });
					},function() {
						$(this).css({ 'background' : 'transparent url(' + settings.imageBlank + ') no-repeat' });
					}).show().bind('click',function() {
						settings.activeImage = settings.activeImage - 1;
						_set_image_to_view();
						return false;
					});
				}
			}
			
			// Show the next button, if not the last image in set
			if ( settings.activeImage != ( settings.imageArray.length -1 ) ) {
				if ( settings.fixedNavigation ) {
					$('#lightbox-nav-btnNext').css({ 'background' : 'url(' + settings.imageBtnNext + ') right 15% no-repeat' })
						.unbind()
						.bind('click',function() {
							settings.activeImage = settings.activeImage + 1;
							_set_image_to_view();
							return false;
						});
				} else {
					// Show the images button for Next buttons
					$('#lightbox-nav-btnNext').unbind().hover(function() {
						$(this).css({ 'background' : 'url(' + settings.imageBtnNext + ') right 15% no-repeat' });
					},function() {
						$(this).css({ 'background' : 'transparent url(' + settings.imageBlank + ') no-repeat' });
					}).show().bind('click',function() {
						settings.activeImage = settings.activeImage + 1;
						_set_image_to_view();
						return false;
					});
				}
			}
			// Enable keyboard navigation
			_enable_keyboard_navigation();
		}
		/**
		 * Enable a support to keyboard navigation
		 *
		 */
		function _enable_keyboard_navigation() {
			$(document).keydown(function(objEvent) {
				_keyboard_action(objEvent);
			});
		}
		/**
		 * Disable the support to keyboard navigation
		 *
		 */
		function _disable_keyboard_navigation() {
			$(document).unbind();
		}
		/**
		 * Perform the keyboard actions
		 *
		 */
		function _keyboard_action(objEvent) {
			// To ie
			if ( objEvent == null ) {
				keycode = event.keyCode;
				escapeKey = 27;
			// To Mozilla
			} else {
				keycode = objEvent.keyCode;
				escapeKey = objEvent.DOM_VK_ESCAPE;
			}
			// Get the key in lower case form
			key = String.fromCharCode(keycode).toLowerCase();
			// Verify the keys to close the ligthBox
			if ( ( key == settings.keyToClose ) || ( key == 'x' ) || ( keycode == escapeKey ) ) {
				_finish();
			}
			// Verify the key to show the previous image
			if ( ( key == settings.keyToPrev ) || ( keycode == 37 ) ) {
				// If we're not showing the first image, call the previous
				if ( settings.activeImage != 0 ) {
					settings.activeImage = settings.activeImage - 1;
					_set_image_to_view();
					_disable_keyboard_navigation();
				}
			}
			// Verify the key to show the next image
			if ( ( key == settings.keyToNext ) || ( keycode == 39 ) ) {
				// If we're not showing the last image, call the next
				if ( settings.activeImage != ( settings.imageArray.length - 1 ) ) {
					settings.activeImage = settings.activeImage + 1;
					_set_image_to_view();
					_disable_keyboard_navigation();
				}
			}
		}
		/**
		 * Preload prev and next images being showed
		 *
		 */
		function _preload_neighbor_images() {
			if ( (settings.imageArray.length -1) > settings.activeImage ) {
				objNext = new Image();
				objNext.src = settings.imageArray[settings.activeImage + 1][0];
			}
			if ( settings.activeImage > 0 ) {
				objPrev = new Image();
				objPrev.src = settings.imageArray[settings.activeImage -1][0];
			}
		}
		/**
		 * Remove jQuery lightBox plugin HTML markup
		 *
		 */
		function _finish() {
			$('#jquery-lightbox').remove();
			$('#jquery-overlay').fadeOut(function() { $('#jquery-overlay').remove(); });
			// Show some elements to avoid conflict with overlay in IE. These elements appear above the overlay.
			$('embed, object, select').css({ 'visibility' : 'visible' });
		}
		/**
		 / THIRD FUNCTION
		 * getPageSize() by quirksmode.com
		 *
		 * @return Array Return an array with page width, height and window width, height
		 */
		function ___getPageSize() {
			var xScroll, yScroll;
			if (window.innerHeight && window.scrollMaxY) {	
				xScroll = window.innerWidth + window.scrollMaxX;
				yScroll = window.innerHeight + window.scrollMaxY;
			} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
				xScroll = document.body.scrollWidth;
				yScroll = document.body.scrollHeight;
			} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
				xScroll = document.body.offsetWidth;
				yScroll = document.body.offsetHeight;
			}
			var windowWidth, windowHeight;
			if (self.innerHeight) {	// all except Explorer
				if(document.documentElement.clientWidth){
					windowWidth = document.documentElement.clientWidth; 
				} else {
					windowWidth = self.innerWidth;
				}
				windowHeight = self.innerHeight;
			} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
				windowWidth = document.documentElement.clientWidth;
				windowHeight = document.documentElement.clientHeight;
			} else if (document.body) { // other Explorers
				windowWidth = document.body.clientWidth;
				windowHeight = document.body.clientHeight;
			}	
			// for small pages with total height less then height of the viewport
			if(yScroll < windowHeight){
				pageHeight = windowHeight;
			} else { 
				pageHeight = yScroll;
			}
			// for small pages with total width less then width of the viewport
			if(xScroll < windowWidth){	
				pageWidth = xScroll;		
			} else {
				pageWidth = windowWidth;
			}
			arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);
			return arrayPageSize;
		};
		/**
		 / THIRD FUNCTION
		 * getPageScroll() by quirksmode.com
		 *
		 * @return Array Return an array with x,y page scroll values.
		 */
		function ___getPageScroll() {
			var xScroll, yScroll;
			if (self.pageYOffset) {
				yScroll = self.pageYOffset;
				xScroll = self.pageXOffset;
			} else if (document.documentElement && document.documentElement.scrollTop) {	 // Explorer 6 Strict
				yScroll = document.documentElement.scrollTop;
				xScroll = document.documentElement.scrollLeft;
			} else if (document.body) {// all other Explorers
				yScroll = document.body.scrollTop;
				xScroll = document.body.scrollLeft;	
			}
			arrayPageScroll = new Array(xScroll,yScroll);
			return arrayPageScroll;
		};
		 /**
		  * Stop the code execution from a escified time in milisecond
		  *
		  */
		 function ___pause(ms) {
			var date = new Date(); 
			curDate = null;
			do { var curDate = new Date(); }
			while ( curDate - date < ms);
		 };
		// Return the jQuery object for chaining. The unbind method is used to avoid click conflict when the plugin is called more than once
		return this.unbind('click').click(_initialize);
	};
})(jQuery); // Call and execute the function immediately passing the jQuery object