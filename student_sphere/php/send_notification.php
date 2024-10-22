<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $message = $_POST['message'];

    // Convert plain text URLs into HTML links
    $message = convertToLinks($message);

    $stmt = $conn->prepare("INSERT INTO notifications (title, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $message);

    if ($stmt->execute()) {
        $notification_id = $stmt->insert_id;

        $stmt = $conn->prepare("INSERT INTO student_notifications (student_id, notification_id) SELECT id, ? FROM users WHERE role = 'student'");
        $stmt->bind_param("i", $notification_id);

        if ($stmt->execute()) {
            echo "Notification sent successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function convertToLinks($text) {
    // Use regex to find URLs and convert them into clickable links
    return preg_replace(
        '#\bhttps?://[a-zA-Z0-9.-]+(?:\.[a-zA-Z]{2,})+(/[^\s]*)?#',
        '<a href="$0" target="_blank">$0</a>',
        $text
    );
}
?>
