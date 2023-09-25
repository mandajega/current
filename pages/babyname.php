<?php
session_start();

require_once('dbcon.php');

// Check if the form has been submitted
if (isset($_POST['apply_filter'])) {
    // Retrieve the filter options from $_POST
    $display = $_POST['display'];
    $gender = $_POST['gender'];
    $origin = $_POST['origin'];
    $length = $_POST['length'];
    $letter = $_POST['letter'];

    // Build the SQL query based on the selected filter options
    $sql = "SELECT babyName FROM babynamegenerator WHERE 1=1"; // Start with a true condition

    // Add conditions based on selected filter options
    if ($display == 'Favorites') {
        $sql .= " AND isFavorite = 1"; // Assuming there's a column isFavorite
    }

    if ($gender != 'All') {
        $sql .= " AND gender = ?";
    }

    if ($origin != 'All') {
        $sql .= " AND origin = ?";
    }

    if ($length != 'All') {
        // Assuming you have a column like nameLength
        if ($length == 'short') {
            $sql .= " AND nameLength >= 2 AND nameLength <= 4";
        } elseif ($length == 'medium') {
            $sql .= " AND nameLength >= 5 AND nameLength <= 7";
        } elseif ($length == 'long') {
            $sql .= " AND nameLength >= 8 AND nameLength <= 12";
        }
    }

    if ($letter != 'All') {
        $sql .= " AND babyName LIKE ?";
        $letter = $letter . '%'; // Add a wildcard to match names starting with the selected letter
    }

    $stmt = $conn->prepare($sql);

    // Bind parameters if needed
    if ($gender != 'All') {
        $stmt->bind_param("s", $gender);
    }
    
    if ($letter != 'All') {
        $stmt->bind_param("s", $letter);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();
} else {
    // Default query without any filters when the page is initially loaded
    $sql_first_table = "SELECT babyName FROM babynamegenerator";
    $stmt = $conn->prepare($sql_first_table);
    $stmt->execute();
    $result_first_table = $stmt->get_result();
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <title>Baby Name Generator</title>

    <!--================ style ==================-->
    <link rel="stylesheet" href="../srs/css/babyname.css">

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
                  <a href="../pages/firstpage.html">
                      <span class="icon">
                          <ion-icon name="home-outline"></ion-icon>
                      </span>
                      <span class="title">Dashboard</span>
                  </a>
              </li>

              <li>
                  <a href="../pages/comnote.html">
                      <span class="icon">
                          <ion-icon name="clipboard-outline"></ion-icon>
                      </span>
                      <span class="title">Note</span>
                  </a>
              </li>

              <li>
                  <a href="../pages/comcontact.html">
                      <span class="icon">
                          <ion-icon name="call-outline"></ion-icon>
                      </span>
                      <span class="title">Contact</span>
                  </a>
              </li>
              
              <li>
                  <a href="../pages/comsetting.html">
                      <span class="icon">
                          <ion-icon name="settings-outline"></ion-icon>
                      </span>
                      <span class="title">Settings</span>
                  </a>
              </li>
              
              <li>
                  <a href="../pages/comsignout.html">
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
                  <label>
                    <input type="text" placeholder="Account">
                    <img src="asq.jpg" alt="">
                  </label>
                </div>
            </div>

            <!-- ======================= Cards ================== -->
          <div class="scroll-container">
            <div class="cardBox">

              <a href="../pages/firstpage.html">
              <div class="back-card">
                  <div>
                      <button class="back-button">Back</button>
                  </div>
              </div>
              </a>

              <div class="head-card">
                  <div>
                      <div class="cardName">Baby Name Generator</div>
                  </div>
              </div>
            </div>

            <!-- ================ Input & Output Details List ================= -->
            <div class="row">

                <div class="sentence1"<h2>What should we name your baby?</h2></div>
                
                <div>
                    <div class="box">
                        <a href="#popup-box">
                            <ion-icon name="options-outline"></ion-icon>
                            Filter
                        </a>
                    </div>
                    <div id="popup-box" class="modal">
                        <div class="content">
                            <h1 style="color: green;">
                                Filter
                            </h1>
                            <form action="filter_names.php" method="post" id="filterForm">
                            <div class="container1">
                                <div class="row1">
                                  <h3 class="heading">Display<span class="arrow">▼</span></h2>
                                  <div class="content1">
                
                                  <select name="display">
                                    <option value="All">All</option>
                                     <option value="Favorites">Favorites</option>
                                      
                                           </select>
                                         </div>
                                       </div>
                
                             
                                <div class="row1">
                               <h3 class="heading">By Gender<span class="arrow">▼</span></h3>
                               <div class="content1">
                                  <select name="gender">
                                    <option value="All">All</option>
                                     <option value="Girl">Girl</option>
                                      <option value="Boy">Boy</option>
                                           </select>
                                         </div>
                                       </div>
                

                                <div class="row1">
                                    <h3 class="heading">By Origin<span class="arrow">▼</span></h2>
                                    <div class="content1">
                                      <select name="origin">
                  
                                      <option value = "Tamil">Tamil</option>
                                      <option value = "Sinhala">Sinhala</option>
                                      <option value = "English">English</option>
                                      
                                      </select>
                  
                                    </div>
                                  </div>
                  
                                  <div class="row1">
                                    <h3 class="heading">By Length<span class="arrow">▼</span></h3>
                                    <div class="content1">
                                      <select name="length">
                  
                                      <option value ="short">Short(2-4 Letters)</option>
                                      <option value ="medium" >Medium(5-7 Letters)</option>
                                      <option value = "long" >Long(8-12 Letters)</option>
                                      </select>
                  
                                    </div>
                                  </div>
                  
                                  <div class="row1">
                                    <h3 class="heading">By First Letter<span class="arrow">▼</span></h3>
                  
                                    <div class="content1">
                                      <select name="letter">
                                      
                                      <option value = "A">A</option><option value = "B">B</option><option value = "C">C</option><option value = "D">D</option><option value = "E">E</option><option value = "F">F</option>
                                      <option value = "G">G</option><option value = "H">H</option><option value = "I">I</option><option value = "J">J</option><option value = "K">K</option><option value = "L">L</option>
                                      <option value = "M">M</option><option value = "N">N</option><option value = "O">O</option><option value = "P">P</option><option value = "Q">Q</option><option value = "R">R</option>
                                      <option value = "S">S</option><option value = "T">T</option><option value = "U">U</option><option value = "V">V</option><option value = "W">W</option><option value = "X">X</option>
                                      <option value = "Y">Y</option><option value = "Z">Z</option>
</select>

                                    </div>
                  
                                  </div>
                                  <br><br><br>
                                  <center>
                                  <button type="submit" name="apply_filter">Apply</button>
                                  </center>

</form>
                              </div>
                            <a href="#"
                            class="box-close">
                                ×
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <button>
                    <ion-icon name="options-outline"></ion-icon>
                    filter name
                </button> -->
                
                <div class="card">
                  <a href="">
                  <div class="search1">
                    
                  </div>
                  </a>
                </div>

                <div class="det-hd"><u>Popular Names</u></div>

                <div class="details">

                <form action="save_favorites.php" method="post" id="favoritesForm">
                                 
                <table>
                  <tr>
                    <th>Select Favorites</th>
                    <th>Baby Name</th>
                  </tr>
                <?php while ($row = $result_first_table->fetch_assoc()) : ?>
                  <tr>
                    <td> 
                    <input type="checkbox" name="selected_names[]" value="<?php echo $row['babyName']; ?>">
        </td>
        <td><?php echo $row['babyName']; ?></td>
      </tr>
                  <?php endwhile; ?>
                </table>
                    


                
                <br><br>
                <center>
                <button type="submit" name="save_favorites">Save Favorites</button>
                </center>
                </form>
            </div>
          </div>  
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    
    <script src="../scripts/babyname.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
</body>
</html>