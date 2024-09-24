<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the default timezone
date_default_timezone_set('Asia/Kolkata'); // Set to your desired timezone

// Database configuration
$servername = "localhost:3306"; // Your MySQL server name
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "realestate"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO signup (fullname, email, username, password, date, time) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ssssss", $fullname, $email, $username, $password, $date, $time);

// Set parameters and execute
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$date = date("Y-m-d"); // Current date
$time = date("H:i:s"); // Current time

if ($stmt->execute()) {
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    // Redirect after successful registration
    header("Location: 1.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>