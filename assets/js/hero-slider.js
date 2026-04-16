/**
 * Hero Slider (Homepage)
 *
 * @package JubariTheme
 */

(function () {
	'use strict';

	const heroSlider = document.querySelector('.jt-hero__slider');

	if (!heroSlider || typeof Swiper === 'undefined') {
		return;
	}

	const heroSection = heroSlider.closest('.jt-hero');
	const nextButton = heroSection ? heroSection.querySelector('.swiper-button-next') : null;
	const prevButton = heroSection ? heroSection.querySelector('.swiper-button-prev') : null;
	const pagination = heroSection ? heroSection.querySelector('.jt-hero__pagination') : null;

	const isRTL =
		document.documentElement.dir === 'rtl' ||
		document.body.classList.contains('rtl') ||
		document.body.classList.contains('is-rtl');

	new Swiper(heroSlider, {
		direction: 'horizontal',
		loop: true,
		speed: 800,
		rtl: isRTL,
		autoplay: {
			delay: 6000,
			disableOnInteraction: false,
			pauseOnMouseEnter: true,
		},
		effect: 'fade',
		fadeEffect: {
			crossFade: true,
		},
		parallax: true,
		pagination: pagination
			? {
					el: pagination,
					clickable: true,
					renderBullet: function (index, className) {
						return '<span class="' + className + '"><span class="swiper-pagination-bullet-progress"></span></span>';
					},
				}
			: false,
		navigation:
			nextButton && prevButton
				? {
						nextEl: nextButton,
						prevEl: prevButton,
					}
				: false,
		keyboard: {
			enabled: true,
		},
		a11y: {
			prevSlideMessage: isRTL ? 'الشريحة السابقة' : 'Previous slide',
			nextSlideMessage: isRTL ? 'الشريحة التالية' : 'Next slide',
			firstSlideMessage: isRTL ? 'هذه هي الشريحة الأولى' : 'This is the first slide',
			lastSlideMessage: isRTL ? 'هذه هي الشريحة الأخيرة' : 'This is the last slide',
		},
	});
})();