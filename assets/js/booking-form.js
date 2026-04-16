document.addEventListener('DOMContentLoaded', function () {
	const form = document.querySelector('.jubari-booking-form');

	if (!form) {
		return;
	}

	form.addEventListener('submit', function (event) {
		const name = form.querySelector('#booking-name');
		const phone = form.querySelector('#booking-phone');

		if (!name || !phone) {
			return;
		}

		if (!name.value.trim() || !phone.value.trim()) {
			event.preventDefault();
			alert('يرجى إدخال الاسم ورقم الهاتف.');
		}
	});
});