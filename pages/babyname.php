<?php

session_start();

require_once('dbcon.php');

$user_id = $_SESSION['user_id'];

$sql_first_table = "SELECT  babyName FROM babynamegenerator ";
$stmt = $conn->prepare($sql_first_table);
$stmt->execute(); // Execute the prepared statement
$result_first_table = $stmt->get_result();

$stmt->close();
$conn->close();

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
                            <div class="container1">
                                <div class="row1">
                                  <h3 class="heading">Display<span class="arrow">▼</span></h2>
                                  <div class="content1">
                
                                    <button>All Name</button>
                                    <button>Favorite Only</button>
                
                                  </div>
                                </div>
                
                                <div class="row1">
                                  <h3 class="heading">By Gender<span class="arrow">▼</span></h3>
                                  <div class="content1">
                
                                    <button>Girl</button>
                                    <button>Boy</button>
                                    
                
                                  </div>
                                </div>
                

                                <div class="row1">
                                    <h3 class="heading">By Origin<span class="arrow">▼</span></h2>
                                    <div class="content1">
                  
                                      <button>Tamil</button>
                                      <button>Sinhala</button>
                                      <button>English</button>
                  
                                    </div>
                                  </div>
                  
                                  <div class="row1">
                                    <h3 class="heading">By Length<span class="arrow">▼</span></h3>
                                    <div class="content1">
                  
                                      <button>Short(2-4 Letters)</button>
                                      <button>Medium(5-7 Letters)</button>
                                      <button>Long(8-12 Letters)</button>
                  
                                    </div>
                                  </div>
                  
                                  <div class="row1">
                                    <h3 class="heading">By First Letter<span class="arrow">▼</span></h3>
                  
                                    <div class="content1">
                                      
                                      <button>A</button> <button>B</button> <button>C</button> <button>D</button> <button>E</button>
                                      <button>F</button> <button>G</button> <button>H</button> <button>I</button> <button>J</button>
                                      <button>K</button> <button>L</button> <button>M</button> <button>N</button> <button>O</button>
                                      <button>P</button> <button>Q</button> <button>R</button> <button>S</button> <button>T</button>
                                      <button>U</button> <button>V</button> <button>W</button> <button>X</button> <button>Y</button>
                                      <button>Z</button>

                                    </div>
                  
                                  </div>
                                  <br><br><br>
                                  <center>
                                  <button type="submit" name="submit">Apply</button>
                                  </center>
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
                
                <table>
                  <tr>
                    <th>Favorite</th>
                    <th>Baby Name</th>
                  </tr>
                <?php while ($row = $result_first_table->fetch_assoc()) : ?>
                  <tr>
                    <td> <div class="favorite-button"  onclick="toggleFavorite(this, '<?php echo $row['babyName']; ?>')"> 
                    <i class="far fa-heart"></i></div>
                </div>
                  </td>
                    <td><?php echo $row['babyName']; ?></td>
                  </tr>
                  <?php endwhile; ?>
                </table>
                    


                </div>
                <br><br>
                <center>
                <button type="submit" name="fav">Save Favorites</button>
                </center>
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