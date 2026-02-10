document.addEventListener("DOMContentLoaded", function () {
	const labels = JSON.parse(
		document.getElementById("summaryChart").dataset.labels
	);
	const data = JSON.parse(document.getElementById("summaryChart").dataset.data);
	const ctx = document.getElementById("summaryChart").getContext("2d");

	new Chart(ctx, {
		type: "doughnut",
		data: {
			labels: labels,
			datasets: Array({
				label: "Orders Percentage (%)",
				data: data,
				backgroundColor: Array(
					"#FFC107", // Order Placed - yellow
					"#17A2B8", // Shipped - blue
					"#28A745" // Completed - green
				),
				borderColor: "Black",
				borderWidth: 0,
			}),
		},
		options: {
			responsive: true,
			maintainAspectRatio: true,
			aspectRatio: 1.81,
			plugins: {
				legend: {
					position: "top",
				},
			},
		},
	});
});
