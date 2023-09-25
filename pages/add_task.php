<?php

session_start();
// Database configuration
require_once('dbcon.php');

// Handle the POST request to add a task
if (isset($_POST['submit'])) {
    // Get the data from the request
    $day = $_POST['day'];
    $task_description = $_POST['task_description'];
    $user_id = $_SESSION['user_id'];
    
    // SQL statement to insert a task
    $sql = "INSERT INTO tasktable (user_id, day, task ) VALUES ('$user_id', '$day', '$task_description')";
    

    if ($conn->query($sql) === TRUE) {
        header("Location: comtasklist.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
