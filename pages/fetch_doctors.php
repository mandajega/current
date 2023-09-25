<?php
// Connect to the database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'momandme';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $speciality = $_POST['speciality'];

    // Query to retrieve doctors based on the selected speciality
    $query = "SELECT name, hospital, contactno FROM healthcareproviders WHERE area = '$speciality'";
    $result = $conn->query($query);

}

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

            <div class="scroll-container">
            <div class="cardBox">

                <div class="back-card">
                    <a href="provi.html">
                    <div>
                        <button class="back-button">Back</button>
                    </div>
                    </a>
                </div>

            <center>

            <div class="rightcolumn">

                <div class="card">
                  <div class="wd">
                      
                  </div>

                  <div class="sug">
                    <h2>Contacts of Doctors :</h2><br>
                     <ul id="log" style="font-size: 18px;"></ul>

                        <div id="average" style="font-size: 16px;"></div>
                        <table>
                        <tr>
                <th>Name</th>
                <th>Hospital</th>
                <th>Contact Number</th>
                
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['hospital']; ?></td>
                    <td><?php echo $row['contactno']; ?></td>
                    
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

          </div>

              </div>

            </div>
            </center>
            </div>


    <!-- =========== Scripts =========  -->
    <script src="../scripts/navigation.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>