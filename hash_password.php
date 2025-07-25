<?php
$password = 'mysecretadminpass'; // YOUR DESIRED ADMIN PASSWORD HERE
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed Password: " . $hashed_password;
?>