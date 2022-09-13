(function ($) {
	"use strict";

	/*----- ELEMENTOR LOAD FUNTION CALL ---*/
	$(window).on("elementor/frontend/init", function () {
		var hero = function () {
			$("[data-background").each(function () {
				$(this).css(
					"background-image",
					"url( " + $(this).attr("data-background") + "  )"
				);
			});
			$("[data-bg-color]").each(function () {
				$(this).css("background-color", $(this).attr("data-bg-color"));
			});
		};

		var popularMenu = function () {
			$(".category_active").owlCarousel({
				loop: true,
				autoplay: true,
				smartSpeed: 700,
				autoplayHoverPause: true,
				margin: 0,
				autoplayTimeout: 4000,
				nav: true,
                rtl: true,
				navText: [
					'<i class="fal fa-long-arrow-left"></i>',
					'<i class="fal fa-long-arrow-right"></i>',
				],
				dots: false,
				responsive: {
					0: {
						items: 1,
					},
					768: {
						items: 2,
					},
					992: {
						items: 2,
					},
					1000: {
						items: 3,
					},
					1200: {
						items: 4,
					},
				},
			});
		};

		// testimonial
		var testimonial = function () {
			$(".testimonial_active").owlCarousel({
				loop: true,
				margin: 30,
				items: 1,
				center: true,
				autoplay: true,
				smartSpeed: 1000,
				stagePadding: 150,
				responsiveClass: true,
				nav: false,
				dots: false,
                rtl: true,
				responsive: {
					0: {
						items: 1,
						stagePadding: 0,
					},
					575: {
						items: 1,
						stagePadding: 100,
					},
					768: {
						items: 1,
						stagePadding: 10,
					},
					992: {
						items: 1,
						stagePadding: 50,
					},
					1250: {
						items: 1,
						stagePadding: 150,
					},
				},
			});

			// testimonial active 2
			$(".testimonial_active-2").owlCarousel({
				loop: true,
				autoplay: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				margin: 30,
				autoplayTimeout: 6000,
				nav: true,
                rtl: true,
				navText: [
					'<i class="fal fa-long-arrow-left"></i>',
					'<i class="fal fa-long-arrow-right"></i>',
				],
				dots: false,
				responsive: {
					0: {
						items: 1,
					},
					768: {
						items: 1,
					},
					992: {
						items: 1,
					},
					1000: {
						items: 1,
					},
				},
			});

			$('.testimonial_active-3').owlCarousel({
				loop: true,
				autoplay: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				margin: 30,
				autoplayTimeout: 6000,
				nav: false,
				dots: true,
                rtl: true,
				responsive: {
					0: {
						items: 1
					},
					768: {
						items: 1
					},
					992: {
						items: 1
					},
					1000: {
						items: 1
					}
				}
			});
		};

		//heroslider
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/elh_main_hero.default",
			function ($scope, $) {
				hero();
			}
		);

		elementorFrontend.hooks.addAction(
			"frontend/element_ready/elh_cta.default",
			function ($scope, $) {
				hero();
			}
		);

		// popular menu
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/elh_popular_menu.default",
			function ($scope, $) {
				popularMenu();
			}
		);

		// popular menu
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/elh_testimonial_slider.default",
			function ($scope, $) {
				testimonial();
			}
		);
	});

	/*----- ELEMENTOR LOAD FUNTION CALL ---*/

	$(window).on("elementor/frontend/init", function () {
		var hero = function () {
			$("[data-background").each(function () {
				$(this).css(
					"background-image",
					"url( " + $(this).attr("data-background") + "  )"
				);
			});
			$("[data-bg-color]").each(function () {
				$(this).css("background-color", $(this).attr("data-bg-color"));
			});
		};

		var popularMenu = function () {
			$(".category_active").owlCarousel({
				loop: true,
				autoplay: true,
				smartSpeed: 700,
				autoplayHoverPause: true,
				margin: 0,
				autoplayTimeout: 4000,
				nav: true,
                rtl: true,
				navText: [
					'<i class="fal fa-long-arrow-left"></i>',
					'<i class="fal fa-long-arrow-right"></i>',
				],
				dots: false,
				responsive: {
					0: {
						items: 1,
					},
					768: {
						items: 2,
					},
					992: {
						items: 2,
					},
					1000: {
						items: 3,
					},
					1200: {
						items: 4,
					},
				},
			});
		};

		var testimonial = function () {
			$(".testimonial_active").owlCarousel({
				loop: true,
				margin: 30,
				items: 1,
				center: true,
				autoplay: true,
				smartSpeed: 1000,
				stagePadding: 150,
				responsiveClass: true,
				nav: false,
				dots: false,
                rtl: true,
				responsive: {
					0: {
						items: 1,
						stagePadding: 0,
					},
					575: {
						items: 1,
						stagePadding: 100,
					},
					768: {
						items: 1,
						stagePadding: 10,
					},
					992: {
						items: 1,
						stagePadding: 50,
					},
					1250: {
						items: 1,
						stagePadding: 150,
					},
				},
			});

			// testimonial active 2
			$('.testimonial_active-2').owlCarousel({
				loop: true,
				autoplay: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				margin: 30,
				autoplayTimeout: 6000,
				nav: true,
				navText:['<i class="fal fa-long-arrow-left"></i>','<i class="fal fa-long-arrow-right"></i>'],
				dots: false,
                rtl: true,
				responsive: {
					0: {
						items: 1
					},
					768: {
						items: 1
					},
					992: {
						items: 1
					},
					1000: {
						items: 1
					}
				}
			});

			$('.testimonial_active-3').owlCarousel({
				loop: true,
				autoplay: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				margin: 30,
				autoplayTimeout: 6000,
				nav: false,
				dots: true,
                rtl: true,
				responsive: {
					0: {
						items: 1
					},
					768: {
						items: 1
					},
					992: {
						items: 1
					},
					1000: {
						items: 1
					}
				}
			});
		};

		//hero
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/hero.default",
			function ($scope, $) {
				hero();
			}
		);

		elementorFrontend.hooks.addAction(
			"frontend/element_ready/cta.default",
			function ($scope, $) {
				hero();
			}
		);

		//popular menu
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/popular_menu.default",
			function ($scope, $) {
				popularMenu();
			}
		);

		//testimonial
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/testimonial_slider.default",
			function ($scope, $) {
				testimonial();
			}
		);
	});
})(jQuery);
