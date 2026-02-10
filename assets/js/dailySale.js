document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("dailySalesChart");
    if (!ctx) return;

    const labels = JSON.parse(ctx.getAttribute("data-labels")); // e.g., ["2025-11-01","2025-11-02"]
    const dataPoints = JSON.parse(ctx.getAttribute("data-data")); // e.g., [1200, 1500]

    new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Daily Sales (RM)",
                data: dataPoints,
                borderColor: "blue",
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
