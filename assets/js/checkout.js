// Address Modal Functionality
document.addEventListener('DOMContentLoaded', function () {

    // Auto-fill edit address textarea when selecting an address
    const editAddressSelect = document.getElementById('edit_address_select');
    const newAddressText = document.getElementById('new_address_text');

    if (editAddressSelect && newAddressText) {
        editAddressSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const addressData = selectedOption.getAttribute('data-address');
            newAddressText.value = addressData || '';
        });
    }

    // Handle delete address button clicks
    const deleteButtons = document.querySelectorAll('.delete-address-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const addressId = this.dataset.addressId;
            const addressText = this.dataset.addressText;

            // Native confirm dialog (no SweetAlert needed)
            if (confirm(`Are you sure you want to delete this address?\n\n${addressText}`)) {
                // Create and submit form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = this.dataset.deleteUrl; // Set this in HTML

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ua_id';
                input.value = addressId;

                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});