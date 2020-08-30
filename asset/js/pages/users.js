$(document).ready(function () {
	$("#idtoko, #username").select2({
		theme: "bootstrap4",
	});

	var message = $("#pesan"),
		type = $("#typePesan");

	if (message.html() != "") {
		Swal.fire({
			title: message.html(),
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
			type: type.html(),
		});
	}
});

function checkPassword() {
	var oldPassword = $("#password_lama").val();
	var newPassword = $("#password_baru").val();

	if (oldPassword == newPassword) {
		Swal.fire({
			toast: true,
			title: "Password baru tidak boleh sama dengan password lama.",
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
			type: "error",
		});
	} else {
		$("#user-form").submit();
	}
}

function checkNewPassword() {
	var oldPassword = $("#password").val();
	var newPassword = $("#konf_password").val();

	if (oldPassword != newPassword) {
		Swal.fire({
			toast: true,
			title: "Konfirmasi password tidak sesuai.",
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
			type: "error",
		});
	} else {
		$("#create-user").submit();
	}
}

function deleteConfirmation(url) {
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		type: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.value) {
			window.location = url;
		}
	});
}
