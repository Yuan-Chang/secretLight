var FixedHeader = {}, LayoutAndFilter = {};

// jQuery functions
(function ($) {


	// Infinite Scroll ///////////////////////////////
	function doInfinite($container, selector, is_shortcode) {

		if ('undefined' !== typeof $.fn.infinitescroll) {

			// Get max pages for regular category pages and home
			var $loader = $container.next('.load-more');

			// disable auto infinite scroll based on user selection
			if ('auto' === themifyScript.autoInfinite && !$loader.hasClass('load-more-show')) {
				$loader.hide();
			}
			var scrollMaxPages = parseInt($loader.data('max')),
					$href = $loader.children('a'),
					$visible = $loader.is(':visible');

			// infinite scroll
			var $args = {
				navSelector: $href, // selector for the paged navigation
				nextSelector: $href, // selector for the NEXT link (to page 2)
				itemSelector: selector, // selector for all items you'll retrieve
				appendCallback: true,
				loadingText: ' ',
				donetext: '',
				msgText: '',
				maxPage: scrollMaxPages,
				behavior: $loader.hasClass('load-more-show') || 'auto' !== themifyScript.autoInfinite ? 'twitter' : '',
				bufferPx: 50,
				page: 1,
				pixelsFromNavToBottom: $('#footerwrap').height(),
			};
			if (!$visible) {
				$args.loading = {img: themifyScript.loadingImg};
			}
			else {
				$container.addClass('infinity_without_loader');
			}
			if (is_shortcode) {
				$args.path = function (nextPage) {
					if ($visible) {
						$loader.addClass('loader-wait');
					}
					return $href.prop('href').replace(/paging=([0-9]*)/, 'paging=' + nextPage);
				};
			}
			else {
				if ($visible) {
					$args.path = function (nextPage) {
						$loader.addClass('loader-wait');
						return $href.prop('href').replace(/paging=([0-9]*)/, 'paging=' + nextPage);
					};
				}
				$args.pathParse = function (path) {
					return path.match(/^(.*?)\b2\b(?!.*\b2\b)(.*?$)/).slice(1);
				};
			}
			$container.infinitescroll($args, function (newElements, opts) {
				// call Isotope for new elements
				var $newElems = $(newElements);

				// Mark new items: remove newItems from already loaded items and add it to loaded items
				$('.newItems').removeClass('newItems');
				$newElems.first().addClass('newItems');
				$scroll = themifyScript.scrollToNewOnLoad;
				if ('reset' === themifyScript.resetFilterOnLoad) {
					// Make filtered elements visible again
					LayoutAndFilter.reset();
				}

				$newElems.hide().imagesLoaded().always(function (instance) {

					$('.wp-audio-shortcode, .wp-video-shortcode').not('div').each(function () {
						var $self = $(this);
						if ($self.closest('.mejs-audio').length === 0) {
							ThemifyMediaElement.init($self);
						}
					});
					$newElems.fadeIn();
					// Apply lightbox/fullscreen gallery to new items
					Themify.InitGallery();
					if ('object' === typeof $container.data('isotope')) {
						$container.isotope('appended', $newElems);
					}

					/**
					 * Fires event after the elements and its images are loaded.
					 *
					 * @event infiniteloaded.themify
					 * @param {object} $newElems The elements that were loaded.
					 */
					if ($('body').hasClass('tile_enable')) {
						if ($container.hasClass('custom_tiles')) {
							custom_tiles($container, $newElems);
							if ($scroll) {
								$scroll = false;
								$container.on('custom_tiles_ready.themify', function (e) {
									$container.off('custom_tiles_ready.themify');
									LayoutAndFilter.restore($container);
								});
							}
						}
						else if ($container.hasClass('auto_tiles')) {
							$container.trigger('infiniteloaded.themify', [$newElems]);//for multiply shortcodes
							if ($scroll) {
								$scroll = false;
								$container.on('auto_tiles_ready.themify', function (e) {
									$container.off('auto_tiles_ready.themify');
									LayoutAndFilter.restore($container);
								});
							}
						}
					}


					if (LayoutAndFilter.filterActive) {
						// If new elements with new categories were added enable them in filter bar
						LayoutAndFilter.enableFilters();
					}
					if ($scroll) {
						LayoutAndFilter.restore($container);
					}
					$('body').trigger('infiniteloaded.themify', [$newElems]);
					$(window).trigger('resize');
					$('#infscr-loading').fadeOut('normal');
					if (1 === scrollMaxPages) {
						$loader.remove();
					}
					$loader.removeClass('loader-wait');

				});
				scrollMaxPages = scrollMaxPages - 1;

				if (1 < scrollMaxPages && 'auto' !== themifyScript.autoInfinite) {
					$loader.show();
				}
			});
		}
	}
	;

// Entry Filter /////////////////////////
	LayoutAndFilter = {
		filterActive: false,
		init: function () {
			if ($('.post-filter').length > 0) {
				$('.post-filter + .loops-wrapper,.loops-wrapper.grid4,.loops-wrapper.grid3,.loops-wrapper.grid2').not('.builder-posts-wrap,.list-post').prepend('<div class="grid-sizer"></div><div class="gutter-sizer"></div>');
				this.enableFilters();
				this.filter();
				this.filterActive = true;
			}
		},
		enableFilters: function () {
			var $filter = $('.post-filter');
			if ($filter.find('a').length > 0 && 'undefined' !== typeof $.fn.isotope) {
				$filter.find('li').each(function () {
					var $li = $(this),
							$entries = $li.parent().next(),
							cat = $li.attr('class').replace(/(current-cat)|(cat-item)|(-)|(active)/g, '').replace(' ', '');
					if ($entries.find('.post.cat-' + cat).length <= 0) {
						$li.hide();
					} else {
						$li.show();
					}
				});
			}
		},
		filter: function () {
			var $filter = $('.post-filter'),
				self = this,
				$rtl = $('body').hasClass('rtl');
			if ($filter.find('a').length > 0 && 'undefined' !== typeof $.fn.isotope) {
				$filter.addClass('filter-visible').on('click', 'a', function (e) {
					e.preventDefault();
					if ($filter.hasClass('filter-disable')) {
						return;
					}
					$filter.addClass('filter-disable');
					var $li = $(this).parent(),
						$entries = $li.parent().next(),
						$auto = $('body').hasClass('tile_enable') && $entries.hasClass('auto_tiles'),
						$custom_tiles = $entries.hasClass('custom_tiles'),
						$cat = false,
						$masonry = {gutter: '.gutter-sizer'};
						if(!$auto){
							$masonry.columnWidth = '.grid-sizer';
						}
					if ($li.hasClass('active')) {
						$li.removeClass('active');
						if (!$auto) {
							$entries.isotope({
								masonry: $masonry,
								isResizeBound : $custom_tiles,
								isOriginLeft: !$rtl,
								filter: '*'
							});
						}
					}
					else {
						$li.siblings('.active').removeClass('active');
						$li.addClass('active');
						$cat = $li.attr('class').replace(/(current-cat)|(cat-item)|(-)|(active)/g, '').replace(' ', '');
						if (!$auto) {
							$entries.isotope({
								masonry: $masonry,
								isResizeBound : !$custom_tiles,
								itemSelector: '.post',
								isOriginLeft: !$rtl,
								filter: '.cat-' + $cat
							});
						}
					}
					if (!e.isTrigger && $auto && $entries.data('themify_tiles')) {
						var $post = $entries.children('.post');
						$post.show();
						if ($cat) {
							$post.not('.cat-' + $cat).hide();
						}
						$entries.data('themify_tiles').update();
						setTimeout(function () {
							$.themify_tiles.resizeParent($entries);
							$filter.removeClass('filter-disable');
						}, Math.round(parseFloat($entries.css('transition-duration')) * 1000) + 100);

					}
					else {
						$filter.removeClass('filter-disable');
					}
				});
			}
		},
		scrolling: false,
		reset: function () {
			$('.post-filter').find('li.active').find('a').addClass('previous-active').trigger('click');
			this.scrolling = true;
		},
		restore: function ($container) {
			var $first = $container.find('.newItems').first();
			if ($first) {
				var self = this,
						to = $first.offset().top - ($first.outerHeight(true) / 2),
						speed = 800;
				if (to >= 800) {
					speed = 800 + Math.abs((to / 1000) * 100);
				}
				$('html,body').stop().animate({
					scrollTop: to
				}, speed, function () {
					self.scrolling = false;
				});
			}
		},
		layout: function () {
			var $isotop = $('.post-filter + .loops-wrapper,.masonry').not('.builder-posts-wrap,.list-post,.auto_tiles');
			if ($isotop.length > 0) {
				var $rtl = $('body').hasClass('rtl');
				$isotop.each(function () {
					var $is_custom = $(this).hasClass('custom_tiles');
					if ($(this).hasClass('masonry') && $is_custom) {
						return;
					}
					var $this = $(this),
						$is_post = $this.children('.post').length > 0;
					if ($is_post && $this.prev('.post-filter').length === 0 && $this.find('.gutter-sizer').length === 0) {
						$this.prepend('<div class="grid-sizer"></div><div class="gutter-sizer"></div>');
					}
					$this.imagesLoaded().always(function (instance) {
						$this.addClass('masonry-done').isotope({
							masonry: $is_post?{columnWidth: '.grid-sizer',gutter: '.gutter-sizer'}:{},
							isOriginLeft: !$rtl,
							isResizeBound : !$is_custom,
							itemSelector: $is_post ? '.post' : '.item'
						});
					   
					});
				});
			}
		}
	};

	// Fixed Header /////////////////////////
	FixedHeader = {
		headerHeight: 0,
		hasHeaderSlider: false,
		headerSlider: false,
		init: function () {
			FixedHeader.calculateHeaderHeight();
			$('#pagewrap').css('paddingTop', Math.floor(FixedHeader.headerHeight));
			if ('' !== themifyScript.fixedHeader) {
				FixedHeader.activate();
				$(window).on('scroll touchstart.touchScroll touchmove.touchScroll', FixedHeader.activate);
			}
			$(window).on('debouncedresize', function () {
				FixedHeader.calculateHeaderHeight();
				$('#pagewrap').css('paddingTop', Math.floor(FixedHeader.headerHeight));
			});
			if ($('#gallery-controller').length > 0) {
				FixedHeader.hasHeaderSlider = true;
			}

			// test
			$(window).load(FixedHeader.calculateHeaderHeight);
			$('body').on('announcement_bar_position', FixedHeader.calculateHeaderHeight);
			$('body').on('announcement_bar_scroll_on_after', FixedHeader.calculateHeaderHeight);
		},
		activate: function () {
			var $window = $(window),
					scrollTop = $window.scrollTop(),
					$headerWrap = $('#headerwrap');
			$('#pagewrap').css('paddingTop', Math.floor(FixedHeader.headerHeight));
			if (scrollTop >= FixedHeader.headerHeight) {
				if (!$headerWrap.hasClass('fixed-header')) {
					FixedHeader.scrollEnabled();
				}
			} else {
				if ($headerWrap.hasClass('fixed-header')) {
					FixedHeader.scrollDisabled();
				}
			}
		},
		scrollDisabled: function () {
			$('#pagewrap').css('paddingTop', Math.floor(FixedHeader.headerHeight));
			$('#headerwrap').removeClass('fixed-header');
			$('#header').removeClass('header-on-scroll');
			$('body').removeClass('fixed-header-on');
			if (FixedHeader.hasHeaderSlider && 'object' === typeof $('#headerwrap').data('backstretch')) {
				$('#headerwrap').data('backstretch').resize();
				$('#gallery-controller .slides').trigger('next');
			}
		},
		scrollEnabled: function () {
			$('#headerwrap').addClass('fixed-header');
			$('#header').addClass('header-on-scroll');
			$('body').addClass('fixed-header-on');
			if (FixedHeader.hasHeaderSlider && 'object' === typeof $('#headerwrap').data('backstretch')) {
				$('#headerwrap').data('backstretch').resize();
				$('#gallery-controller .slides').trigger('next');
			}
		},
		calculateHeaderHeight: function () {

			FixedHeader.headerHeight = $('#headerwrap').outerHeight(true);
		}
	};

	var custom_tiles = function (container, $newElems) {

		if (container.find('.post-tiled').length === 0) {
			return;
		}
		container.imagesLoaded().always(function (instance) {
			var $post = $newElems ? $newElems.find('.post') : container.find('.post-tiled');


			if ($newElems) {
				container.masonry('appended', $newElems);
			} else {

				var gutter = $('<div class="gutter-sizer" style="visibility: hidden !important; opacity: 0;" />').appendTo(container);
				var gwidth = gutter.width();
				gutter.remove();
				var $small = container.find('.post-tiled.tiled-square-small'),
						$large = container.find('.post-tiled.tiled-square-large'),
						$landscape = container.find('.post-tiled.tiled-landscape'),
						$portrait = container.find('.post-tiled.tiled-portrait');

				if ($small.length > 0) {
					var width = $small.width();
					$small.height(width);
				}
				else {
					var dummy = $('<div class="post-tiled tiled-square-small" style="visibility: hidden !important; opacity: 0;" />').appendTo(container);
					var width = dummy.width();
					dummy.remove();
				}
				if ($large.length > 0) {
					$large.height((width * 2) + gwidth);
				}
				if ($landscape.length > 0) {
					$landscape.height(width);
				}
				if ($portrait.length > 0) {
					$portrait.height((width * 2) + gwidth);
				}
				container.masonry({
					isResizeBound : false,
					itemSelector: '.post-tiled',
					columnWidth: width,
					gutter: gwidth
				});
			}
			$post.each(function () {
				themify_backstretch($(this).find('.post-image'));
			});
			container.addClass('loading-finish').trigger('custom_tiles_ready.themify');
		});

	};

	function themify_backstretch($postImage) {
		var $img = $postImage.find('img'),
			src = $img.prop('src');
		if (src) {
			$postImage.backstretch(src);
			var $a = $postImage.find('a'),
					$saveA = $a;
			$a.remove();
			$img.remove();
			$postImage.find('img').wrap($saveA);
		}
	}

	function split_cover_image($postImage) {
		if ($(window).width() > 680) {
			$postImage.imagesLoaded().done(function (instance) {
				themify_backstretch($postImage);
			});
		}
	}

	$(document).ready(function () {
		var $body = $('body'),
				$window = $(window);
		/////////////////////////////////////////////
		// Initialize Packery Layout and Filter
		/////////////////////////////////////////////
		FixedHeader.init();
		if ($.fn.flexslider) {
			$('.flexslider').imagesLoaded().done(function (instance) {
				$('.flexslider').flexslider({
					animation: "slide"
				});
			});
		}
		var $postImage = $('.single-split-layout .featured-area>.post-image');
		if ($postImage.length > 0) {
			split_cover_image($postImage);
			$window.on('debouncedresize', function () {
				if ($window.width() <= 680) {
					if ($postImage.data('backstretch')) {
						$postImage.html($postImage.find('.backstretch').html());
						$postImage.find('img').removeAttr('style');
						$postImage.removeAttr('style');

					}
				}
				else {
					split_cover_image($postImage);
				}
			});
		}

		if ( $('.has-mega-sub-menu').length ) {
            Themify.LoadAsync(themifyScript.themeURI + '/js/themify.mega-menu.js', null,
            null,
            null,
            function () {
                return ('undefined' !== typeof $.fn.ThemifyMegaMenu);
            });
        }

		$('.loops-wrapper').each(function () {
			var $filter = $(this).children('.post-filter');
			if ($filter.length > 0) {
				$(this).before($filter);
			}
		});
		LayoutAndFilter.init();
                LayoutAndFilter.layout();
		$('.loops-wrapper.custom_tiles,.loops-wrapper.auto_tiles').addClass('tiled');
		if ($body.hasClass('tile_enable')) {
			if ($('.loops-wrapper.custom_tiles').length > 0) {
				$('.loops-wrapper.custom_tiles').each(function () {
					var $masonry_container = $(this);
					custom_tiles($masonry_container);
					$(window).on('debouncedresize', function () {
						custom_tiles($masonry_container);
					});

				});
			}
			if ($('.loops-wrapper.auto_tiles').length > 0) {

				var container = $('.loops-wrapper.auto_tiles');
				var dummy = $('<div class="post-tiled tiled-square-small" style="visibility: hidden !important; opacity: 0;" />').appendTo(container.first());
				var $small = parseFloat(dummy.width());
				dummy.remove();
				var $gutter = themifyScript.tiledata['padding'];
				container.each(function () {
					var $this = $(this);
					$(this).imagesLoaded().always(function (instance) {
						var $post = $this.children('.post');
						themifyScript.tiledata['padding'] = $this.hasClass('no-gutter') ? 0 : $gutter;
						$this.themify_tiles(themifyScript.tiledata, $small);
						setClasses($post, $small);
					});
				});
			}
		}

		///////////////////////////////////////////
		// Initialize infinite scroll
		///////////////////////////////////////////
		if ($body.hasClass('woocommerce') && $body.hasClass('archive')) {
			doInfinite($('#content ul.products'), '#content .product');
		}
		$('.loops-wrapper').each(function () {
			var $load = $(this).find('.load-more');
			if ($load.length > 0) {
				$(this).after($load);
				doInfinite($(this), '.post', true);
			}
			else if ($(this).next('.load-more').length > 0) {
				doInfinite($(this), '.post', false);
			}

		});
		/////////////////////////////////////////////
		// Scroll to top 							
		/////////////////////////////////////////////
		$('.back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

		/////////////////////////////////////////////
		// Toggle main nav on mobile 							
		/////////////////////////////////////////////
		// touch dropdown menu
		if ($('body').hasClass('touch') && typeof jQuery.fn.themifyDropdown !== 'function') {
			Themify.LoadAsync(themify_vars.url + '/js/themify.dropdown.js', function () {
				$('#main-nav').themifyDropdown();
			}, null, null, function () {
				return ('undefined' !== typeof $.fn.themifyDropdown);
			});
		}

		$('#menu-icon').themifySideMenu({
			close: '#menu-icon-close'
		});

		var $overlay = $('<div class="body-overlay">');
		$body.append($overlay).on('sidemenushow.themify', function () {
			$overlay.addClass('body-overlay-on');
		}).on('sidemenuhide.themify', function () {
			$overlay.removeClass('body-overlay-on');
		}).on('click.themify touchend.themify', '.body-overlay', function () {
			$('#menu-icon').themifySideMenu('hide');
		});

		$(window).resize(function(){
			var viewport = $(window).width();
			if ( viewport > tf_mobile_menu_trigger_point ) {
				$( '#menu-icon' ).themifySideMenu( 'hide' );
			}
		});

		$window.resize(function () {
			if ($('#menu-icon').is(':visible') && $('#mobile-menu').hasClass('sidemenu-on')) {
				$overlay.addClass('body-overlay-on');
			}
			else {
				$overlay.removeClass('body-overlay-on');
			}
		});

		// Reset slide nav width
		$window.resize(function () {
			var viewport = $(window).width();
			if (viewport > 780) {
				$('body').removeAttr('style');
			}
		});

		// Mega menu width
		$window.resize(function () {
			var $megamenuwidth = $('#header').width();
			var vviewport = $(window).width();

			if (vviewport > tf_mobile_menu_trigger_point) {
				$('#main-nav li.has-mega-column > .mega-column-wrapper, #main-nav li.has-mega-sub-menu > .mega-sub-menu').css(
						'width', $megamenuwidth
						);
			} else {
				$('#main-nav li.has-mega-column > .mega-column-wrapper').removeAttr("style");
				$('#main-nav li.has-mega-sub-menu > .mega-sub-menu').removeAttr("style");
			}
		});

	});

	$(window).load(function () {
		var $body = $('body'),
				$window = $(window);

		// Move menu into side panel on small screens
		var $mainMenu = $('#main-nav-wrap, #searchform-wrap, .social-widget');
		var sbarParent, sbarChild, sbarWidth;

		if (sbarWidth === undefined) {
			sbarParent = $('<div class="scrollbar-parent"><div/></div>').appendTo('body');
			sbarChild = sbarParent.children();
			sbarWidth = sbarChild.innerWidth() - sbarChild.height(99).innerWidth();
			sbarParent.remove();
		}

		if ($mainMenu.length > 0) {
			themifyScript.smallScreen = parseInt(themifyScript.smallScreen, 10);
			themifyScript.resizeRefresh = parseInt(themifyScript.resizeRefresh, 10);
			var isSmallScreen = function () {
				return $(window).width() <= themifyScript.smallScreen;
			},
			$mobileNavWrap = $('.slideout-widgets'),
			$desktopNavWrap = $('#menu-wrapper');

			if (isSmallScreen()) {
				$mainMenu.detach().insertBefore($mobileNavWrap);
			}

			if( !( 'orientation' in window ) ) {
				var didResize = false;

				$window.resize(function () {
					didResize = true;
				});

				var didResize = false;
				$window.on('resize', function () {
					didResize = true;
				});
				setInterval(function () {
					if (didResize) {
						didResize = false;
						$body.trigger('didresize.themify');
					}
				}, 250);
			}

			var didScroll = false;
			$window.on('scroll', function () {
				didScroll = true;
			});
			setInterval(function () {
				if (didScroll) {
					didScroll = false;
					$body.trigger('didscroll.themify');
				}
			}, 250);

			$body.on('didresize.themify', function () {
				 var $jQwidth = $("#mobile-menu").hasClass("sidemenu-on")?$(window).outerWidth():($(window).outerWidth() + sbarWidth);

				if ($jQwidth <= tf_mobile_menu_trigger_point) {
					$mainMenu.detach().insertBefore($mobileNavWrap);
				} else {
					$mainMenu.detach().prependTo($desktopNavWrap);
				}
			});

		}


		// EDGE MENU //
		$("#main-nav li").on('mouseenter mouseleave dropdown_open', function (e) {
			if ($('ul', this).length) {
				var elm = $('ul:first', this);
				var off = elm.offset();
				var l = off.left;
				var w = elm.width();
				var docW = $(window).width();
				var isEntirelyVisible = (l + w <= docW);

				if (!isEntirelyVisible) {
					$(this).addClass('edge');
				} else {
					$(this).removeClass('edge');
				}

			}
		});

	});

	$(document).on('click', '.likeit', function (e) {
		e.preventDefault();
		var $self = $(this),
				$parent = $self.parent(),
				post_id = $self.data('postid'),
				$container = $('#loops-wrapper');

		$.post(
				themifyScript.ajax_url,
				{
					action: 'themify_likeit',
					nonce: themifyScript.ajax_nonce,
					post_id: post_id
				},
		function (response) {
			data = $.parseJSON(response);
			if ('new' == data.status) {
				$('.newliker', $parent).fadeIn();
				$('ins', $self).fadeOut('slow', function () {
					$(this).text(data.likers).fadeIn('slow');
				});
				$container.isotope('layout');
			}
			if ('isliker' == data.status) {
				$('.newliker', $parent).hide();
				$('.isliker', $parent).fadeIn();
				$container.isotope('layout');
			}
		}
		);
	});
})(jQuery);