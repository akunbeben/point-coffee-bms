$(document).ready(function () {
	$("#prdcd").select2({
		theme: "bootstrap4",
	});

	if (globalMessage != "") {
		Swal.fire({
			title: globalMessage,
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
			type: globalMessageType,
		});
	}

	var tombolInput = $("#btnSubmit");
	var productInput = $("#prdcd");
	var jumlahInput = $("#jumlah");

	jumlahInput.mask("00000", { reverse: true });

	if (productInput.val() == "" || jumlahInput.val() == "") {
		tombolInput.attr("disabled", true);
	} else {
		tombolInput.attr("disabled", false);
	}

	productInput.on("change", function () {
		if (productInput.val() == "" || jumlahInput.val() == "") {
			tombolInput.attr("disabled", true);
		} else {
			tombolInput.attr("disabled", false);
		}
	});

	jumlahInput.on("change", function () {
		if (jumlahInput.val() == "" || jumlahInput.val() == "") {
			tombolInput.attr("disabled", true);
		} else {
			tombolInput.attr("disabled", false);
		}
	});
});
