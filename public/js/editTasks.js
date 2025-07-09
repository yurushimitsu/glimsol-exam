function populateEditForm(button) {
    const id = button.dataset.id;
    const title = button.dataset.title;
    const dueDate = button.dataset.dueDate;
    const description = button.dataset.description;

    document.getElementById(`task-title-${id}`).textContent = title;
    document.getElementById(`edit-title-${id}`).value = title;
    document.getElementById(`edit-due-date-${id}`).value = dueDate;
    document.getElementById(`edit-description-${id}`).value = description || 'No Description';
}

function enableEdit(taskId) {
    document.getElementById(`edit-title-${taskId}`).removeAttribute('readonly');
    document.getElementById(`edit-due-date-${taskId}`).removeAttribute('readonly');
    document.getElementById(`edit-description-${taskId}`).removeAttribute('readonly');

    document.getElementById(`close-edit-button-${taskId}`).textContent = 'Cancel';
    document.getElementById(`edit-button-${taskId}`).classList.add('!hidden');
    document.getElementById(`save-edit-button-${taskId}`).classList.remove('!hidden');
}

function closeEdit(taskId) {
    document.getElementById(`edit-title-${taskId}`).setAttribute('readonly', true);
    document.getElementById(`edit-due-date-${taskId}`).setAttribute('readonly', true);
    document.getElementById(`edit-description-${taskId}`).setAttribute('readonly', true);

    document.getElementById(`close-edit-button-${taskId}`).textContent = 'Close';
    document.getElementById(`edit-button-${taskId}`).classList.remove('!hidden');
    document.getElementById(`save-edit-button-${taskId}`).classList.add('!hidden');
}