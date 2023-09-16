<?php 
    include('includes/session.php');
    include('includes/sidebar.php');
    

    if (isset($_GET['class_id'])) {
        $classId = $_GET['class_id'];
    
        // Retrieve class information based on the class ID
        $sql = "SELECT *, DATE_FORMAT(UpdationDate, '%Y-%m-%d %H:%i:%s') AS FormattedUpdationDate FROM tblclasses WHERE Id = ?";
        $stmt = $con->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $classId);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $classData = $result->fetch_assoc();
            } else {
                // Handle database error
                // You can redirect or display an error message here
                $errorMessage = "database error";
            }
            $stmt->close();
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        // Handle class update form submission here
    
        $classname = filter_input(INPUT_POST, 'classname', FILTER_SANITIZE_STRING);
        $level = filter_input(INPUT_POST, 'level', FILTER_VALIDATE_INT);
        $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
    
        if ($classname === false || $level === false || $section === false) {
            // Handle validation errors here
            // You can redirect or display an error message
            $errorMessage = "Invalid input data. Please check your input.";
        } else {
            // Get the current timestamp for UpdationDate
            $updationDate = date("Y-m-d H:i:s");
    
            // Update the class information in the database, including UpdationDate
            $sql = "UPDATE tblclasses SET ClassName = ?, Level = ?, Section = ?, UpdationDate = ? WHERE Id = ?";
            $stmt = $con->prepare($sql);
    
            if ($stmt) {
                $stmt->bind_param("sissi", $classname, $level, $section, $updationDate, $classId);
                if ($stmt->execute()) {
                    // Successful update
                    // You can redirect or display a success message
                    $successMessage = "Data has been updated successfully";
                } else {
                    // Handle database error
                    // You can redirect or display an error message
                    $errorMessage = "Something went wrong. try again!";
                }
                $stmt->close();
            }
        }
    }
    
?>



    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-bank"></i>
                    <span class="text">Update Student Class</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Classes</a></li>/
                            <li><a href="#">Update Classes</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <!-- <span class="text">Create Student Class</span> -->
                </div>

                <div class="activity-data">
                    <div class="form-box">
                        <!-- <h1 class="form-title">Create Student Class</h1> -->
                        <form class="data-form" action="" method="post">
                                <?php if (isset($errorMessage)) : ?>
                                    <div id="message" class="error-message" style="font-size: 13px; color: #cc0000; margin-top: 10px;"><?php echo $errorMessage; ?></div>
                                <?php endif; ?>

                                <?php if (isset($successMessage)) : ?>
                                    <div id="message" class="success-message" style="font-size: 13px; color: #00cc00; margin-top: 10px;"><?php echo $successMessage; ?></div>
                                <?php endif; ?>
                            <label for="">Class Name:</label><br>
                            <input type="text" id="success" name="classname" value="<?php echo $classData['ClassName']; ?>"  required><br>

                            <label for="">Level:</label><br>
                            <input type="number" id="success" name="level" value="<?php echo $classData['Level']; ?>" required><br>
            
                            <label for="">Section:</label><br>
                            <input type="text" id="success" name="section" value="<?php echo $classData['Section']; ?>" required><br>
            
                            <button type="submit" class="btn" name="update">Update</button>
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
            }, 5000); 
        }
    }

    
    window.onload = hideMessage;
    </script>
</body>
</html>