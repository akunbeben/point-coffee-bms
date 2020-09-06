$(document).ready(function () {
	$("#idtoko").select2({
		theme: "bootstrap4",
	});
});

function deleteConfirmation(endpoints) {
	Swal.fire({
		title: "Barista",
		text: "Anda yakin untuk menghapus barista ini?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus!",
	}).then((result) => {
		if (result.value) {
			window.location = endpoints;
		}
	});
}
