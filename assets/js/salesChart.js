document.addEventListener("DOMContentLoaded", function () {
	const salesData = window.salesData || Array();

	const labels = salesData.map((item) => item.date);
	const data = salesData.map((item) => parseFloat(item.total_sales));

	const ctx = document.getElementById("salesChart");
	if (!ctx) return; // Stop if no canvas found

	new Chart(ctx, {
		type: "line",
		data: {
			labels: labels,
			datasets: Array({
				label: "Sales (MYR)",
				data: data,
				borderColor: "#000000",
				backgroundColor: "rgba(255, 0, 0, 0.1)",
				fill: true,
				tension: 0.3,
				pointBackgroundColor: "#000000",
				pointBorderColor: "#000000",
			}),
		},
		options: {
			responsive: true,
			scales: {
				y: {
					beginAtZero: true,
				},
			},
		},
	});
});
