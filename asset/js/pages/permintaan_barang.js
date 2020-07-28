var newDatatable;

$(document).ready(function () {
	$("#btnClose").on("click", function () {
		newDatatable.destroy();
		newDatatable = null;
	});

	globalDatatable.order([1, "desc"]).draw();
});

function editData(url) {
	window.location.href = url;
}

function deleteData(url, rfid) {
	Swal.fire({
		title: "Data Permintaan",
		text: `Anda yakin menghapus ${rfid} ini?`,
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus!",
	}).then((result) => {
		if (result.value) {
			window.location.href = url;
		}
	});
}

function approve(url) {
	Swal.fire({
		title: "Confirmation",
		text: `Anda yakin untuk approve permintaan ini?`,
		type: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Approve",
	}).then((result) => {
		if (result.value) {
			window.location.href = url;
		}
	});
}

function reject(url) {
	Swal.fire({
		title: "Confirmation",
		text: `Anda yakin untuk reject permintaan ini?`,
		type: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Reject!",
	}).then((result) => {
		if (result.value) {
			window.location.href = url;
		}
	});
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

	$("#btnApprove").attr(
		"onclick",
		'approve("' + globalBaseUrl + "stock/proses/" + rfid + '")'
	);

	$("#btnReject").attr(
		"onclick",
		'reject("' + globalBaseUrl + "stock/reject/" + rfid + '")'
	);
}

$(document).ready(function () {
	if (globalMessage != "" || globalMessageType != "") {
		Swal.fire({
			title: globalMessage,
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 3000,
			type: globalMessageType,
		});
	}
});
