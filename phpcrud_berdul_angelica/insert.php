<?php

include 'auth_guard.php';
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$firstname = trim($_POST['firstname'] ?? '');
$lastname = trim($_POST['lastname'] ?? '');

if ($firstname === '' || $lastname === '') {
    header('Location: index.php');
    exit();
}

$query = "INSERT INTO students (firstname, lastname) VALUES (?, ?)";

$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("ss", $firstname, $lastname);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

header('Location: index.php');
exit();

?>