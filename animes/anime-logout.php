<?php
session_start();
session_destroy(); // Destroy the session to log out the user
header("Location: ../index.php"); // Redirect to the homepage or index page
exit();
?>