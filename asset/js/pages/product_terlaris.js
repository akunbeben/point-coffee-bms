onAlreadyLoaded(function () {
	drawChart();
});

function submitFilter() {
	document.getElementById("formFilter").submit();
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
