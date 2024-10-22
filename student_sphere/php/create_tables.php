<?php
include 'db_connection.php';

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'admin') NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully.<br>";
} else {
    echo "Error creating table users: " . $conn->error . "<br>";
}

// Create notifications table
$sql = "CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,  -- Allows for HTML input (e.g., links)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table notifications created successfully.<br>";
} else {
    echo "Error creating table notifications: " . $conn->error . "<br>";
}

// Create student_notifications table
$sql = "CREATE TABLE IF NOT EXISTS student_notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    notification_id INT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (notification_id) REFERENCES notifications(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table student_notifications created successfully.<br>";
} else {
    echo "Error creating table student_notifications: " . $conn->error . "<br>";
}

$conn->close();
?>
