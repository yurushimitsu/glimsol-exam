function markAsComplete(taskId) {
    Swal.fire({
        title: 'Mark as complete?',
        icon: 'question',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: '#2B7FFF',
        cancelButtonColor: '#51A2FF',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/tasks/complete/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            });
        }
    });
}

function markAsPending(taskId) {
    Swal.fire({
        title: 'Mark as pending?',
        icon: 'question',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: '#2B7FFF',
        cancelButtonColor: '#51A2FF',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/tasks/pending/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            });
        }
    });
}

function markAsPendingOverdue(taskId) {
    Swal.fire({
        title: 'Mark as pending?',
        icon: 'info',
        text: 'Update the due date to today or a later date.',
    });
}

function confirmDelete(taskId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: '#2B7FFF',
        cancelButtonColor: '#51A2FF',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/tasks/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: data.message,
                    });
                }
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            });
        }
    });
}