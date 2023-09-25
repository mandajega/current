<?php
session_start();
require_once('dbcon.php');

if (isset($_POST['apply_filter'])) {
    $user_id = $_SESSION['user_id'];
    $gender = $_POST['gender'];

    // Build the SQL query based on the selected gender
    $sql = "SELECT babyName FROM babynamegenerator ";
    if ($gender != 'All') {
        $sql .= "WHERE gender = ?";
    }

    $stmt = $conn->prepare($sql);

    if ($gender != 'All') {
        $stmt->bind_param("s", $gender);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();

    // Display the filtered names on a new page
    // You can create a separate PHP/HTML page to display the results.
    // For simplicity, I'm showing it here.
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Names</title>

    <link rel="stylesheet" href="..\srs\css\sleeplog.css">
    <style>
    th, td {
        padding: 5px; /* Adjust this value to increase or decrease the space */
    }

    ul {
    list-style-type: none;
    padding: 0; /* Remove default padding */
}

/* Style for list items */
li {
    margin: 5px 0; /* Add margin between list items */
}

.scrollable-container {
            max-height: 400px; /* Adjust the height as needed */
            overflow: auto;
        }
</style>

    </head>
    <body>

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
                        <span class="title">Contact</span>
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

            
            <a href="nutrition.html">
        <div class="back-card">
            <div>
                <a href="babyname.php">
                <button class="back-button">Back</button>
            </div>
        </div>
        </a>


            <center>

            <div class="rightcolumn">

                <div class="card">
                  <div class="wd">
                      
                  </div>

        <h1>Filtered Baby Names</h1>

        <div class="scrollable-container">
        <ul>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <li><?php echo $row['babyName']; ?></li>
            <?php endwhile; ?>
        </ul>
            </div>
            </div>
            </div>
    </body>
    </html>
    <?php
}
?>
