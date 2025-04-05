<?php
// Password to be hashed
$password = 'admin123'; // Replace this with the password you want to hash

// Generate a hashed password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo "Hashed Password: " . $hashed_password;
?>
