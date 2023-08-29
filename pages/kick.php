<?php
if(isset($_POST['submit'])){
// Replace these credentials with your own MySQL database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "momandme";

// Establish the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Function to escape and sanitize input
function sanitize_input($input, $conn) {
    return $conn->real_escape_string($input);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['user_id'];
    // Get form data
    $date = sanitize_input($_POST['date'], $conn);
    $minutes = sanitize_input($_POST['minutes'], $conn);
    $seconds = sanitize_input($_POST['seconds'], $conn);
    $num_of_kicks = sanitize_input($_POST['kicks'], $conn);

    // Combine minutes and seconds into "duration"
    $duration = sprintf("%02d:%02d", $minutes, $seconds);

    // Prepare and execute the INSERT statement
    $sql = "INSERT INTO kickcounter (user_id, date, duration, noOfKicks) VALUES ('$user_id','$date', '$duration', '$num_of_kicks')";

    if ($conn->query($sql) === TRUE) {
        header("Location: kick.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close the database connection
$conn->close();
}
?>
