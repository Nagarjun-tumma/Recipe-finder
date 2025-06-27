<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = ''; // change if your MySQL has password
$dbname = 'feedback_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$rating = $_POST['rating'] ?? '';

if ($name && $email && $rating) {
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $email, $rating);

    if ($stmt->execute()) {
        echo "<h2>Thank you, $name! Your feedback has been recorded.</h2>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Please fill all fields!";
}

$conn->close();
?>
