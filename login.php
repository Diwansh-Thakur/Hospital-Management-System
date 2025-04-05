<?php
session_start(); // Start session to track login status

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.php');
    exit();
}

include 'includes/header.php';
?>

<!-- 🌈 Login Page Styling -->
<style>
    .login-container {
        max-width: 400px;
        margin: 60px auto;
        background: #ffffff;
        padding: 30px 25px;
        border-radius: 12px;
        box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #007BFF;
    }

    .login-container label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    .login-container input {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        background-color: #f9f9f9;
        transition: border-color 0.3s ease;
    }

    .login-container input:focus {
        border-color: #007BFF;
        outline: none;
    }

    .login-container button {
        width: 100%;
        padding: 12px;
        background-color: #007BFF;
        border: none;
        color: white;
        font-size: 16px;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .login-container button:hover {
        background-color: #0056b3;
    }

    @media (max-width: 500px) {
        .login-container {
            margin: 30px 15px;
            padding: 20px;
        }
    }
</style>

<!-- ✅ Login Form -->
<div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="login_process.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button type="submit">Login</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
