onAlreadyLoaded(function () {
	drawCustomerChart();
	drawChartPendapatan();
	drawChart();

	(Chart.defaults.global.defaultFontFamily = "Nunito"),
		'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = "#858796";
});

function roundup(number) {
	return Math.ceil(number / 500000) * 500000;
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

async function drawChartPendapatan() {
	const dataSetsPendapatan = await getDataPendapatan(
		"http://localhost/pos/laporan/pendapatan_perbulan_ajax"
	);

	const ctxPendapatan = document
		.getElementById("chartPendapatan")
		.getContext("2d");
	const chartPendapatan = new Chart(ctxPendapatan, {
		type: "bar",
		data: {
			labels: dataSetsPendapatan.xAxisLabel,
			datasets: [
				{
					label: "Pendapatan toko periode bulan: " + dataSetsPendapatan.period,
					data: dataSetsPendapatan.yAxisLabel,
					backgroundColor: "#2e59d9",
					borderColor: "#dddfeb",
					borderWidth: 2,
				},
			],
		},
		options: {
			scales: {
				xAxes: [
					{
						barThickness: 25,
						display: true,
						ticks: {
							callback: function (value, index, values) {
								const title = value.substr(0, value.indexOf(" "));
								return title;
							},
						},
					},
				],
				yAxes: [
					{
						ticks: {
							beginAtZero: true,
							maxTicksLimit: 5,
							max: roundup(Math.max(...dataSetsPendapatan.yAxisLabel)),
							callback: function (value) {
								return formatCurrency(value);
							},
						},
					},
				],
			},
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				titleMarginBottom: 10,
				titleFontColor: "#6e707e",
				titleFontSize: 14,
				borderColor: "#dddfeb",
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				intersect: false,
				mode: "index",
				caretPadding: 10,
				callbacks: {
					label: function (tooltipItem) {
						return "Pendapatan: " + formatCurrency(tooltipItem.value);
					},
				},
			},
		},
	});
}

async function getDataPendapatan(url) {
	const yAxisLabel = [];
	const xAxisLabel = [];
	var period;

	let response = await fetch(url);
	let result = await response.json();

	for (var index in result.data) {
		yAxisLabel.push(result.data[index].pendapatan);
		xAxisLabel.push(
			result.data[index].kodetoko + " - " + result.data[index].nama_toko
		);
	}

	if (result.data == null) {
		yAxisLabel, xAxisLabel, (period = null);

		console.log(result);

		return { yAxisLabel, xAxisLabel, period };
	}

	period = result.data[0].periode;

	return { yAxisLabel, xAxisLabel, period };
}

async function drawChart() {
	const dataChartSet = await getData(
		"http://localhost/pos/laporan/product_terlaris_ajax"
	);

	const ctx = document.getElementById("chartProductTerlaris").getContext("2d");
	const myChart = new Chart(ctx, {
		type: "bar",
		data: {
			labels: dataChartSet.xAxisLabel,
			datasets: [
				{
					label: "Product Terlaris - bulan: " + dataChartSet.period,
					data: dataChartSet.yAxisLabel,
					backgroundColor: "#2e59d9",
					borderColor: "#dddfeb",
					borderWidth: 2,
				},
			],
		},
		options: {
			scales: {
				xAxes: [
					{
						barThickness: 50,
						display: true,
						ticks: {
							callback: function (value, index, values) {
								var title = value.split(" - ");

								return title[1];
							},
						},
					},
				],
				yAxes: [
					{
						ticks: {
							beginAtZero: true,
							maxTicksLimit: 5,
							max: Math.max(...dataChartSet.yAxisLabel),
							callback: function (value) {
								return value;
							},
						},
					},
				],
			},
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				titleMarginBottom: 10,
				titleFontColor: "#6e707e",
				titleFontSize: 14,
				borderColor: "#dddfeb",
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				intersect: false,
				mode: "index",
				caretPadding: 10,
				callbacks: {
					label: function (tooltipItem) {
						return "Jumlah Terjual: " + tooltipItem.value;
					},
				},
			},
		},
	});
}

async function getData(url) {
	const yAxisLabel = [];
	const xAxisLabel = [];
	var period;

	let response = await fetch(url);
	let result = await response.json();

	for (var index in result.data) {
		yAxisLabel.push(result.data[index].jumlah_terjual);
		xAxisLabel.push(
			result.data[index].prdcd + " - " + result.data[index].singkatan
		);
	}

	if (result.data == null) {
		yAxisLabel, xAxisLabel, (period = null);

		return { yAxisLabel, xAxisLabel, period };
	}

	period = result.data[0].periode;

	return { yAxisLabel, xAxisLabel, period };
}

function onAlreadyLoaded(fn) {
	// see if DOM is already available
	if (
		document.readyState === "complete" ||
		document.readyState === "interactive"
	) {
		// call on next available tick
		setTimeout(fn, 1);
	} else {
		document.addEventListener("DOMContentLoaded", fn);
	}
}

function number_format(number, decimals, dec_point, thousands_sep) {
	// *     example: number_format(1234.56, 2, ',', ' ');
	// *     return: '1 234,56'
	number = (number + "").replace(",", "").replace(" ", "");
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
		dec = typeof dec_point === "undefined" ? "." : dec_point,
		s = "",
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return "" + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || "").length < prec) {
		s[1] = s[1] || "";
		s[1] += new Array(prec - s[1].length + 1).join("0");
	}
	return s.join(dec);
}

async function drawCustomerChart() {
	// Area Chart Example

	const dataSet = await getCustomerData(
		globalBaseUrl + "laporan/get_all_customers"
	);

	var ctx = document.getElementById("chartCustomer").getContext("2d");
	var myLineChart = new Chart(ctx, {
		type: "line",
		data: {
			labels: dataSet.xAxisLabel,
			datasets: [
				{
					label: "Periode : " + dataSet.period,
					lineTension: 0.3,
					backgroundColor: "rgba(78, 115, 223, 0.05)",
					borderColor: "rgba(78, 115, 223, 1)",
					pointRadius: 3,
					pointBackgroundColor: "rgba(78, 115, 223, 1)",
					pointBorderColor: "rgba(78, 115, 223, 1)",
					pointHoverRadius: 3,
					pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
					pointHoverBorderColor: "rgba(78, 115, 223, 1)",
					pointHitRadius: 10,
					pointBorderWidth: 2,
					data: dataSet.yAxisLabel,
				},
			],
		},
		options: {
			maintainAspectRatio: false,
			layout: {
				padding: {
					left: 10,
					right: 25,
					top: 25,
					bottom: 0,
				},
			},
			scales: {
				xAxes: [
					{
						barThickness: 50,
					},
				],
				yAxes: [
					{
						ticks: {
							beginAtZero: true,
							maxTicksLimit: 5,
							max: Math.max(...dataSet.yAxisLabel),
							callback: function (value) {
								return value;
							},
						},
					},
				],
			},
			legend: {
				display: false,
			},
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				titleMarginBottom: 10,
				titleFontColor: "#6e707e",
				titleFontSize: 14,
				borderColor: "#dddfeb",
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				intersect: false,
				mode: "index",
				caretPadding: 10,
				callbacks: {
					label: function (tooltipItem) {
						return "Total kunjungan: " + tooltipItem.value;
					},
				},
			},
		},
	});
}

async function getCustomerData(url) {
	const yAxisLabel = [];
	const xAxisLabel = [];
	var period;

	let response = await fetch(url);
	let result = await response.json();

	for (var index in result.data) {
		yAxisLabel.push(result.data[index].total_customer);
		xAxisLabel.push("Minggu ke-" + result.data[index].number_of_week);
	}

	if (result.data == null) {
		yAxisLabel, xAxisLabel, (period = null);

		return { yAxisLabel, xAxisLabel, period };
	}

	period = result.data[0].name_of_month;

	return { yAxisLabel, xAxisLabel, period };
}
