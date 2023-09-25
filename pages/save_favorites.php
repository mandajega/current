<?php
session_start();
require_once('dbcon.php');

if (isset($_POST['save_favorites'])) {
    $user_id = $_SESSION['user_id'];
    $selected_names = $_POST['selected_names'];

    if (!empty($selected_names)) {
        // Prepare and execute SQL query to insert selected names into the database
        $sql_insert = "INSERT INTO favnames (user_id, babyName) VALUES (?, ?)";
        $stmt = $conn->prepare($sql_insert);

        foreach ($selected_names as $name) {
            // Bind and execute the SQL statement for each selected name
            $stmt->bind_param("ss", $user_id, $name);
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();

        // Redirect to the original page or a success page
        header("Location: babyname.php");
        exit();
    } else {
        echo "No names selected.";
    }
}
?>
