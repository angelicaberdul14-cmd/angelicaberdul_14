<?php

include 'auth_guard.php';
include 'database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = (int) $_GET['id'];

$query = "DELETE FROM students WHERE id = ?";

$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header('Location: index.php');
exit();

?>