<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link rel="stylesheet" href="login1style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="wrapper">
        <div class="form-container">
            <!-- Login Form -->
            <form action="login.php" id="loginForm" method="POST">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="loginPassword" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <!-- Show Password Checkbox -->
                <label>
                    <input type="checkbox" id="showLoginPassword"> Show Password
                </label>
                <button type="submit" class="btn">Login</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="#" id="showRegister">Register</a></p>
                </div>
            </form>

            <!-- Register Form -->
            <form action="register.php" id="registerForm" method="POST">
                <h1>Sign Up</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="registerPassword" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <!-- Show Password Checkbox -->
                <label>
                    <input type="checkbox" id="showRegisterPassword"> Show Passwords
                </label>
                <button type="submit" class="btn">Register</button>
                <div class="register-link">
                    <p>Already have an account? <a href="#" id="showLogin">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle between login and register forms
        const formContainer = document.querySelector('.form-container');
        const showRegisterLink = document.getElementById('showRegister');
        const showLoginLink = document.getElementById('showLogin');

        showRegisterLink.addEventListener('click', (event) => {
            event.preventDefault();
            formContainer.style.transform = 'translateX(-50%)';
        });

        showLoginLink.addEventListener('click', (event) => {
            event.preventDefault();
            formContainer.style.transform = 'translateX(0)';
        });

        
        // Password validation regex
        const passwordRegex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

        // Handle registration form submission
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            const email = document.querySelector('input[name="email"]').value;
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Email validation
            if (!email.includes('@')) {
                alert('Invalid email address. Please include "@" in the email.');
                return;
            }

            // Password validation
            if (!passwordRegex.test(password)) {
                alert('Password must be at least 8 characters long and include letters, numbers, and symbols.');
                return;
            }

            // Confirm password validation
            if (password !== confirmPassword) {
                alert('Passwords do not match. Please try again.');
                return;
            }

            // Proceed with form submission if validation passes
            const formData = new FormData(this);

            fetch('register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message); // Show success popup
                    window.location.href = 'login-register.php'; // Redirect to login page
                } else {
                    alert(data.message); // Show error message
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Handle login form submission
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(`Welcome, ${data.username}!`);

                    // Redirect based on the role
                    let redirectUrl = '';
                    if (data.role === 'admin') {
                        redirectUrl = 'admin-dashboard.php'; // Admin Dashboard
                    } else if (data.role === 'doctor') {
                        redirectUrl = 'doctor-dashboard.php'; // Doctor Dashboard
                    } else {
                        redirectUrl = 'profile.php'; // User Dashboard
                    }

                    window.location.href = redirectUrl;
                } else {
                    alert(data.message); // Show error message if login fails
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An unexpected error occurred. Please try again later.');
            });

        });



        // Show/Hide Password in Login Form
        document.getElementById('showLoginPassword').addEventListener('change', function() {
            const loginPassword = document.getElementById('loginPassword');
            loginPassword.type = this.checked ? 'text' : 'password';
        });

        // Show/Hide Passwords in Register Form
        document.getElementById('showRegisterPassword').addEventListener('change', function() {
            const registerPassword = document.getElementById('registerPassword');
            const confirmPassword = document.getElementById('confirmPassword');
            const type = this.checked ? 'text' : 'password';
            registerPassword.type = type;
            confirmPassword.type = type;
        });

    </script>
</body>

</html>
