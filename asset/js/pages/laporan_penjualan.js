$(document).ready(function () {
	newDatatable = $("#newDatatable").DataTable({
		processing: true,
		serverSide: true,
		paging: true,
		ajax: {
			url: globalBaseUrl + "api/reports/penjualan",
			dataSrc: "data",
			type: "POST",
		},
		oLanguage: {
			sProcessing:
				"<div class='spinner-border spinner-border-sm text-primary' role='status'><span class='sr-only'></span></div>",
		},
		columnDefs: [
			{
				searchable: false,
				orderable: false,
				targets: 0,
			},
		],
		order: [[0, "desc"]],
		columns: [
			{
				name: "struk",
				data: "struk",
			},
			{
				name: "member",
				data: "member",
			},
			{
				name: "total_belanja",
				data: "total_belanja",
				render: $.fn.dataTable.render.number(",", ".", 2, "Rp. "),
			},
			{ name: "nama", data: "nama" },
			{ name: "tanggal_transaksi", data: "tanggal_transaksi" },
			{
				data: null,
				render: function (row, data, type) {
					var clicky =
						"getDetail(`" +
						globalBaseUrl +
						"laporan/api_penjualan_detail/" +
						row.id +
						"`)";
					return `<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' onclick='${clicky}' data-target='#exampleModal'><i class='fas fa-eye'></i></button>`;
				},
			},
		],
	});
});

function getDetail(url) {
	$.ajax({
		url: url,
		type: "POST",
		dataType: "json",
		success: function (data) {
			console.log(data);
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