/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
	// Site title and description.
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.site-title a').text(to);
		});
	});
	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			$('.site-description').text(to);
		});
	});
	// Header text color.
	wp.customize('header_textcolor', function (value) {
		value.bind(function (to) {
			if ('blank' === to) {
				$('.site-title a, .site-description').css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$('.site-title a, .site-description').css({
					'clip': 'auto',
					'position': 'relative'
				});
				$('.site-title a, .site-description').css({'color': to});
			}
		});
	});
	//Top Header date
	wp.customize('eggnews_header_date', function (value) {
		value.bind(function (to) {
			if (to === 'disable') {
				$('.top-header-section .date-section').fadeOut();
			} else {
				$('.top-header-section .date-section').fadeIn();
			}
		});
	});
	//Top Header social
	wp.customize('eggnews_header_social_option', function (value) {
		value.bind(function (to) {
			if (to === 'disable') {
				$('.top-header-section .top-social-wrapper').fadeOut();
			} else {
				$('.top-header-section .top-social-wrapper').fadeIn();
			}
		});
	});
	//News ticker
	wp.customize('eggnews_ticker_option', function (value) {
		value.bind(function (to) {
			if (to === 'disable') {
				$('.eggnews-ticker-wrapper').fadeOut();
			} else {
				$('.eggnews-ticker-wrapper').fadeIn();
			}
		});
	});
	wp.customize('eggnews_ticker_caption', function (value) {
		value.bind(function (to) {
			$('span.ticker-caption').html(to);
		});
	});

	// Home Icon
	wp.customize('eggnews_home_option', function (value) {
		value.bind(function (to) {
			if (to === 'disable') {
				$('.home-icon').fadeOut();
			} else {
				$('.home-icon').fadeIn();
			}
		});
	});
	wp.customize('eggnews_search_option', function (value) {
		value.bind(function (to) {
			if (to === 'disable') {
				$('.header-search-wrapper').fadeOut();
			} else {
				$('.header-search-wrapper').fadeIn();
			}
		});
	});
	wp.customize('eggnews_random_post_option', function (value) {
		value.bind(function (to) {
			if (to === 'disable') {
				$('.random-post').fadeOut();
			} else {
				$('.random-post').fadeIn();
			}
		});
	});


    /**                 
		* JS for live load on customizer
		* @package Theme Egg                 
		* @subpackage eggnews-pro                 
		* @since 1.3.0   
	*/ 
	
	//view count on archive page
	wp.customize('eggnews_archive_view_counter_option', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.post-views').fadeOut();
			} else {
				$('.post-views').fadeIn();
			}
		});
	});
	//comment on archive page
	wp.customize('show_hide_archive_comment', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.comments-link').fadeOut();
			} else {
				$('.comments-link').fadeIn();
			}
		});
	});
	//category on archive page
	wp.customize('show_hide_archive_category', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.post-cat-list').fadeOut();
			} else {
				$('.post-cat-list').fadeIn();
			}
		});
	});
	//date of post and author on archive page
	wp.customize('show_hide_archive_date_author', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.posted-on').fadeOut();
			} else {
				$('.posted-on').fadeIn();
			}
		});
	});

	wp.customize('show_hide_archive_date_author', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.byline').fadeOut();
			} else {
				$('.byline').fadeIn();
			}
		});
	});
	//view count on single post
	wp.customize('eggnews_view_counter_option', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.post-views').fadeOut();
			} else {
				$('.post-views').fadeIn();
			}
		});
	});
	//category on single post
	wp.customize('eggnews_category_option', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.post-cat-list').fadeOut();
			} else {
				$('.post-cat-list').fadeIn();
			}
		});
	});
	//comment on single post
	wp.customize('eggnews_comment_count_option', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.comments-link').fadeOut();
			} else {
				$('.comments-link').fadeIn();
			}
		});
	});
	//date of post and author on asingle post
	wp.customize('eggnews_date_author_option', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.posted-on').fadeOut();
			} else {
				$('.posted-on').fadeIn();
			}
		});
	});
	wp.customize('eggnews_date_author_option', function (value) {
		value.bind(function (to) {
			if (to === 'hide') {
				$('.byline').fadeOut();
			} else {
				$('.byline').fadeIn();
			}
		});
	});
	//author box on single post
	wp.customize('eggnews_author_box_option', function (value) {
			value.bind(function (to) {
				if (to === 'hide') {
					$('.eggnews-author-wrapper').fadeOut();
				} else {
					$('.eggnews-author-wrapper').fadeIn();
				}
			});
		});
	//social sharing on single post
	wp.customize('eggnews_social_sharing_option', function (value) {
			value.bind(function (to) {
				if (to === 'hide') {
					$('.teg-post-sharing').fadeOut();
				} else {
					$('.teg-post-sharing').fadeIn();
				}
			});
		});
//featured image on single post
	wp.customize('eggnews_show_hide_feature_on_singe_post', function (value) {
			value.bind(function (to) {
				if (to === 'hide') {
					$('.single-post-image').fadeOut();
				} else {
					$('.single-post-image').fadeIn();
				}
			});
		});
	//related articles on single post
	wp.customize('eggnews_related_articles_option', function (value) {
			value.bind(function (to) {
				if (to === 'disable') {
					$('.related-articles-wrapper').fadeOut();
				} else {
					$('.related-articles-wrapper').fadeIn();
				}
			});
		});
	//Change Home Icon
	wp.customize('eggnews_home_icon_option', function (value) {
			value.bind(function (to) {
				if(to==''){
					to= 'fa fa-home';
				}
				$('#teg-menu-wrap').find(".home-icon").find("i.fa").attr('class',to);
			});
		});
	//Change Search Icon
	wp.customize('eggnews_search_icon_option', function (value) {
			value.bind(function (to) {
				if(to==''){
					to= 'fa fa-search';
				}
				$('#teg-menu-wrap').find(".search-main").find("i.fa").attr('class',to);
			});
		});
	//Change Random Icon
	wp.customize('eggnews_random_icon_option', function (value) {
			value.bind(function (to) {
				if(to==''){
					to= 'fa fa-random';
				}
				$('#teg-menu-wrap').find(".random-post").find("i.fa").attr('class',to);
			});
		});
	//Change nav Icon
	wp.customize('eggnews_nav_icon_option', function (value) {
			value.bind(function (to) {
				if(to==''){
					to= 'fa fa-random';
				}
				$('#teg-menu-wrap').find('.home-icon').next('.menu-toggle').find("i").attr('class',to);
			});
		});
}(jQuery));




