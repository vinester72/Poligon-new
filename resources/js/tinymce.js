// import "tinymce/composer.json";
// import "tinymce/tinymce.js";
import "tinymce/tinymce.min.js";
// import "tinymce/jquery.tinymce.js";
// import "tinymce/jquery.tinymce.min.js";
// import "tinymce/icons/default/icons.min.js";
// import "tinymce/icons/default/index.js";
$(document).ready(function () {
	tinymce.init({
		selector: '.tiny',
	});
});
