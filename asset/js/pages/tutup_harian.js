function submitConfirmation() {
	Swal.fire({
		title: "Tutup Harian",
		text: "Apakah anda ingin melakukan tutup harian?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes!",
	}).then((result) => {
		if (result.value) {
			$("#form-tutup-harian").submit();
		}
	});
}

function toogleForm() {
	const elementForm = document.getElementById("formTutupShift");
	const elementOpenForm = document.getElementById("openForm");

	if (elementForm.style.display === "none") {
		elementForm.style.display = "block";
		elementOpenForm.setAttribute("disabled", true);
	}
}
