
const deleteButton = document.getElementById('deleteButton');

deleteButton.addEventListener('click', function(event) {

    const confirmed = confirm('Are you sure to delete ?');
    if (!confirmed) {
        event.preventDefault();
    }
});

document.addEventListener('DOMContentLoaded', (event) => {
    const closeButtons = document.querySelectorAll('.close');

    closeButtons.forEach(closeButton => {
        closeButton.addEventListener('click', function() {
            const alert = this.parentElement;
            alert.style.display = 'none';
        });
    });
});