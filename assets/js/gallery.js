document.addEventListener('DOMContentLoaded', function () {
	const galleryLinks = document.querySelectorAll('[data-gallery]');

	if (!galleryLinks.length) {
		return;
	}

	galleryLinks.forEach(function (link) {
		link.addEventListener('click', function (event) {
			event.preventDefault();

			const imageUrl = link.getAttribute('href');

			if (!imageUrl) {
				return;
			}

			window.open(imageUrl, '_blank');
		});
	});
});