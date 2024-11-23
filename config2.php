<?php
// config.php

$host = "localhost";
$username = "root"; // Default username for XAMPP
$password = "";     // Default password for XAMPP
$database = "ista";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
