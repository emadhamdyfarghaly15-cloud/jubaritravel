/**
 * Jubari Theme — Main JavaScript
 *
 * @package JubariTheme
 */

(function () {
	'use strict';

	const header = document.getElementById('site-header');
	const body = document.body;
	let lastScroll = 0;

	// Sticky Header.
	if (header) {
		const stickyThreshold = 100;

		window.addEventListener(
			'scroll',
			() => {
				const currentScroll = window.pageYOffset || window.scrollY || 0;

				if (currentScroll > stickyThreshold) {
					header.classList.add('is-sticky');

					if (currentScroll > lastScroll && currentScroll > 300) {
						header.classList.add('is-hidden');
					} else {
						header.classList.remove('is-hidden');
					}
				} else {
					header.classList.remove('is-sticky', 'is-hidden');
				}

				lastScroll = currentScroll;
			},
			{ passive: true }
		);
	}

	// Back to Top.
	const backToTop = document.getElementById('back-to-top');

	if (backToTop) {
		window.addEventListener(
			'scroll',
			() => {
				if (window.pageYOffset > 500) {
					backToTop.classList.add('is-visible');
				} else {
					backToTop.classList.remove('is-visible');
				}
			},
			{ passive: true }
		);

		backToTop.addEventListener('click', () => {
			window.scrollTo({
				top: 0,
				behavior: 'smooth',
			});
		});
	}

	// Testimonials Carousel.
	const testimonialSlider = document.querySelector('.jt-testimonials__slider');

	if (testimonialSlider && typeof Swiper !== 'undefined') {
		const testimonialSection = testimonialSlider.closest('.jt-testimonials');
		const testimonialPagination = testimonialSection
			? testimonialSection.querySelector('.jt-testimonials__pagination')
			: null;

		new Swiper(testimonialSlider, {
			direction: 'horizontal',
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
				pauseOnMouseEnter: true,
			},
			pagination: testimonialPagination
				? {
						el: testimonialPagination,
						clickable: true,
					}
				: false,
			slidesPerView: 1,
			spaceBetween: 30,
			breakpoints: {
				768: {
					slidesPerView: 2,
				},
				1024: {
					slidesPerView: 3,
				},
			},
		});
	}

	// Animated Counters.
	const counters = document.querySelectorAll('[data-counter]');

	if (counters.length > 0 && 'IntersectionObserver' in window) {
		const animateCounter = (el) => {
			const target = parseInt(el.getAttribute('data-counter'), 10);

			if (Number.isNaN(target) || target < 0) {
				el.textContent = '0';
				return;
			}

			const duration = 2000;
			const step = target / (duration / 16);
			let current = 0;

			const timer = window.setInterval(() => {
				current += step;

				if (current >= target) {
					el.textContent = target.toLocaleString('ar-EG');
					window.clearInterval(timer);
				} else {
					el.textContent = Math.floor(current).toLocaleString('ar-EG');
				}
			}, 16);
		};

		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						animateCounter(entry.target);
						observer.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.5 }
		);

		counters.forEach((counter) => observer.observe(counter));
	} else if (counters.length > 0) {
		counters.forEach((counter) => {
			const target = parseInt(counter.getAttribute('data-counter'), 10);
			counter.textContent = Number.isNaN(target) ? '0' : target.toLocaleString('ar-EG');
		});
	}

	// Smooth scroll for anchor links.
	document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
		anchor.addEventListener('click', function (event) {
			const targetId = this.getAttribute('href');

			if (!targetId || targetId === '#') {
				return;
			}

			let target = null;

			try {
				target = document.querySelector(targetId);
			} catch (error) {
				target = null;
			}

			if (target) {
				event.preventDefault();

				const headerHeight = header ? header.offsetHeight : 0;
				const targetPosition =
					target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

				window.scrollTo({
					top: targetPosition,
					behavior: 'smooth',
				});
			}
		});
	});

	// Native lazy-loading fallback support.
	if ('loading' in HTMLImageElement.prototype) {
		document.querySelectorAll('img[loading="lazy"]').forEach((img) => {
			if (img.dataset.src && !img.src) {
				img.src = img.dataset.src;
			}
		});
	}

	// Optional helper class.
	if (body) {
		body.classList.add('js-enabled');
	}
})();