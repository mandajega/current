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


session_start();

// Function to escape and sanitize input
function sanitize_input($input, $conn) {
    return $conn->real_escape_string($input);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_id = $_SESSION['user_id'];
    $first_time_pregnancy = sanitize_input($_POST['Yes/No'], $conn);
    $trimester_value = sanitize_input($_POST['radio'], $conn);
    $due_date = sanitize_input($_POST['yyyy'] . "-" . $_POST['nn'] . "-" . $_POST['dd'], $conn);

    if ($trimester_value == "1st") {
        $trimester_label = "1st Trimester";
    } elseif ($trimester_value == "2nd") {
        $trimester_label = "2nd Trimester";
    } elseif ($trimester_value == "3rd") {
        $trimester_label = "3rd Trimester";
    } else {
        $trimester_label = "Unknown";
    }


    // Prepare and execute the INSERT statement
    $sql = "INSERT INTO currentlypregnantqs (user_id, experience, trimester, duedate) 
            VALUES ('$user_id','$first_time_pregnancy', '$trimester_value', '$due_date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: firstpage.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
