<?php
session_start(); // Start session

// Destroy the session to log the user out
session_destroy();

// Redirect to login page
header('Location: login.php');
exit();
?>
