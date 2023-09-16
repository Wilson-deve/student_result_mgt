<?php 
include('includes/config.php');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

$notices = []; 

$sql = "SELECT * FROM tblnotice ORDER BY postingDetails DESC";
$result = mysqli_query($con, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $notices[] = $row;
    }
}

$classData = array();
$query = "SELECT DISTINCT Id, ClassName, Section FROM tblclasses";
$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $classData[$row['Id']] = $row['ClassName'] . ' - ' . $row['Section'];
    }
    mysqli_free_result($result);
}
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
      .notices__notice p a {
    color: #333; 
    text-decoration: none; 
    transition: color 0.3s;
}


.notices__notice p a:hover {
  color: #4bbb7d; 
}

    </style>
  </head>
  <body>
    <header class="header">
        <nav class="nav">
          <img src="img/log.png" alt="MSS logo" class="nav__logo"/>
            <ul class="nav__links">
                <li class="nav__item">
                    <a class="nav__link" href="index.php">Home</a>
                </li>
                <li class="nav__item">
                  <a class="nav__link"  href="#section--2">Team</a>
              </li>
                <li class="nav__item">
                    <a class="nav__link nav__link--btn btn--show-student-portal-modal" href="#">Student-portal</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link nav__link--btn btn--show-modal" href="#">Admin-portal</a>
                </li>
            </ul>
        </nav>
        <div class="slider">
          <div class="slide">
              <div class="slide-content-wrapper">
                  <div class="tex-content">
                      <h1 class="slide-title">Varied Curriculum for
                        Kids and Teens</h1>
                        <button class="btn--text btn--scroll-to">Notices &DownArrow;</button>
                  </div>
                  
                  <div class="image-content">
                          <img src="./img/es.jpg" alt="">
                      </div>
              </div>
          </div>
          <div class="slide">
              <div class="slide-content-wrapper">
                  <div class="tex-content">
                      <h1 class="slide-title">Exciting Activities for Children</h1>
                      <button class="btn--text btn--scroll-to">Notices &DownArrow;</button>
                  </div>
                  
                      <div class="image-content">
                          <img src="./img/es2.jpg" alt="">
                      </div>
              </div>
          </div>
          <div class="slide">
              <div class="slide-content-wrapper">
                  <div class="tex-content">
                      <h1 class="slide-title">Creative Learning Environment</h1>
                      <button class="btn--text btn--scroll-to">Notices &DownArrow;</button>
                  </div>
                  
                  <div class="image-content">
                          <img src="./img/es3.jpg" alt="">
                      </div>
              </div>
          </div>
      </div>
      <div class="social-icons">
          <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
      </div>
      <div class="dots"></div>
    </header>
  
    <section class="section" id="section--1">
      <div class="section__title">
        <h2 class="section__description">Es Muhororo</h2>
        <h3 class="section__header">
          A Journey to success
          for Your school
        </h3>
      </div>

      
      <div class="notices">
    <img src="img/es.jpg" alt="student" class="notices__img lazy-img" />
    <div class="notices__notice">
        <h5 class="notices__header">
            Notice Board
        </h5>
        <?php foreach ($notices as $notice) { ?>
            <p><a href="notice_details.php?id=<?php echo $notice['Id']; ?>"><?php echo htmlentities($notice['noticeTitle']); ?></a></p>
        <?php } ?>
    </div>
</div>

    </section>

    <section class="section" id="section--2">
      <div class="section__title section__title--testimonials">
        <h3 class="section__header">
          Our Wonderful Teachers
        </h3>
      </div>

      <div class="testimonials-container">
        
          <div class="testimonial">
            <h5 class="testimonial__header">Founder, Center Director</h5>
            <blockquote class="testimonial__text">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusantium quas quisquam non? Quas voluptate nulla minima
              deleniti optio ullam nesciunt, numquam corporis et asperiores
              laboriosam sunt, praesentium suscipit blanditiis. Necessitatibus
              id alias reiciendis, perferendis facere pariatur dolore veniam
              autem esse non voluptatem saepe provident nihil molestiae.
            </blockquote>
            <address class="testimonial__author">
              <img src="img/anim1.jpg" alt="" class="testimonial__photo"/>
              <h6 class="testimonial__name">didier</h6>
              <p class="testimonial__location">Rwanda, Kigali-city</p>
            </address>
          </div>
        
          <div class="testimonial">
            <h5 class="testimonial__header">Lead Teacher</h5>
            <blockquote class="testimonial__text">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusantium quas quisquam non? Quas voluptate nulla minima
              deleniti optio ullam nesciunt, numquam corporis et asperiores
              laboriosam sunt, praesentium suscipit blanditiis. Necessitatibus
              id alias reiciendis, perferendis facere pariatur dolore veniam
              autem esse non voluptatem saepe provident nihil molestiae.
            </blockquote>
            <address class="testimonial__author">
              <img src="img/anim2.jpg" alt="" class="testimonial__photo"/>
              <h6 class="testimonial__name">prosper</h6>
              <p class="testimonial__location">Rwanda, Kigali-city</p>
            </address>
          </div>
        
          <div class="testimonial">
            <h5 class="testimonial__header">Assistant Teacher</h5>
            <blockquote class="testimonial__text">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusantium quas quisquam non? Quas voluptate nulla minima
              deleniti optio ullam nesciunt, numquam corporis et asperiores
              laboriosam sunt, praesentium suscipit blanditiis. Necessitatibus
              id alias reiciendis, perferendis facere pariatur dolore veniam
              autem esse non voluptatem saepe provident nihil molestiae.
            </blockquote>
            <address class="testimonial__author">
              <img src="img/anim3.jpg" alt="" class="testimonial__photo"/>
              <h6 class="testimonial__name">frank</h6>
              <p class="testimonial__location">Rwanda, Kigali-city</p>
            </address>
          </div>
        

        
          <div class="testimonial">
            <h5 class="testimonial__header">Family Support Specialist</h5>
            <blockquote class="testimonial__text">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Accusantium quas quisquam non? Quas voluptate nulla minima
              deleniti optio ullam nesciunt, numquam corporis et asperiores
              laboriosam sunt, praesentium suscipit blanditiis. Necessitatibus
              id alias reiciendis, perferendis facere pariatur dolore veniam
              autem esse non voluptatem saepe provident nihil molestiae.
            </blockquote>
            <address class="testimonial__author">
              <img src="img/anim4.jpg" alt="" class="testimonial__photo"/>
              <h6 class="testimonial__name">hertillan</h6>
              <p class="testimonial__location">Rwanda, Kigali-city</p>
            </address>
          </div>
       
          
      </div>
    </section>
    
    <section class="section section--info">
      <div class="section__title">
        <h3 class="section__header">
          Discover the Benefits of Our Student Result Management System
        </h3>
      </div>
      
      <div class="info__content">
        <div class="info__features">
          <h4>Key Features</h4>
          <ul>
            <li><i class="fas fa-check"></i> Real-time grade tracking</li>
            <li><i class="fas fa-check"></i> Performance analysis and insights</li>
            <li><i class="fas fa-check"></i> Automated report generation</li>
          </ul>
        </div>
        
        <div class="info__how-it-works">
          <h4>How It Works</h4>
          <p>Using our system is easy! Just follow these steps:</p>
          <ol>
            <li>Log in to your student account</li>
            <li>View your latest academic results</li>
            <li>Access detailed performance reports</li>
          </ol>
        </div>
        
        <div class="info__benefits">
          <h4>Benefits for Students</h4>
          <ul>
            <li>Stay updated with your academic progress</li>
            <li>Identify strengths and areas for improvement</li>
            <li>Track your performance over time</li>
          </ul>
        </div>
      </div>
      
      <div class="info__cta">
        <p>Ready to experience the power of our system?</p>
        <a href="#" class="btn btnc btn--show-student-portal-modal">Get Started</a>
      </div>
    </section>
    
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
    <div class="modal hidden">
        <button class="btn--close-modal">&times;</button>
        <h2 class="modal__header"> 
          Admin Portal
        </h2>
        <form action="loginProcess.php" method="post" class="modal__form" id="login-form">
          <div class="input-container">
            <input type="email" name="username" id="email" required>
            <label for="email">Email Address</label>
          </div>
          
          <div class="input-container">
            <input type="password" name="password" id="password" spellcheck="false" required>
            <label for="password" id="password-label">Password</label>
            <i id="password-toggle" class="fa-regular fa-eye-slash toggle"></i>
          </div>
          <div style="font-size: 13px; color: #cc0000; margin-top: 10px;" id="error-message"></div>
          <button class="btn">Login &rarr;</button>
        </form>
      </div>
      <div class="overlay hidden"></div>


      <div class="modal1 hidden1">
        <button class="btn--close-student-portal-modal">&times;</button>
        <h2 class="modal__header">
          Student portal <br />
        </h2>
        <form class="modal__form" id="access-form" action="get-student.php" method="post">
    <div class="input-container">
        <input type="text" name="reg_id" id="reg_id" required>
        <label>Reg ID</label>
    </div>
    <div class="flex">
        <div class="select-wrapper">
            <label>Class</label>
            <select name="class" id="class" required>
                <option value="">Select Class</option>
                <?php 
                    foreach ($classData as $classId => $classInfo) {
                        list($className, $section) = explode(' - ', $classInfo);
                        echo "<option value='$classId'>$className - $section</option>";
                    }
                ?>
            </select>
        </div>
        
        <button type="submit" class="btn">Search &rarr;</button>
    </div>
</form>
<div id="result"></div>
      </div>
      <div class="overlay1 hidden1"></div>
   
      <button class="btn--scroll-to-top"><i class="fas fa-arrow-up"></i></button>

      <button class="prev-btn">Previous</button>
    <button class="next-btn">Next</button>

    <script>
  document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const errorMessage = document.getElementById("error-message");

    loginForm.addEventListener("submit", function (event) {
      event.preventDefault(); 

      const emailInput = document.getElementById("email");
      const passwordInput = document.getElementById("password");

      const myusername = emailInput.value;
      const mypassword = passwordInput.value;
      

      
      errorMessage.textContent = "";

      
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "loginProcess.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          console.log(response);
          if (response.success) {
            
            window.location.href = "dashboard.php";
          } else {
            
            errorMessage.textContent = response.message;
          }
        }
      };

      
      xhr.onerror = function () {
        errorMessage.textContent = "An error occurred while processing your request.";
      };

      
      const params = `username=${encodeURIComponent(myusername)}&password=${encodeURIComponent(mypassword)}`;
      xhr.send(params);
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    const accessForm = document.getElementById("access-form");
    const resultDiv = document.getElementById("result");

    accessForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const regId = document.getElementById("reg_id").value;
        const selectedClass = document.getElementById("class").value;

        fetch("get-student.php", {
            method: "POST",
            body: new FormData(accessForm),
        })
            .then((response) => response.json())
            .then((data) => {
    
                resultDiv.innerHTML = data.message;
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});

</script>

  </body>
</html>
