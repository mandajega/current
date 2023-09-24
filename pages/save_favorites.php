<?php
session_start();

require_once('dbcon.php');

if (isset($_POST['save_favorites'])) {
    $user_id = $_SESSION['user_id'];
    $favoriteNames = $_POST['favorite_names'];

    // Loop through the selected favorite names and insert them into the database
    foreach ($favoriteNames as $name) {
        // Use prepared statement to prevent SQL injection
        $sql_insert_favorite = "INSERT INTO favnames (user_id, babyName) VALUES (?, ?)";
        $stmt = $conn->prepare($sql_insert_favorite);
        $stmt->bind_param("is", $user_id, $name);
        $stmt->execute();
    }

    // Close database connection
    $conn->close();
    
    // Redirect back to the previous page or any desired page
    header("Location: babyname.php");
    exit();
}
?>
