$(document).ready(function () {
	$("#productcode").select2({
		theme: "bootstrap4",
	});

	$("#jumlah").mask("00000", { reverse: true });
});
