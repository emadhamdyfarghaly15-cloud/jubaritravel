/**
 * Itinerary Accordion
 *
 * @package JubariTheme
 */

(function () {
	'use strict';

	const itinerary = document.querySelector('.jt-itinerary');

	if (!itinerary) {
		return;
	}

	const dayHeaders = itinerary.querySelectorAll('.jt-itinerary__day-header');

	if (!dayHeaders.length) {
		return;
	}

	dayHeaders.forEach((header) => {
		header.addEventListener('click', () => {
			const day = header.closest('.jt-itinerary__day');

			if (!day) {
				return;
			}

			const content = day.querySelector('.jt-itinerary__day-content');

			if (!content) {
				return;
			}

			const isOpen = day.classList.contains('is-open');

			itinerary.querySelectorAll('.jt-itinerary__day').forEach((item) => {
				const itemHeader = item.querySelector('.jt-itinerary__day-header');
				const itemContent = item.querySelector('.jt-itinerary__day-content');

				item.classList.remove('is-open');

				if (itemHeader) {
					itemHeader.setAttribute('aria-expanded', 'false');
				}

				if (itemContent) {
					itemContent.hidden = true;
				}
			});

			if (!isOpen) {
				day.classList.add('is-open');
				header.setAttribute('aria-expanded', 'true');
				content.hidden = false;

				window.setTimeout(() => {
					const siteHeader = document.getElementById('site-header');
					const headerOffset = siteHeader ? siteHeader.offsetHeight : 0;
					const elementPosition = day.getBoundingClientRect().top + window.pageYOffset;

					window.scrollTo({
						top: elementPosition - headerOffset - 20,
						behavior: 'smooth',
					});
				}, 100);
			}
		});

		header.addEventListener('keydown', (event) => {
			if (event.key === 'Enter' || event.key === ' ') {
				event.preventDefault();
				header.click();
			}
		});
	});
})();