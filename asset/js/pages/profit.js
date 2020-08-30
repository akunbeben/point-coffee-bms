onAlreadyLoaded(function () {
	drawProfitChart();

	(Chart.defaults.global.defaultFontFamily = "Nunito"),
		'-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = "#858796";
});

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

async function drawProfitChart() {
	const dataset = await generateDataProfit(
		globalBaseUrl + "laporan/profit-perbulan"
	);

	const ctx = document.getElementById("chartProfit").getContext("2d");
	const myChart = new Chart(ctx, {
		type: "bar",
		data: {
			labels: dataset.horizontalLabel,
			datasets: [
				{
					label: "Profit bulan: " + dataset.periode,
					data: dataset.verticalLabel,
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
								return value;
							},
						},
					},
				],
				yAxes: [
					{
						ticks: {
							beginAtZero: true,
							maxTicksLimit: 5,
							max: Math.max(...dataset.verticalLabel),
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
						return formatCurrency(tooltipItem.value);
					},
				},
			},
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

async function generateDataProfit(url) {
	const verticalLabel = [];
	const horizontalLabel = [];
	var periode;

	let response = await fetch(url);
	let result = await response.json();

	for (let index in result.data) {
		verticalLabel.push(result.data[index].profit);
		horizontalLabel.push(result.data[index].toko);
	}

	if (result.data != (null || "")) {
		periode = result.data[0].periode;
	}

	return { verticalLabel, horizontalLabel, periode };
}
