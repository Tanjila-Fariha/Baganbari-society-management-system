<?php
// Start session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or any other page you want
header("Location: http://localhost/CSE370_project/Resident_login.html");
exit();
?>
