<?php 
    include('includes/session.php');
    include('includes/sidebar.php');

    $message = '';


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Validate and sanitize user input
        $subjectname = filter_input(INPUT_POST, 'subjectname', FILTER_SANITIZE_STRING);
        $subjectcode = filter_input(INPUT_POST, 'subjectcode', FILTER_SANITIZE_STRING);
    
        if ($subjectname === false || $subjectcode === false) {
            // Handle validation errors here, e.g., display an error message to the user.
            $errorMessage = "Invalid input data. Please check your input.";

        } else {
    
            $con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
    
            // SQL query with prepared statement to prevent SQL injection
            $sql = "INSERT INTO tblsubjects (SubjectName, SubjectCode, CreationDate) VALUES (?, ?, CURRENT_TIMESTAMP)";
            $stmt = $con->prepare($sql);
    
            if ($stmt) {
                $stmt->bind_param("ss", $subjectname, $subjectcode);
                if ($stmt->execute()) {
                    // Successful insertion
                    $successMessage =  "Record created successfully";
                } else {
                    // Handle database error
                    $errorMessage = "Error: " . $stmt->error;
                }
    
                $stmt->close();
            } else {
                // Handle statement preparation error
                $errorMessage = "Error preparing statement: " . $conn->error;
            }
    
            $con->close();
        }
    }

?>

    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-book"></i>
                    <span class="text">Subject Creation</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Subjects</a></li>/
                            <li><a href="#">Create Subject</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">Create Subject</span>
                </div>

                <div class="activity-data">
                    <div class="form-box">
                        <form class="data-form"  action="" method="post">
                                <?php if (isset($errorMessage)) : ?>
                                    <div id="message" class="error-message" style="font-size: 13px; color: #cc0000; margin-top: 10px;"><?php echo $errorMessage; ?></div>
                                <?php endif; ?>

                                <?php if (isset($successMessage)) : ?>
                                    <div id="message" class="success-message" style="font-size: 13px; color: #00cc00; margin-top: 10px;"><?php echo $successMessage; ?></div>
                                <?php endif; ?>
                            <label for="">Subject Name:</label><br>
                            <input type="text" id="default" name="subjectname" placeholder=" Subject Name" required><br>

                            <label for="">Subject Code:</label><br>
                            <input type="text" id="default" name="subjectcode" placeholder="Subject Code" required><br>
            
                            <button type="submit" class="btn" name="submit">Submit</button>
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