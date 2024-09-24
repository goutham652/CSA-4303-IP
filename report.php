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
$stmt = $conn->prepare("INSERT INTO report (name, email, phone, date, time) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("sssss", $name, $email, $phone, $date, $time);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = date("Y-m-d"); // Current date
$time = date("H:i:s"); // Current time

if ($stmt->execute()) {
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    // Redirect after successful registration
    header("Location:book.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
