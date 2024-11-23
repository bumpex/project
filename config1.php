<?php
// Database configuration
$host = 'localhost'; // Your database host (e.g., 'localhost')
$dbname = 'ista'; // The name of your database
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Uncomment the line below to check the connection
    // echo "Connected successfully"; 
}
catch (PDOException $e) {
    // If connection fails, display an error message
    echo "Connection failed: " . $e->getMessage();
}
?>