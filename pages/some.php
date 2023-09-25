<?php
// Check if the form has been submitted
require_once('dbcon.php');


    session_start();

   
// Function to escape and sanitize input


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Make sure the 'items' field is not empty and is an array
    if (isset($_POST['items']) && is_array($_POST['items'])) {
        // Get the user_id of the logged-in user from your authentication system
        $user_id = $_SESSION['user_id']; // Replace this with the actual way to get the user_id

        // Prepare and execute the INSERT statement for each selected item
        foreach ($_POST['items'] as $item) {
            $item_name = $item ;
            $sql = "INSERT INTO stuffyouwillneed (user_id, item_name) VALUES ('$user_id', '$item_name')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        header("Location: some.html");
        exit();
    } else {
        echo "Please select at least one item from the checklist.";
    }
}


// Close the database connection
$conn->close();
?>
