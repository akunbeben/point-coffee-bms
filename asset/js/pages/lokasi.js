async function fetchData(url) {
	const stores = [];

	let response = await fetch(url);
	let result = await response.json();

	for (var index in result.data) {
		stores.push([
			result.data[index].kodetoko + " - " + result.data[index].nama_toko,
			result.data[index].latitude,
			result.data[index].longitude,
		]);
	}

	return stores;
}

async function initialize() {
	var map = L.map("map-canvas").setView([-3.1388206, 114.6308699], 8);

	L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

	const markers = await fetchData(globalBaseUrl + "toko/list_ajax");

	for (var index in markers) {
		L.marker([markers[index][1], markers[index][2]])
			.addTo(map)
			.bindPopup(markers[index][0]);
	}
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

onAlreadyLoaded(function () {
	initialize();
});
