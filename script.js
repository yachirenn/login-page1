function toggleForm() {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const formTitle = document.getElementById('form-title');
    const toggleText = document.getElementById('toggle-text');

    loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
    registerForm.style.display = registerForm.style.display === 'none' ? 'block' : 'none';

    if (loginForm.style.display === 'none') {
        formTitle.textContent = 'Register';
        toggleText.innerHTML = 'Already have an account? <a onclick="toggleForm()">Login</a>';
    } else {
        formTitle.textContent = 'Login';
        toggleText.innerHTML = 'Don\'t have an account? <a onclick="toggleForm()">Register</a>';
    }
}