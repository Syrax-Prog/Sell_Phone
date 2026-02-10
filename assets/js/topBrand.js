// assets/js/topProductChart.js
document.addEventListener("DOMContentLoaded", function () {
	const labels = JSON.parse(document.getElementById("topBrand").dataset.labels);
	const data = JSON.parse(document.getElementById("topBrand").dataset.data);
	const ctx = document.getElementById("topBrand").getContext("2d");

	// Different colors for each bar
	const colors = [
		"rgba(99, 102, 241, 0.9)", // Indigo
		"rgba(236, 72, 153, 0.9)", // Pink
		"rgba(34, 197, 94, 0.9)" // Green
	];

	new Chart(ctx, {
		type: "bar",
		data: {
			labels: labels,
			datasets: [{
				label: "Total Brand",
				data: data,
				backgroundColor: colors,
				borderColor: "Black",
				borderWidth: 2,
				borderRadius: 8,
				borderSkipped: false,
			}],
		},
		options: {
			responsive: true,
			maintainAspectRatio: true,
			plugins: {
				legend: {
					display: false,
				},
				tooltip: {
					backgroundColor: "rgba(17, 24, 39, 0.95)",
					titleColor: "#ffffff",
					bodyColor: "#e5e7eb",
					borderColor: "rgba(99, 102, 241, 0.5)",
					borderWidth: 1,
					padding: 12,
					displayColors: true,
					titleFont: {
						size: 13,
						weight: "600",
					},
					bodyFont: {
						size: 14,
						weight: "500",
					},
					callbacks: {
						label: function (context) {
							return "Sold: " + context.parsed.y.toLocaleString() + " Unit";
						},
					},
				},
			},
			scales: {
				x: {
					grid: {
						display: false,
					},
					ticks: {
						font: {
							size: 11,
							family: "'Inter', 'Segoe UI', sans-serif",
						},
						color: "#9ca3af",
					},
					border: {
						display: false,
					},
				},
				y: {
					beginAtZero: true,
					grid: {
						color: "rgba(229, 231, 235, 0.5)",
						drawBorder: false,
					},
					ticks: {
						font: {
							size: 11,
							family: "'Inter', 'Segoe UI', sans-serif",
						},
						color: "#9ca3af",
						padding: 8,
					},
					border: {
						display: false,
					},
				},
			},
		},
	});
});
