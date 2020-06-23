var newDatatable;

$(document).ready(function () {
	$("#supplier").select2({
		theme: "bootstrap4",
	});

	$("#btnDetailClose").on("click", function () {
		newDatatable.destroy();
		newDatatable = null;
	});
});

function editRetur(url) {
	window.location.href = url;
}

function initNewDatatable(url) {
	var rfid = url.split("/").pop();
	$("#detailItemModalLabel").html(
		"<i class='fas fa-paste'></i> Data : " + rfid
	);
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
			{ name: "jumlah", data: "jumlah" },
		],
	});
}
