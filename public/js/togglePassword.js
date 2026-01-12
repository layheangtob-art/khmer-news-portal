document.addEventListener("DOMContentLoaded", function() {
    // Handle password toggle for login form
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#passwordInput') || document.querySelector('[name="password"]');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function (e) {
            e.preventDefault();
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }

    // Handle confirm password toggle for register form
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPasswordInput = document.querySelector('#confirmPasswordInput') || document.querySelector('[name="password_confirmation"]');

    if (toggleConfirmPassword && confirmPasswordInput) {
        toggleConfirmPassword.addEventListener('click', function (e) {
            e.preventDefault();
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }
});
