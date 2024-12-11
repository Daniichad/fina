// Modal Functions
function openEditModal(originalNote, originalDate, budget, amount) {
    // Get modal elements
    var modal = document.getElementById('editModal');
    var originalNoteInput = document.getElementById('originalNote');
    var originalDateInput = document.getElementById('originalDate');
    var newDateInput = document.getElementById('newDate');
    var newNoteInput = document.getElementById('newNote');
    var newBudgetInput = document.getElementById('newBudget');
    var newAmountInput = document.getElementById('newAmount');

    // Populate modal with current row data
    originalNoteInput.value = originalNote;
    originalDateInput.value = originalDate;
    newDateInput.value = originalDate;
    newNoteInput.value = originalNote;
    newBudgetInput.value = budget;
    newAmountInput.value = amount;

    // Display the modal
    modal.style.display = 'block';
}

function closeEditModal() {
    var modal = document.getElementById('editModal');
    modal.style.display = 'none';
}

// Close modal if user clicks outside of it
window.onclick = function(event) {
    var modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
