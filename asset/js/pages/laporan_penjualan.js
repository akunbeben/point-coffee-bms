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
			var tbody = $("#itemDetail tbody");
			var tfoot = $("#itemDetail tfoot");
			var header = data.data.header;
			var line = data.data.line;

			tbody.empty();
			tfoot.empty();

			$("#struk").html("No. Struk: " + header.struk);
			$("#kasir").html("Kasir: " + header.nama);
			$("#total").html("Kasir: " + header.total_belanja);
			$("#header").html(
				header.tanggal_transaksi +
					" | " +
					header.kodetoko +
					" | " +
					header.struk
			);
			var totalBelanja = `<tr>
														<th colspan="2" class="text-right"><strong>Total:</strong>
														</th>
														<th class="text-left">
															${formatCurrency(header.total_belanja)}
														</th>
													</tr>
													<tr>
														<th colspan="2" class="text-right"><strong>Tunai:</strong>
														</th>
														<th class="text-left">
															${formatCurrency(header.total_bayar)}
														</th>
													</tr>
													<tr>
														<th colspan="2" class="text-right"><strong>Kembali:</strong>
														</th>
														<th class="text-left">
															${formatCurrency(header.kembalian)}
														</th>
													</tr>`;

			line.forEach(function (resultRow) {
				var tableRow = `<tr>
													<td>
														${resultRow.singkatan}
													</td>
													<td class="text-center">
														${resultRow.quantity}
													</td>
													<td class="text-left">
														${formatCurrency(resultRow.harga)}
													</td>
												 </tr>`;
				tbody.append(tableRow);
			});
			tfoot.append(totalBelanja);
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

function formatCurrency(total) {
	var neg = false;
	if (total < 0) {
		neg = true;
		total = Math.abs(total);
	}
	return (
		(neg ? "-Rp. " : "Rp. ") +
		parseFloat(total, 10)
			.toFixed(2)
			.replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
			.toString()
	);
}

function export_div() {
	var pdf = new jsPDF("p", "pt", "a4");
	pdf.addHTML($("#div_id"), 15, 15, function () {
		pdf.save("div.pdf");
	});
}
