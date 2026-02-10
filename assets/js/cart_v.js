function changeQty(id, change, max) {
    const input = document.getElementById('qty-' + id);
    let val = parseInt(input.value) + change;
    if (val < 1) val = 1;
    if (val > max) {
        Swal.fire({ icon: 'warning', title: 'Stock Limit', text: 'Maximum ' + max + ' units available', timer: 2000, showConfirmButton: false });
        return;
    }
    input.value = val;
    updateTotal();
}

function validateQty(input, max) {
    let val = parseInt(input.value);
    if (isNaN(val) || val < 1) {
        input.value = 1;
    } else if (val > max) {
        input.value = max;
        Swal.fire({ icon: 'warning', title: 'Stock Limit', text: 'Maximum ' + max + ' units available', timer: 2000, showConfirmButton: false });
    }
    updateTotal();
}

function updateTotal() {
    let total = 0, count = 0;

    // Only process active items (those with checkboxes)
    document.querySelectorAll('.item-checkbox:not([disabled])').forEach(cb => {
        const row = cb.closest('.border-bottom');
        const input = row.querySelector('input[type="number"]:not([disabled])');

        if (input) {
            const price = parseFloat(input.dataset.price);
            const qty = parseInt(input.value) || 0;
            const itemTotal = qty * price;

            // Update individual item total
            row.querySelector('[id^="total-"]').textContent = 'RM ' + itemTotal.toFixed(2);

            // Add to grand total if checked
            if (cb.checked) {
                total += itemTotal;
                count++;
            }
        }
    });

    document.getElementById('grand-total').textContent = 'RM ' + total.toFixed(2);
    document.getElementById('selected-count').textContent = count;

    // Update checkout button state
    const btn = document.getElementById('checkoutBtn');
    if (count === 0) {
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-bag-x me-2"></i>Select Items to Checkout';
    } else {
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-bag-check-fill me-2"></i>Proceed to Checkout (' + count + ' item' + (count > 1 ? 's' : '') + ')';
    }
}

function toggleAll(cb) {
    // Only toggle active items that are not disabled
    document.querySelectorAll('.item-checkbox:not([disabled])').forEach(c => c.checked = cb.checked);
    updateTotal();
}

function deleteItem(id, name) {
    Swal.fire({
        title: 'Remove Item?',
        text: 'Remove "' + name + '" from cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, remove it',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d'
    }).then(result => {
        if (result.isConfirmed) {
            fetch("Cart/remove/" + id)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Removed!',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Failed to remove item'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again.'
                    });
                });
        }
    });
}

function checkout() {
    // Get all checked active items only
    const checked = Array.from(document.querySelectorAll('.item-checkbox:checked:not([disabled])'));

    if (checked.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'No Items Selected',
            text: 'Please select at least one item to checkout'
        });
        return;
    }

    // Validate that all checked items are active and have valid quantities
    let hasInvalidItems = false;
    const validItems = [];

    checked.forEach(cb => {
        const row = cb.closest('.border-bottom');
        const qtyInput = row.querySelector('input[type="number"]:not([disabled])');

        // Check if item is active (has enabled quantity input)
        if (qtyInput) {
            const qty = parseInt(qtyInput.value);
            if (qty > 0) {
                validItems.push({ id: cb.value, qty: qty });
            } else {
                hasInvalidItems = true;
            }
        } else {
            hasInvalidItems = true;
        }
    });

    if (hasInvalidItems || validItems.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Selection',
            text: 'Please select only available items with valid quantities'
        });
        return;
    }

    // Create form and submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'Cart/checkout';

    validItems.forEach(item => {
        // Add item ID
        const itemInput = document.createElement('input');
        itemInput.type = 'hidden';
        itemInput.name = 'selected_items[]';
        itemInput.value = item.id;
        form.appendChild(itemInput);

        // Add quantity
        const qtyInput = document.createElement('input');
        qtyInput.type = 'hidden';
        qtyInput.name = 'quantities[' + item.id + ']';
        qtyInput.value = item.qty;
        form.appendChild(qtyInput);
    });

    document.body.appendChild(form);
    form.submit();
}

// Initialize totals on page load
document.addEventListener('DOMContentLoaded', function () {
    updateTotal();
});