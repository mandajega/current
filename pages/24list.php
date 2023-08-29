<?php

session_start();

$servername = "localhost"; // Change this to your database server's name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "momandme"; // Change this to your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch data from the first table, limiting to the first seven records
$sql_first_table = "SELECT item_name FROM 24babyregistry WHERE user_id = ?";
$stmt = $conn->prepare($sql_first_table);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result_first_table = $stmt->get_result();


if (isset($_POST['updateList'])) {
    // Delete records under the specific user ID
    $sql_delete_records = "DELETE FROM 24babyregistry WHERE user_id = ?";
    $stmt_delete = $conn->prepare($sql_delete_records);
    $stmt_delete->bind_param("s", $user_id);
    
    if ($stmt_delete->execute()) {
        // Redirect to some.html after successful deletion
        header("Location: 24.html");
        exit(); // Important: Terminate script execution after redirection
    } else {
        echo "Error deleting records: " . $stmt_delete->error;
    }
}




// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>

    <!--================ style ==================-->
    <link rel="stylesheet" href="../srs/css/sleeplog.css">
    <style>
    th, td {
        padding: 5px; /* Adjust this value to increase or decrease the space */
    }
</style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <img src="mom&me.jpg" alt="logo">
                        </span>
                        <span class="title1"><h1>Mom & Me</h1></span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="clipboard-outline"></ion-icon>
                        </span>
                        <span class="title">Note</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="call-outline"></ion-icon>
                        </span>
                        <span class="title">Contect</span>
                    </a>
                </li>

             

              

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

               

                <div class="user">
                    <!-- <input type="text"  placeholder="Account"> -->
                    <img src="asq.jpg" alt="">
                    <div>
                        <h4>Ashfaq mjaa</h4>
                        <small>Super admin</small>
                    </div>
                </div>
            </div>


            <div class ="cardBox">

            <a href="24.html">
                <div class="back-card">
                    <div>
                        <button class="back-button">Back</button>
                    </div>
                </div>
              </a>  
</div>

            <center>

            <div class="rightcolumn">

                <div class="card">
                  <div class="wd">
                      
                  </div>

                  <div class="sug">
                    <h2>My list:</h2><br>
                     <ul id="log" style="font-size: 18px;"></ul>

                        <div id="average" style="font-size: 16px;"></div>
                        <table>
                        <tr>
                <th>Item Name</th>
                
            </tr>
            <?php while ($row = $result_first_table->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['item_name']; ?></td>
                    
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <form method="post">
    <button class="button" type="submit" name="updateList">Update my list</button>
</form>

          </div>

              </div>

            </div>
            </center>


    <!-- =========== Scripts =========  -->
    <script src="../scripts/navigation.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>