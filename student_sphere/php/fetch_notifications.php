<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['student_logged_in'])) {
    header("Location: ../login.html");
    exit();
}

$student_id = $_SESSION['student_id'];

$stmt = $conn->prepare("SELECT n.title, n.message, sn.is_read FROM notifications n JOIN student_notifications sn ON n.id = sn.notification_id WHERE sn.student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

echo json_encode($notifications);

$stmt->close();
$conn->close();
?>
