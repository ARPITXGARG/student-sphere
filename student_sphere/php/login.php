<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        if ($user['role'] == 'admin') {
            $_SESSION['admin_logged_in'] = true;
            header("Location: ../admin_dashboard.html");
        } else {
            $_SESSION['student_logged_in'] = true;
            $_SESSION['student_id'] = $user['id'];
            header("Location: ../student_dashboard.html");
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
