document.addEventListener("DOMContentLoaded", function () {
	const stockFilter = document.getElementById("stockFilter");
	const tableBody = document.getElementById("productsTableBody");

	// Run this function when the user selects a stock filter
	stockFilter.addEventListener("change", function () {
		const filterValue = stockFilter.value.trim().toLowerCase();
		const rows = tableBody.getElementsByTagName("tr");

		Array.from(rows).forEach(function (row) {
			// get the stock text from the "Stock" column
			const stockCell = row.cells[5]; // 6th column = stock
			const stockText = stockCell.textContent.trim().toLowerCase();

			let match = false;

			// if no filter selected, show all
			if (filterValue === "") {
				match = true;
			}
			// compare selected value with stock text
			else if (filterValue === "instock" && stockText.includes("in stock")) {
				match = true;
			} else if (
				filterValue === "lowstock" &&
				stockText.includes("low stock")
			) {
				match = true;
			} else if (
				filterValue === "outofstock" &&
				stockText.includes("out of stock")
			) {
				match = true;
			}

			// show or hide based on match result
			if (match) {
				row.style.display = "";
			} else {
				row.style.display = "none";
			}
		});
	});
});
