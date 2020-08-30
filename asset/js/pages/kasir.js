$(document).ready(function () {
	$("#customer, #product, #nontunai_bank").select2({
		theme: "bootstrap4",
	});

	$("#tunai").mask("000.000.000.000", { reverse: true });
	$("#nontunai").mask("000.000.000.000", { reverse: true });
	$("#quantity").mask("000", { reverse: true });

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

	if ($("#nontunai").val() != 0) {
		var nontunai = $("#nontunai");
		$("#kasir_total_bayar").val(nontunai.val().replace(/[.]/g, ""));
	} else {
		$("#kasir_total_bayar").val("0");
	}

	$("#kasir_kasir").val($("#kasir").val());
	$("#kasir_member").val($("#customer").val());
	$("#kasir_kembalian").val(
		$("#kasir_total_bayar").val() - $("#kasir_total_belanja").val()
	);

	$("#customer").on("change", function () {
		$("#kasir_member").val($("#customer").val());
	});

	$("#tunai").keyup(function () {
		$("#kasir_total_bayar").val($("#tunai").val().replace(/[.]/g, ""));
		$("#kasir_kembalian").val(
			$("#kasir_total_bayar").val() - $("#kasir_total_belanja").val()
		);
	});
});

function jumlahProduct(endpoints) {
	var countIndex = endpoints.search(/delete/i);

	if (countIndex > 0) {
		Swal.fire({
			text: "Anda yakin menghapus produk ini?",
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
	} else {
		window.location = endpoints;
	}
}

function NonTunai(url) {
	var data = {
		id: null,
		no_struk: $("#nontunai_struk").val(),
		no_kartu: $("#nontunai_kartu").val(),
		bank: $("#nontunai_bank").val(),
		approval: $("#nontunai_approval").val(),
		total: $("#nontunai_total").val(),
	};

	$.ajax({
		url: url,
		data: data,
		type: "POST",
		dataType: "json",
		beforeSend: function () {
			$("#submit-nontunai").attr("disabled", true);
		},
		success: function (data) {
			window.location = data.redirect;
		},
		error: function (error) {
			$("#submit-nontunai").attr("disabled", false);

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

function bayar() {
	var totalBayar = parseInt($("#kasir_total_bayar").val());
	var totalBelanja = parseInt($("#kasir_total_belanja").val());
	if (totalBayar < totalBelanja || totalBayar == 0) {
		Swal.fire({
			title: "Silahkan lakukan pembayaran terlebih dahulu.",
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
			type: "error",
		});
	} else {
		$("#form-bayar").submit();
	}
}
