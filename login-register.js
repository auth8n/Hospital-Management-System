<script>
    const formContainer = document.querySelector('.form-container');
    const loginLink = document.querySelector('.register-link a');  // Link to switch to login
    const registerLink = document.querySelector('.register-link a'); // Link to switch to register

    loginLink.addEventListener('click', (event) => {
        event.preventDefault();
        formContainer.style.transform = 'translateX(0%)'; // Center login form in the viewport
    });

    registerLink.addEventListener('click', (event) => {
        event.preventDefault();
        formContainer.style.transform = 'translateX(-50%)'; // Center register form in the viewport
    });
</script>
