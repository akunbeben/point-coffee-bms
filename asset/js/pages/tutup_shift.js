function submitConfirmation() {
	Swal.fire({
		title: "Tutup Shift",
		text: "Apakah anda ingin menutup shift?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes!",
	}).then((result) => {
		if (result.value) {
			$("#form-tutup-shift").submit();
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
