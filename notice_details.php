<?php 
  include('includes/config.php');
  session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" type="image/x-icon" href="img/LOGO.PNG">
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css-font/all.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <title>Results Management System</title>
    <script defer src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
     .header__title {
      margin-top: 10%;
        text-align: center;
        font-size: 24px; 
        padding: 20px;
    }
    </style>
  </head>
  <body>
    <header class="header">
        <nav class="nav">
          <img src="img/LOGO.PNG" alt="MSS logo" class="nav__logo"/>
            <ul class="nav__links">
                <li class="nav__item">
                    <a class="nav__link" href="index.php">Home</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link nav__link--btn btn--show-student-portal-modal" href="#">Student-portal</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link nav__link--btn btn--show-modal" href="#">Admin-portal</a>
                </li>
            </ul>
        </nav>
        <div class="header__title">
        <?php
if (isset($_GET['id'])) {
    
    $noticeId = $_GET['id'];

    $query = "SELECT * FROM tblnotice WHERE Id = $noticeId";

    
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
       
        $notice = mysqli_fetch_assoc($result);

        echo "<h1>" . htmlentities($notice['noticeTitle']) . "</h1>";
        echo "Notice Posting Date: " . htmlentities($notice['postingDetails']) . "<br><br>";
        echo "<p>" . htmlentities($notice['noticeDetails']) . "</p>";

       
        mysqli_close($con);
    } else {
        
        echo "Notice not found.";
    }
} else {
    
    echo "Notice Id not provided.";
}
?>

        </div>
    </header>
    <footer>
      <div class="main-content">
        <div class="left box">
          <h2>About us</h2>
          <div class="content">
            <p>Welcome to the Results Management System! We are committed to providing efficient and effective student performance management solutions.</p>
            <p>Our platform simplifies result management processes, empowering educators, students, and parents to stay informed and engaged.</p>
            <div class="social">
              <a href="#"><span class="fab fa-facebook-f"></span></a>
              <a href="#"><span class="fab fa-twitter"></span></a>
              <a href="#"><span class="fab fa-instagram"></span></a>
              <a href="#"><span class="fab fa-youtube"></span></a>
            </div>
          </div>
        </div>
        <div class="center box">
          <h2>Address</h2>
          <div class="content">
            <div class="place">
              <span class="fas fa-map-marker-alt"></span>
              <span class="text">Rwanda, Kigali</span>
            </div>
            <div class="phone">
              <span class="fas fa-phone-alt"></span>
              <span class="text">+250-78-600-5313</span>
            </div>
            <div class="email">
              <span class="fas fa-envelope"></span>
              <span class="text">wilsondev26@gmail.com</span>
            </div>
          </div>
        </div>
        <div class="right box">
          <h2>Get in Touch</h2>
          <div class="content">
            <form action="#">
              <div class="email">
                <div class="text">Email *</div>
                <input type="email"  class="text-box" placeholder="example@gmail.com" required/>
              </div>
              <div class="msg">
                <div class="text">Message *</div>
                <textarea id="message"  cols="25" rows="2" placeholder="Your message"required></textarea>
              </div>
              <div class="cbtn">
                <button id="submit">Send</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="bottom">
        <center>
          <span class="credit">
            Created By <a href="">Wilson-Deve</a> | 
          </span>
          <span class="far fa-copyright"></span>
          <span>2023 All rights reserved</span>
        </center>
      </div>
    </footer>
   
  </body>
</html>
