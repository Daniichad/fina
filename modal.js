document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('editModal');
    const closeBtn = document.querySelector('.close');
    const editForm = document.getElementById('editForm');

    // Function to open edit modal
    window.openEditModal = function(productName) {
        fetch(`tracker_business.php?fetch_details=1&product_name=${encodeURIComponent(productName)}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }

                // Populate form fields
                document.getElementById('original_product_name').value = productName;
                document.getElementById('edit_date').value = data.date;
                document.getElementById('edit_quantity').value = data.quantity;
                document.getElementById('edit_product_name').value = data.product_name;
                document.getElementById('edit_price').value = data.price;
                document.getElementById('edit_cost').value = data.cost;
                document.getElementById('edit_fixed_cost').value = data.fixed_cost;
                document.getElementById('edit_variable_costperunit').value = data.variable_costperunit;
                document.getElementById('original_product_name').value = data.product_name;
                

                // Show modal
                modal.style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to load product details');
            });
    };

    // Close modal when clicking the close button
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    };

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    // Handle form submission
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(editForm);
        formData.append('update_business', '1');

        fetch('tracker_business.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                alert(result.message);
                modal.style.display = 'none';
                location.reload(); // Refresh to show updated data
            } else {
                alert(result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred');
        });
    });
});

// Optional: Logout confirmation
function confirmLogout() {
    return confirm('Are you sure you want to logout?');
}