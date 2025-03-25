
// Component: x-dlg-confirm-delete
// Function: Call the modal delete dialog with a dynamic delete route
function openDeleteModal(deleteRoute) {
    const deleteForm = document.getElementById('delete-modal-form');
    deleteForm.action = deleteRoute;

    // Show the modal
    const modal = document.getElementById('delete-modal');
    modal.showModal();
}
