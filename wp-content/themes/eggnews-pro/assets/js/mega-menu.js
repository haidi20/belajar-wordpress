var $ = jQuery;

$(document).ready(function () {
	'use strict';
	var teLoadingBox = {};


	(function () {
		"use strict";
		teLoadingBox = {

			//arrayColors: ['#ffffff', '#fafafa', '#ececec', '#dddddd', '#bfbfbf', '#9a9a9a', '#7e7e7e', '#636363'],//whiter -> darker

			speed: 40,

			arrayColorsTemp: [
				'rgba(99, 99, 99, 0)',
				'rgba(99, 99, 99, 0.05)',
				'rgba(99, 99, 99, 0.08)',
				'rgba(99, 99, 99, 0.2)',
				'rgba(99, 99, 99, 0.3)',
				'rgba(99, 99, 99, 0.5)',
				'rgba(99, 99, 99, 0.6)',
				'rgba(99, 99, 99, 1)'
			],//whiter -> darker

			arrayColors: [],

			statusAnimation: 'stop',

			//stop loading box
			stop: function stop() {
				teLoadingBox.statusAnimation = 'stop';
				//jQuery('.te-loader-gif').html("");
			},


			//init loading box
			init: function init(color, speed) {

				//console.log('test');
				var tdColorRegExp = /^#[a-zA-Z0-9]{3,6}$/;
				if (color && tdColorRegExp.test(color)) {

					var colRgba = teLoadingBox.hexToRgb(color);

					var rgbaString = "rgba(" + colRgba.r + ", " + colRgba.g + ", " + colRgba.b + ", ";

					teLoadingBox.arrayColors[7] = rgbaString + " 0.9)";
					teLoadingBox.arrayColors[6] = rgbaString + " 0.7)";
					teLoadingBox.arrayColors[5] = rgbaString + " 0.5)";
					teLoadingBox.arrayColors[4] = rgbaString + " 0.3)";
					teLoadingBox.arrayColors[3] = rgbaString + " 0.15)";
					teLoadingBox.arrayColors[2] = rgbaString + " 0.15)";
					teLoadingBox.arrayColors[1] = rgbaString + " 0.15)";
					teLoadingBox.arrayColors[0] = rgbaString + " 0.15)";

				} else {
					//default array
					teLoadingBox.arrayColors = teLoadingBox.arrayColorsTemp.slice(0);

				}

				if (teLoadingBox.statusAnimation === 'stop') {
					teLoadingBox.statusAnimation = 'display';
					this.render();
				}
			},


			//create the animation
			render: function render(color) {

				//call the animationDisplay function
				teLoadingBox.animationDisplay(
					'<div class="te-lb-box te-lb-box-1" style="background-color:' + teLoadingBox.arrayColors[0] + '"></div>' +
					'<div class="te-lb-box te-lb-box-2" style="background-color:' + teLoadingBox.arrayColors[1] + '"></div>' +
					'<div class="te-lb-box te-lb-box-3" style="background-color:' + teLoadingBox.arrayColors[2] + '"></div>' +
					'<div class="te-lb-box te-lb-box-4" style="background-color:' + teLoadingBox.arrayColors[3] + '"></div>' +
					'<div class="te-lb-box te-lb-box-5" style="background-color:' + teLoadingBox.arrayColors[4] + '"></div>' +
					'<div class="te-lb-box te-lb-box-6" style="background-color:' + teLoadingBox.arrayColors[5] + '"></div>' +
					'<div class="te-lb-box te-lb-box-7" style="background-color:' + teLoadingBox.arrayColors[6] + '"></div>' +
					'<div class="te-lb-box te-lb-box-8" style="background-color:' + teLoadingBox.arrayColors[7] + '"></div>'
				);

				//direction right
				var tempColorArray = [
					teLoadingBox.arrayColors[0],
					teLoadingBox.arrayColors[1],
					teLoadingBox.arrayColors[2],
					teLoadingBox.arrayColors[3],
					teLoadingBox.arrayColors[4],
					teLoadingBox.arrayColors[5],
					teLoadingBox.arrayColors[6],
					teLoadingBox.arrayColors[7]
				];

				teLoadingBox.arrayColors[0] = tempColorArray[7];
				teLoadingBox.arrayColors[1] = tempColorArray[0];
				teLoadingBox.arrayColors[2] = tempColorArray[1];
				teLoadingBox.arrayColors[3] = tempColorArray[2];
				teLoadingBox.arrayColors[4] = tempColorArray[3];
				teLoadingBox.arrayColors[5] = tempColorArray[4];
				teLoadingBox.arrayColors[6] = tempColorArray[5];
				teLoadingBox.arrayColors[7] = tempColorArray[6];

				if (teLoadingBox.statusAnimation === 'display') {


					setTimeout(teLoadingBox.render, teLoadingBox.speed);
				} else {
					teLoadingBox.animationDisplay('');
				}
			},


			//display the animation
			animationDisplay: function (animation_str) {
				jQuery('.te-loader-gif').html(animation_str);
			},


			//converts hex to rgba
			hexToRgb: function (hex) {
				var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);

				return result ? {
						r: parseInt(result[1], 16),
						g: parseInt(result[2], 16),
						b: parseInt(result[3], 16)
					} : null;
			}
		}; //teLoadingBox.init();//teLoadingBox.stop();
	})();
	var eggnews_mega = {
		change_category: function ($node) {
			$('.te-loader-gif').remove();
			var category_id = $node.attr('data-cat-id');
			var mega_row_for_category = $('.te-mega-row[data-mega-id="' + category_id + '"]');
			if (mega_row_for_category.length > 0) {
				$('.te-mega-row').removeClass('active');
				mega_row_for_category.addClass('active');
				$node.removeClass('processing');
			} else {
				var loading = '<div class="te-loader-gif"></div>';
				$('.te_block_inner').find('.te-loader-gif').remove();
				$('.te_block_inner').append(loading);
				teLoadingBox.init(eggnews_mega_menu.primary_color, 1000);
				var data = {
					'action': 'eggnews_mega_hover',
					'security': eggnews_mega_menu.post_nonce,
					'category_id': category_id
				}
				$.ajax({
					url: eggnews_mega_menu.ajax_url,
					type: 'POST',
					data: data,
					error: function () {
						$node.removeClass('processing');
						teLoadingBox.stop();
						$('.te-loader-gif').remove();
					},
					dataType: 'json',
					success: function (data) {
						$node.removeClass('processing');
						teLoadingBox.stop();
						$('.te-loader-gif').remove();

						if (typeof data.success !== 'undefined' && data.success) {
							var inner_html = data.data.inner_html;
							$('.te_block_inner').find('.te-mega-row').removeClass('active');
							$('.te_block_inner').append(inner_html);

						}

					}
				});
			}
		}
	};
	$('body').on('hover', '.te_mega_menu_sub_cats .mega-menu-sub-cat', function () {
		$('.te_mega_menu_sub_cats .mega-menu-sub-cat').removeClass('active');
		$(this).addClass('active');
		if (!$('.te_mega_menu_sub_cats .mega-menu-sub-cat').hasClass('processing')) {
			$(this).addClass('processing');
			eggnews_mega.change_category($(this));
		}
	});

});

