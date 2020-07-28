$(document).ready(function () {
	$("#btnClose").on("click", function () {
		newDatatable.destroy();
		newDatatable = null;
	});

	globalDatatable.order([2, "desc"]).draw();
});

function submitFilter() {
	document.getElementById("formFilter").submit();
}

function initNewDatatable(url) {
	var rfid = url.split("/").pop();
	$("#detailpermintaanModalLabel").html(
		"<i class='fas fa-paste'></i> Data : " + rfid
	);

	var status = null;

	newDatatable = $("#newDatatable").DataTable({
		processing: true,
		serverSide: true,
		paging: true,
		ajax: {
			url: url,
			dataSrc: "data",
			type: "POST",
		},
		columns: [
			{
				name: "prdcd",
				data: "prdcd",
				render: function (data, type, row) {
					return row.prdcd + " - " + row.nama_item;
				},
			},
			{
				name: "harga",
				data: "harga",
				render: $.fn.dataTable.render.number(",", ".", 2, "Rp. "),
			},
			{ name: "kategori", data: "kategori" },
			{ name: "satuan", data: "satuan" },
			{ name: "jumlah", data: "jumlah" },
		],
	});
}
