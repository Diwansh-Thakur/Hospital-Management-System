<?php
session_start(); // Start the session

include 'includes/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Replace this with your own authentication logic (for example, querying the database)
    // Simple hardcoded check (for demo purposes)
    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['logged_in'] = true;  // Set session variable to track login status
        $_SESSION['username'] = $username;  // Store the username in session (optional)

        // Redirect to homepage or dashboard
        header('Location: index.php');
        exit();
    } else {
        echo "Invalid login credentials!";
    }
}
?>
