<?php 
    include('includes/session.php');
    include('includes/sidebar.php');
    
    if (isset($_GET['student_id'])) {
        $studentId = $_GET['student_id'];
    
        // Retrieve student information based on the student ID
        $sql = "SELECT *, DATE_FORMAT(UpdationDate, '%Y-%m-%d %H:%i:%s') AS FormattedUpdationDate FROM tblstudents WHERE Id = ?";
        $stmt = $con->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $studentId);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $studentData = $result->fetch_assoc();
            } else {
                // Handle database error
                // You can redirect or display an error message here
                $errorMessage = "Database error";
            }
            $stmt->close();
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        // Handle student update form submission here
    
        $fullName = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_STRING);
        $rollId = filter_input(INPUT_POST, 'rollid', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_EMAIL);
        $classId = filter_input(INPUT_POST, 'class', FILTER_VALIDATE_INT);
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
    
        if ($fullName === false || $rollId === false || $email === false || $classId === false) {
            // Handle validation errors here
            // You can redirect or display an error message
            $errorMessage = "Invalid input data. Please check your input.";
        } else {
            // Get the current timestamp for UpdationDate
            $updationDate = date("Y-m-d H:i:s");
    
            // Update the student information in the database, including UpdationDate
            $sql = "UPDATE tblstudents SET StudentName = ?, RollId = ?, StudentEmail = ?, Gender = ?, DOB = ?, ClassId = ?, UpdationDate = ? WHERE Id = ?";
            $stmt = $con->prepare($sql);
    
            if ($stmt) {
                $stmt->bind_param("sssssssi", $fullName, $rollId, $email, $gender, $dob, $classId, $updationDate, $studentId);
                if ($stmt->execute()) {
                    // Successful update
                    // You can redirect or display a success message
                    $successMessage = "Data has been updated successfully";
                } else {
                    // Handle database error
                    // You can redirect or display an error message
                    $errorMessage = "Something went wrong. Try again!";
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
                <i class="fa fa-users"></i>
                <span class="text">Student Admission</span>
            </div>
            <div class="link-menu">
                <div class="link-item">
                    <ul>
                        <li><i class="uil uil-estate"></i><a href="dashboard.html">Home</a></li>/
                        <li><a href="#">Student</a></li>/
                        <li><a href="#">Student Admission</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="activity">
            <div class="title">
                <!-- <i class="uil uil-clock-three"></i> -->
                <!-- <span class="text">Fill the Student info</span> -->
            </div>

            <div class="activity-data">
                <div class="form-box">
                    <h1 class="form-title">Fill the Student info</h1>
                    <form class="data-form" action="" method="post">
                        <div class="main-user-info">
                            <div class="user-input-box">
                                <label for="fullName">Full Name</label>
                                <input type="text"
                                    id="fullName"
                                    name="fullName"
                                    autocomplete="off"
                                    value="<?php echo $studentData['StudentName']; ?>"
                                    required/>
                            </div>
                            <div class="user-input-box">
                                <label for="rollid">Reg Id</label>
                                <input type="text"
                                    id="rollid"
                                    name="rollid"
                                    autocomplete="off"
                                    value="<?php echo $studentData['RollId']; ?>"
                                    required/>
                            </div>
                            <div class="user-input-box">
                                <label for="emailid">Email</label>
                                <input type="email"
                                    id="emailid"
                                    name="emailid"
                                    autocomplete="off"
                                    value="<?php echo $studentData['StudentEmail']; ?>"
                                    required/>
                            </div>
                            <div class="user-input-box">
                                <label for="class">Class</label>
                                <select name="class" id="default" required>
                                    <option value="">Select Class</option>
                                    <?php
                                        // Assume you have a database connection established earlier

                                        // Query to retrieve classes from your database
                                        $classQuery = "SELECT Id, CONCAT(ClassName, ' - ', Section) AS ClassSection FROM tblclasses";

                                        // Execute the query
                                        $classResult = mysqli_query($con, $classQuery);

                                        // Check for query execution success
                                        if ($classResult) {
                                            while ($classRow = mysqli_fetch_assoc($classResult)) {
                                                $classId = $classRow['Id'];
                                                $classSection = $classRow['ClassSection'];

                                                // Check if the current class matches the student's class
                                                $selected = ($classId == $studentData['ClassId']) ? 'selected' : '';

                                                // Output an option element for each class and section
                                                echo "<option value='$classId' $selected>$classSection</option>";
                                            }

                                            // Free the result set
                                            mysqli_free_result($classResult);
                                        } else {
                                            // Handle database query error
                                            echo "Error: " . mysqli_error($con);
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="user-input-box">
                                <label for="dob">Date Of Birth</label>
                                <input type="date"
                                    id="dob"
                                    name="dob"
                                    value="<?php echo $studentData['DOB']; ?>"
                                    />
                            </div>
                            
                            <div class="gender-details-box">
                                <span class="gender-title">Gender</span>
                                <div class="gender-category">
                                    <input type="radio" name="gender" id="male" value="Male" <?php if ($studentData['Gender'] === 'Male') echo 'checked'; ?> required>
                                    <label for="male">Male</label>
                                    <input type="radio" name="gender" id="female" value="Female" <?php if ($studentData['Gender'] === 'Female') echo 'checked'; ?> required>
                                    <label for="female">Female</label>
                                    <input type="radio" name="gender" id="other" value="Other" <?php if ($studentData['Gender'] === 'Other') echo 'checked'; ?> required>
                                    <label for="other">Other</label>
                                </div>
                            </div>
                        </div>
        
                        <button type="submit" class="btn" name="update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer.php'); ?>
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
