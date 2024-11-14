document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.input-validation');

    inputs.forEach(input => {
        const errorDiv = document.getElementById(`${input.name}-error`);

        input.addEventListener('input', function () {
            // Clear any previous error messages
            errorDiv.classList.add('hidden');
            errorDiv.textContent = '';

            // Email validation
            if (input.type === 'email') {
                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (input.value && !emailPattern.test(input.value)) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Please enter a valid email address.';
                }
            }
            // Password validation
            else if (input.type === 'password') {
                if (input.value.length < 6) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Password must be at least 6 characters long.';
                }
            }
            // Current Password validation
            else if (input.name === 'current_password') {
                if (input.value.trim() === '') {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Current password is required.';
                }
            }

            // Confirm Password validation (ensure it matches New Password)
            else if (input.name === 'password_confirmation') {
                const passwordInput = document.querySelector('input[name="password"]');
                if (passwordInput && input.value !== passwordInput.value) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'Passwords do not match.';
                }
            }

            // Text and textarea validation
            else if (input.type === 'text' || input.type === 'textarea') {
                if (input.value.trim() === '') {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = `${input.placeholder || 'This field'} is required.`;
                }
            }
        });
    });
});

