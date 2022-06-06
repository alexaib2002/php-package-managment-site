function addValidationListeners() {
    // Fetch all the forms with needs-validation pseudo-class
    const forms = document.querySelectorAll('.needs-validation');
    // Loop over them and add event to prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
}
