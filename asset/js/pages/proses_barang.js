$(document).ready(function () {
	$("#btnClose").on("click", function () {
		newDatatable.destroy();
		newDatatable = null;
	});
});

function initNewDatatable(url) {
	var rfid = url.split("/").pop();
	$("#detailpermintaanModalLabel").html("Kode Permintaan : " + rfid);
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

	$("#btnProses").attr(
		"onclick",
		'prosesData("' +
			globalBaseUrl +
			"inventory/proses-barang-masuk/" +
			rfid +
			'")'
	);
}

function prosesData(url) {
	window.location.href = url;
}

function showDetail() {
	const modalFooter = document.getElementById("modal-footer");

	modalFooter.style.display = "none";
}
