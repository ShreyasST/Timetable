// Toggle password visibility
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.previousElementSibling;
        const icon = this.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

// Form validation
const authForms = document.querySelectorAll('.auth-form');
authForms.forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form inputs
        const inputs = this.querySelectorAll('input[required]');
        let isValid = true;
        
        // Basic validation
        inputs.forEach(input => {
            if (!input.value.trim()) {
                markInvalid(input, 'This field is required');
                isValid = false;
            } else {
                markValid(input);
                
                // Email validation
                if (input.type === 'email' && !isValidEmail(input.value)) {
                    markInvalid(input, 'Please enter a valid email address');
                    isValid = false;
                }
                
                // Password confirmation validation
                if (input.id === 'confirm-password') {
                    const password = document.getElementById('password').value;
                    if (input.value !== password) {
                        markInvalid(input, 'Passwords do not match');
                        isValid = false;
                    }
                }
            }
        });
        
        if (isValid) {
            // Here you would typically send the data to your server
            console.log('Form is valid, submitting...');
            
            // Simulate successful submission
            showMessage('Success! Redirecting...', 'success');
            
            // Redirect to dashboard or home page after a delay
            setTimeout(() => {
                window.location.href = 'index.html';
            }, 2000);
        }
    });
});

// Helper functions
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function markInvalid(input, message) {
    input.classList.add('is-invalid');
    
    // Remove any existing error message
    const existingError = input.parentElement.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Add error message
    const errorElement = document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.textContent = message;
    input.parentElement.appendChild(errorElement);
}

function markValid(input) {
    input.classList.remove('is-invalid');
    
    // Remove any existing error message
    const existingError = input.parentElement.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
}

function showMessage(message, type) {
    // Create message element
    const messageElement = document.createElement('div');
    messageElement.className = `alert alert-${type}`;
    messageElement.textContent = message;
    
    // Add to the page
    const form = document.querySelector('.auth-form');
    form.prepend(messageElement);
    
    // Remove after a delay
    setTimeout(() => {
        messageElement.remove();
    }, 5000);
}

// Add some additional styles for validation
const style = document.createElement('style');
style.textContent = `
    .is-invalid {
        border-color: #dc3545 !important;
    }
    
    .error-message {
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }
    
    .alert {
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border-radius: var(--border-radius);
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
`;
document.head.appendChild(style);