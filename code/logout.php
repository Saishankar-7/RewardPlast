<?php
session_start(); // Start the session if not already started

// Destroy the session and redirect to a login page
session_destroy();

// Redirect to your login page after logging out
header("Location:reward.html"); // Replace "login.php" with the actual login page URL
exit;
?>
