/**
 * Mobile Navigation
 *
 * @package JubariTheme
 */

(function () {
	'use strict';

	const menuToggle = document.getElementById('menu-toggle');
	const mobileMenu = document.getElementById('mobile-menu');
	const closeButtons = document.querySelectorAll('[data-close-menu]');
	const body = document.body;

	if (!menuToggle || !mobileMenu) {
		return;
	}

	const openMenu = () => {
		mobileMenu.hidden = false;
		mobileMenu.setAttribute('aria-hidden', 'false');
		menuToggle.setAttribute('aria-expanded', 'true');
		body.classList.add('menu-open');
		mobileMenu.classList.add('is-open');

		const focusableElements = mobileMenu.querySelectorAll(
			'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
		);

		if (focusableElements.length > 0) {
			focusableElements[0].focus();
		}
	};

	const closeMenu = () => {
		mobileMenu.setAttribute('aria-hidden', 'true');
		menuToggle.setAttribute('aria-expanded', 'false');
		body.classList.remove('menu-open');
		mobileMenu.classList.remove('is-open');
		mobileMenu.hidden = true;
		menuToggle.focus();
	};

	menuToggle.addEventListener('click', () => {
		const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';

		if (isOpen) {
			closeMenu();
		} else {
			openMenu();
		}
	});

	closeButtons.forEach((btn) => {
		btn.addEventListener('click', closeMenu);
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && mobileMenu.classList.contains('is-open')) {
			closeMenu();
		}
	});

	const subMenuParents = mobileMenu.querySelectorAll('.menu-item-has-children');

	subMenuParents.forEach((menuItem) => {
		const link = menuItem.querySelector(':scope > a');
		const subMenu = menuItem.querySelector(':scope > .sub-menu');

		if (!link || !subMenu) {
			return;
		}

		const toggleBtn = document.createElement('button');
		toggleBtn.className = 'jt-mobile-menu__submenu-toggle';
		toggleBtn.type = 'button';
		toggleBtn.setAttribute('aria-expanded', 'false');
		toggleBtn.setAttribute('aria-label', 'Toggle submenu');
		toggleBtn.innerHTML = '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><polyline points="6 9 12 15 18 9"></polyline></svg>';

		link.insertAdjacentElement('afterend', toggleBtn);

		subMenu.hidden = true;

		toggleBtn.addEventListener('click', () => {
			const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';

			toggleBtn.setAttribute('aria-expanded', String(!isExpanded));
			subMenu.classList.toggle('is-open', !isExpanded);
			subMenu.hidden = isExpanded;
		});
	});
})();