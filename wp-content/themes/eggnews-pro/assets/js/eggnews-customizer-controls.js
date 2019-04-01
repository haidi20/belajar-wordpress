$(document).ready(function () {
	'use strict';

   //js for home icon select / toggle

	$('body').on('click', '.eggnews-icon-list li', function () {
         var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.eggnews-icon-list').prev('.eggnews-selected-icon').children('i').attr('class', '').addClass(icon_class);
        $(this).parent('.eggnews-icon-list').next('input').val(icon_class).change();
    
    });
    $('body').on('click', '.eggnews-selected-icon', function () {
        $(this).next().slideToggle();
    });
});
