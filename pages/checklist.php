<?php
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

// Function to escape and sanitize input
function sanitize_input($input, $conn) {
    return $conn->real_escape_string($input);
}

// Start the session (this should be at the top of every page that uses sessions)
session_start();

// Check if the user is logged in and the user_id is available in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Make sure the 'items' field is not empty and is an array
        if (isset($_POST['items']) && is_array($_POST['items'])) {
            foreach ($_POST['items'] as $item) {
                $item_name = sanitize_input($item, $conn);
                $sql = "INSERT INTO hospitalbagchecklist (user_id, item_name) VALUES ('$user_id', '$item_name')";
                if ($conn->query($sql) !== TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            header("Location: checklist.html");
            exit();
        } else {
            echo "Please select at least one item from the checklist.";
        }
    }
} else {
    echo "User not logged in.";
}

// Close the database connection
$conn->close();
?>
