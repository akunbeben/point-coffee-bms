$(document).ready(function () {
	var suratJalan = $("#surat_jalan");
	var tombolSubmit = $("#btnSubmit");

	$("#cardProses").hide();

	if (suratJalan.val() != "") {
		$("#cardProses").show();
		suratJalan.attr("readonly", true);
		tombolSubmit.attr("disabled", true);
	} else {
		tombolSubmit.attr("disabled", false);
	}

	$("#productcode").select2({
		theme: "bootstrap4",
	});
});

function selesaiProses(url) {
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

function showData(url) {
	var data = $("form").serialize();
	var suratJalan = $("#surat_jalan");
	var tombolSubmit = $("#btnSubmit");

	$.ajax({
		url: url,
		data: data,
		type: "POST",
		dataType: "json",
		success: function (data) {
			window.location.reload();
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
