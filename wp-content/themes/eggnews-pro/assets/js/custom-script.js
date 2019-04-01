var $ = jQuery;
$(document).ready(function () {
	'use strict';
	// Ticker
	if ($('#teg-newsTicker').length > 0) {
		$('#teg-newsTicker').bxSlider({
			minSlides: 1,
			maxSlides: 1,
			speed: 3000,

			mode: 'vertical',
			auto: true,



			controls: false,
			pager: false
		});
	}

	var breaking_news_args = {
		auto: true,
		pager: false,
		minSlides: 3,
		maxSlides: 3,
		speed: 3000,
		moveSlides: 1,
		controls: true,
		prevText: '<i class="fa fa-arrow-up"> </i>',
		nextText: '<i class="fa fa-arrow-down"> </i>'
	};
	$('.breaking-news-slider').each(function () {
		var duration, direction;
		direction = $(this).data('direction')
		duration = $(this).data('duration');
		breaking_news_args.speed = duration;
		breaking_news_args.mode = direction;
		$(this).bxSlider(breaking_news_args);
	});

	// Slider
	if ($('.eggnewsSlider').length > 0) {
		$('.eggnewsSlider').bxSlider({
			pager: false,
			auto: true,
			controls: true,
			prevText: '<i class="fa fa-chevron-left"> </i>',
			nextText: '<i class="fa fa-chevron-right"> </i>'
		});
	}
	
	//$('.teg-carousel-section').removeClass('teg-before-carousel-js-load');
	
	var eggnews_carousel = $('.eggnews-carousel');
	var eggnews_carousel_args = {
		navigation: true, // Show next and prev buttons
		slideSpeed: 300,
		paginationSpeed: 400,
		singleItem: true,
		mouseDrag: false,
		touchDrag: true,
		margin: 10,
		controls: true,
		loop: true,
		nav: false,
		autoplayTimeout: 2200,
		autoplay: true,
		navText: ['<i class="fa fa-chevron-left"> </i>', '<i class="fa fa-chevron-right"> </i>']
	};
	if (eggnews_carousel.length > 0) {
		eggnews_carousel.each(function () {
			var items = $(this).parent().width() / 300;
			eggnews_carousel_args.items = (items > 3) ? 3 : (items < 1) ? 1 : Math.floor(items);
			var data_timer = undefined !== $(this).attr('data-timer') ? $(this).attr('data-timer') : 2200;
			eggnews_carousel_args.autoplayTimeout = data_timer;
			var data_duration = undefined !== $(this).attr('data-duration') ? $(this).attr('data-duration') : 500;
			eggnews_carousel_args.smartSpeed = data_duration;
			$(this).owlCarousel(eggnews_carousel_args);
		});
	}

	//Search toggle
	$('.header-search-wrapper .search-main').click(function () {
		$('.search-form-main').toggleClass('active-search');
		$('.search-form-main .search-field').focus();
	});

	//responsive menu toggle
	$('.bottom-header-wrapper .menu-toggle').click(function () {
		$('.bottom-header-wrapper #site-navigation').slideToggle('slow');
	});

	//responsive sub menu toggle
	$('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
	$('#site-navigation .sub-toggle').click(function () {
		$(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
		$(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});

	// Scroll To Top
	$(window).scroll(function () {
		if ($(this).scrollTop() > 700) {
			$('#teg-scrollup').fadeIn('slow');
		} else {
			$('#teg-scrollup').fadeOut('slow');
		}
	});
	$('#teg-scrollup').click(function () {
		$('html, body').animate({scrollTop: 0}, 600);
		return false;
	});

	//column block wrap js
	var divs = $('section.eggnews_block_column');
	for (var i = 0; i < divs.length;) {
		i += divs.eq(i).nextUntil(':not(.eggnews_block_column').andSelf().wrapAll('<div class="eggnews_block_column-wrap"> </div>').length;
	}
	// Tabbed widget
	if (typeof jQuery.fn.easytabs !== 'undefined') {

		jQuery('.tab-widget').easytabs();
	}
});

//reading progress indicator
function reading_progress_indicator() {
	var winHeight = $(window).height(),
	docHeight = $(document).height(),
	progressBar = $('#reading-progress-indicator'),
	max, value;

	/* Set the max scrollable area */
	max = docHeight - winHeight;
	progressBar.attr('max', max);


	$(document).on('scroll', function () {
		value = $(window).scrollTop();
		progressBar.attr('value', value);
	});
}

/**                 
* Custom Script for Load more Feature                 
* @package Theme Egg                 
* @subpackage eggnews-pro                 
* @since 1.2.0  **/

jQuery(function($){
	$('.post_listing_loadmore').click(function(){
		var button = $(this);
		if(button.hasClass('loading')){
			return;
		}
		var all_ids = [];
		var single_post = button.closest('.eggnews_posts_list').find('.single-post-wrapper');
		single_post.each(function(){
			var __this_id = $(this).data('id');
			all_ids.push(__this_id);
		});
		var posts_per_page = button.data('per-page');
		var paged = button.attr('data-page');
		var excerpt = button.data('excerpt');
		var hide_post_date = button.data('hide_post_date');
		var hide_author = button.data('hide_author');
		var excerpt_length = button.data('excerpt-length');
		var buttonText = button.text();
		var loadingText = button.data('loading');
		var posts_type  = button.data('post_type');
		var classs = button.data('classs');
		var data = {
			'action': 'post_listing_loadmore',
			'paged' : paged,
			'hide_post_date' : hide_post_date,
			'hide_author' : hide_author,
			'posts_per_page' : posts_per_page,
			'excerpt': excerpt,
			'excerpt_length' : excerpt_length,
			'posts_type' : posts_type,
			'post__not_in' : all_ids,
			
		};
		
		$.ajax({

			url : eggnewspro_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.addClass('loading');
				button.text(loadingText); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					button.text( buttonText );
					button.closest('.'+classs).find('.posts-list-wrapper').append(data);
					paged++;
					button.attr('data-page', paged);
				} else {
					button.remove(); // if no data, remove the button as well
				}
				button.removeClass('loading');
			}
		});
	});
});


		/*custom script of pro*/
		$(document).ready(function () {

		/**                 
		* Custom Script for Sticky Sidebar on post, page and archive                 
		* @package Theme Egg                 
		* @subpackage eggnews-pro                 
		* @since 1.2.0  **/

		if(typeof $().theiaStickySidebar == 'function'){
			jQuery(document).ready(function() {
				jQuery('#primary, #secondary').theiaStickySidebar({
					additionalMarginTop: 30,
				});
			});
		}

 	// Lightbox for Youtube Vidieo
 	$('.eggnews_youtube_playlist .play').on('click', function (e) {

 		var id = $(this).data('video_id');
 		var video_url = 'https://youtube.com/embed/' + id;
 		$('<div id="youtube_dialog"><iframe class="youtube_embed" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe></div>').dialog({
 			width: 600,
 			modal: true,
 			position: {my: 'center', at: 'center', of: window},
 			title: $(this).attr('title'),
 			close: function () {
				//$('.youtube_embed').attr('src', '');
				$(this).dialog('destroy').remove();
			}
		});
 		$('.youtube_embed').attr('src', video_url);
 		e.preventDefault();
 	});

	//Lightbox For Image
	$(
		'.single_featured_ltbox .hentry .single-post-image img,' +
		'.single_content_ltbox .hentry .entry-content img'
		).on('click', function (e) {
			var dologue_html = $(this).clone();
			dologue_html.dialog({
				width: 1000,
				modal: true,
				position: {my: 'center', at: 'center', of: window},
				title: $(this).attr('alt'),
				close: function () {
					$(this).dialog('destroy').remove();
				}

			});
			e.preventDefault();
		});

	//Reading Position Indicator
	reading_progress_indicator();
	$(window).on('resize', function () {
		reading_progress_indicator();
	});

	var teg_articles_box = {
		is_box_visible: false,
		cookie: '',
		distance_from_top: 400,

		init: function init() {

			var after_scroll_button = 50;
			$(window).scroll(function () {
				if ($(this).scrollTop() > after_scroll_button) { // this refers to window
					$('.teg-more-articles-box').addClass('teg-front-end-display-block');
				} else {
					$('.teg-more-articles-box').removeClass('teg-front-end-display-block');
				}
			});
			//adding event to hide the box
			$('body').on('click', '.teg-close-more-articles-box', function () {
				$('.teg-more-articles-box').remove();
			});
		},

	};

	teg_articles_box.init();
});

/**                 
* Preloader Feature                 
* @package Theme Egg                 
* @subpackage eggnews-pro                 
* @since 1.2.0  **/
$(window).load(function(){
	$('.preloader').fadeOut();
});

//auto scrolling features

// window.players = function($elem) {
//     var top = parseInt($elem.css("top"));
//     var temp = -1 * $('.players > li').height();
//     if(top < temp) {
//         top = $('.players').height()
//         $elem.css("top", top);
//     }
//     $elem.animate({ top: (parseInt(top)-60) }, 600, function () {
//       window.players($(this))
//     });
// }
// $(document).ready(function() {
//     var i = 0;
//     $(".players > li").each(function () {
//           $(this).css("top", i);
//           i += 60;
//           window.players($(this));
//     });
// });


