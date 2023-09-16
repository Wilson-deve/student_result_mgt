<?php 
    include('includes/session.php');
    include('includes/sidebar.php');
    
    $message = '';
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




    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-users"></i>
                    <span class="text">Student Admission</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Student</a></li>/
                            <li><a href="#">Student Admission</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <!-- <span class="text">Fill the Student info</span> -->
                </div>
                <?php
                    if (isset($_GET['message'])) {
                    $message = $_GET['message'];
    
                    echo "<div id='message' style='font-size: 13px; color: #00cc00; margin-top: 10px;'>$message</div>";
                    }
                ?>

                <div class="activity-data">
                    <div class="form-box">
                        <h1 class="form-title">Fill the Student info</h1>
                        <form class="data-form" action="process-student-admission.php" method="post">
                            <div class="main-user-info">
                                <div class="user-input-box">
                                  <label for="">Full Name</label>
                                  <input type="text"
                                          id="fullName"
                                          name="fullName"
                                          autocomplete="off"
                                          required/>
                                </div>
                                <div class="user-input-box">
                                  <label for="">Reg Id</label>
                                  <input type="text"
                                          id="rollid"
                                          name="rollid"
                                          autocomplete="off"
                                          required/>
                                </div>
                                <div class="user-input-box">
                                  <label for="">Email</label>
                                  <input type="email"
                                          id="email"
                                          name="emailid"
                                          autocomplete="off"
                                          required/>
                                </div>
                                <div class="user-input-box">
                                  <label for="">Class</label>
                                  <select name="class" id="default" required>
                                    <option value="">Select Class</option>
                                    <?php 
                                        foreach ($classData as $classId => $classInfo) {
                                            list($className, $section) = explode(' - ', $classInfo);
                                            echo "<option value='$classId'>$className - $section</option>";
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="user-input-box">
                                  <label for="date">Date Of Birth</label>
                                  <input type="date"
                                          id="date"
                                          name="dob"
                                          />
                                </div>
                            
                                <div class="gender-details-box">
                                    <span class="gender-title">Gender</span>
                                    <div class="gender-category">
                                      <input type="radio" name="gender" id="male" value="Male" checked="" required>
                                      <label for="male">Male</label>
                                      <input type="radio" name="gender" id="female" value="Female" required>
                                      <label for="female">Female</label>
                                      <input type="radio" name="gender" id="other" value="Other" required>
                                      <label for="other">Other</label>
                                    </div>
                                  </div>
                              </div>
        
                            <button type="submit" class="btn" name="submit">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php');?>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script>
        function hideMessage() {
        var messageContainer = document.getElementById("message");
        if (messageContainer) {
            setTimeout(function() {
                messageContainer.style.display = "none";
            }, 5000); // 5000 milliseconds (5 seconds)
        }
    }

    // Call the hideMessage function when the page loads
    window.onload = hideMessage;
    </script>
</body>
</html>