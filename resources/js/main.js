$(document).ready(function () {
	if ($(window).width() > 1200) {

		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
			$('#sidebarCollapse2').removeClass('d-xl-none').addClass('d-xl-block').addClass('active');
			$(this).removeClass('active');
		});
		$('#sidebarCollapse2').on('click', function () {
			$('#sidebar').toggleClass('active');
			$('#sidebarCollapse2').removeClass('d-xl-block').addClass('d-xl-none');
			$(this).removeClass('active');
		});
	} else {
		$('#sidebarCollapse2').addClass('active');
		$('#sidebarCollapse2').on('click', function () {
			$('#sidebar').toggleClass('active');
			$('#sidebarCollapse2').removeClass('d-block').addClass('d-none');
			$('#sidebarCollapse').addClass('active');
			// $(this).removeClass('active');
		});
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
			$('#sidebarCollapse2').removeClass('d-none').addClass('d-block').addClass('active');
			$(this).removeClass('active');
		});
	}
});

(function ($) {
	'use strict';
	$('#dataTable').DataTable();
	$.extend(true, DataTable.defaults, {
		dom:
			"<'row'<'col-12 col-md-6'l><'col-12 col-md-6'f>>" +
			"<'row'<'col-12'tr>>" +
			"<'row'<'col-12 col-md-5'i><'col-12 col-md-7'p>>",
		renderer: 'bootstrap'
	});


})(jQuery);


// var togglePassword = document.querySelector('#togglePassword');
// var password = document.querySelector('#password');
// togglePassword.addEventListener('click', function (e) {
// 	// toggle the type attribute
// 	var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
// 	password.setAttribute('type', type);
// 	// toggle the eye slash icon
// 	this.classList.toggle('fa-eye-slash');
// });