<?php

session_start();

// Establish a database connection (replace with your database credentials)

$servername = "localhost";
$username = "root";
$password = "";
$database = "momandme";

$conn = new mysqli($servername, $username, $password, $database);

$user_id = $_SESSION['user_id'];

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the date and note from the form
$date = $_POST['date']; // Retrieve the selected date
$note = $_POST['note'];

// SQL query to insert the data into a table named 'notes' (replace with your table name)
$sql = "INSERT INTO eventtable (user_id, date, title) VALUES ('$user_id','$date', '$note')";

if ($conn->query($sql) === TRUE) {
    header("Location: comnote.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
