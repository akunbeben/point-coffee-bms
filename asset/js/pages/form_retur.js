$(document).ready(function () {
	$("#productcode").select2({
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
	var productInput = $("#productcode");
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

function hapusItem(url) {
	Swal.fire({
		title: "Retur Barang",
		text: `Anda yakin untuk menghapus item ini?`,
		type: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
	}).then((result) => {
		if (result.value) {
			window.location.href = url;
		}
	});
}

function prosesRetur(url) {
	Swal.fire({
		title: "Retur Barang",
		text: `Anda yakin untuk memproses data ini?`,
		type: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Proses",
	}).then((result) => {
		if (result.value) {
			window.location.href = url;
		}
	});
}
