drawChart();

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

function roundup(number) {
	return Math.ceil(number / 500000) * 500000;
}

async function drawChart() {
	const dataChartSet = await getData(
		"http://localhost/pos/laporan/pendapatan_perbulan_ajax"
	);

	const ctx = document.getElementById("chartPendapatan").getContext("2d");
	const myChart = new Chart(ctx, {
		type: "bar",
		data: {
			labels: dataChartSet.xAxisLabel,
			datasets: [
				{
					label: "Pendapatan toko periode bulan: " + dataChartSet.period,
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
							max: roundup(Math.max(...dataChartSet.yAxisLabel)),
							callback: function (value) {
								return formatCurrency(value);
							},
						},
					},
				],
			},
			tooltips: {
				callbacks: {
					label: function (tooltipItem) {
						return "Pendapatan: " + formatCurrency(tooltipItem.value);
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
