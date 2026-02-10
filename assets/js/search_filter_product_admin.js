document.addEventListener("DOMContentLoaded", function () {
    // Get references to HTML elements
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("productsTableBody");

    // Main search function
    function searchProducts() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const rows = tableBody.getElementsByTagName("tr");
        let visibleCount = 0;

        // Loop through each row
        Array.from(rows).forEach(function (row) {
            // Get all text in the row
            let rowText = "";
            for (let i = 0; i < row.cells.length; i++) {
                rowText += row.cells[i].textContent.toLowerCase() + " ";
            }

            // Check if the search term matches
            let matchesSearch = false;
            if (searchTerm === "") {
                matchesSearch = true;
            } else if (rowText.includes(searchTerm)) {
                matchesSearch = true;
            }

            // Show or hide the row
            if (matchesSearch) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        // Optional: show "no results" row
        const noResultRow = document.getElementById("noResultRow");
        if (noResultRow) {
            if (visibleCount === 0) {
                noResultRow.style.display = "";
            } else {
                noResultRow.style.display = "none";
            }
        }
    }

    // Run search on every input change
    searchInput.addEventListener("input", searchProducts);
});
