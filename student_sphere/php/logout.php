<?php
session_start();
// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or home page
header("Location: http://localhost/ac/student_sphere/login.html");
exit();

?>
C:\xampp\htdocs\ac\student_sphere\php\logout.php