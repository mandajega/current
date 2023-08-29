<?php
// Start session
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "momandme";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    $date = $_POST['date'];
    $water_drunk = $_POST['water_drunk'];

    // Insert data into the database
    $sql = "INSERT INTO waterconsumptiontracker (user_id, date, numberOfGlasses) VALUES ('$user_id', '$date', '$water_drunk')";

    if ($conn->query($sql) === TRUE) {
        header("Location: watercurrent.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
