$(document).ready(function () {
	$("#kodesupplier, #prdcd, #kategori, #satuan").select2({
		theme: "bootstrap4",
	});

	$("#harga").mask("000.000.000.000", { reverse: true });
	$("#jumlah").mask("00000", { reverse: true });

	$("#btnSave").attr("disabled", true);

	$("#formPermintaan input").change(function () {
		$("#formPermintaan")
			.find("input")
			.each(function (index, elem) {
				if ($(elem).val().length == 0) {
					$("#btnSave").attr("disabled", true);
				} else {
					$("#btnSave").attr("disabled", false);
				}
			});
	});
});

function getItem(url) {
	$.ajax({
		url: url,
		type: "POST",
		dataType: "json",
		success: function (data) {
			$("#idBaru").val(data.data.id);
			$("#productName").val(data.data.prdcd + " - " + data.data.nama_item);
			$("#kodepermintaanBaru").val(data.data.kodepermintaan);
			$("#hargaBaru").val(data.data.harga);
			$("#jumlahBaru").val(data.data.jumlah);
		},
		error: function (error) {
			Swal.fire({
				title: "Internal server error.",
				toast: true,
				position: "top-end",
				showConfirmButton: false,
				timer: 3000,
				type: "error",
			});
		},
	});
}

function prosesPermintaan(url) {
	Swal.fire({
		title: "Data Permintaan",
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

function submitForm() {
	var formData = $("#formPermintaan");
	formData.submit();
	$("#btnSave").attr("disabled", true);
}
