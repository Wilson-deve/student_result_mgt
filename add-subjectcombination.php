<?php include('includes/session.php'); ?>


<?php include('includes/sidebar.php');?>

    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-book"></i>
                    <span class="text">Add Subject Combination</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Subjects</a></li>/
                            <li><a href="#">Add Subject Combination</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">Add Subject Combination</span>
                </div>

                <?php
                   if (isset($_GET['error'])) {
                    $error_code = $_GET['error'];
                    switch ($error_code) {
                        case 1:
                            $error_message = "Error adding subject combination. Please try again.";
                            break;
                        case 2:
                            $error_message = "Duplicate subject combination. This combination already exists.";
                            break;
                        // Add more error cases if needed
                        default:
                            $error_message = "An error occurred.";
                    }
                    echo '<div class="message error">' . $error_message . '</div>';
                } elseif (isset($_GET['success']) && $_GET['success'] == 1) {
                    echo '<div class="message success">Subject combination added successfully!</div>';
                }
                ?>
       

                <div class="activity-data">
                    <div class="form-box">
                        <form class="data-form" method="post" action="process-subject-combination.php">
                            <label for="class">Class</label><br>
                            <select name="class" id="default" required>
                                <option value="">Select Class</option>
                                <?php 
                                $sql = "SELECT Id, ClassName, Section FROM tblclasses";
                                $result = mysqli_query($con, $sql);

                                if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $row['Id'] . "'>" . $row['ClassName'] . " - " . $row['Section'] . "</option>";
                                        }
                                }
                                ?>
                            </select>

                            <label for="subject">Subject</label><br>
                            <select name="subject" id="default" required>
                                <option value="">Select Subject</option>
                                <?php 
                                    $sql = "SELECT Id, SubjectName FROM tblsubjects";
                                    $result = mysqli_query($con, $sql);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $row['Id'] . "'>" . $row['SubjectName'] . "</option>";
                                        }
                                    }
                                ?>
                            </select>


            
                            <button type="submit" name="submit" class="btn">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php');?>
    <script src="./js/jquery-3.7.0.min.js"></script>
</body>
</html>