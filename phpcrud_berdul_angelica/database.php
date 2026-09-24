<?php

$conn = new mysqli("localhost", "root", "", "phpcrud_berdul_angelica");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Siguraduhing may users table na para sa login/register.
$conn->query("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

?>