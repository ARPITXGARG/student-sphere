<?php
include 'db_connection.php';

$password = password_hash('adminpassword', PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
$stmt->bind_param("sss", $name, $email, $password);

$name = 'Admin';
$email = 'admin@example.com';

if ($stmt->execute()) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
