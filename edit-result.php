<?php
include('includes/session.php');
include('includes/sidebar.php');

// Check if a result ID is provided in the URL
if (isset($_GET['result_id'])) {
    $result_id = $_GET['result_id'];


    $sql = "SELECT r.Id, r.marks, c.ClassName, s.StudentName
            FROM tblresult r
            INNER JOIN tblclasses c ON r.ClassId = c.id
            INNER JOIN tblstudents s ON r.StudentId = s.Id
            WHERE r.Id = ?";

    // Prepare the statement
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $result_id);
        $stmt->execute();
        $stmt->bind_result($result_id, $marks, $className, $studentName);

        // Fetch the result (there's no need to fetch subject_id here)
        $stmt->fetch();

        $stmt->close();
    } else {
        echo "Failed to prepare the statement.";
    }

    if (isset($result_id)) {
        // Fetch subject names and current marks from tblresult
        $subjectData = array();
        $subjectSql = "SELECT SubjectId, marks FROM tblresult WHERE Id = ?";
        $stmt = $con->prepare($subjectSql);

        if ($stmt) {
            $stmt->bind_param("i", $result_id);
            $stmt->execute();
            $stmt->bind_result($subjectId, $subjectMark);

            while ($stmt->fetch()) {
                $subjectData[$subjectId] = $subjectMark;
            }

            $stmt->close();
        } else {
            echo "Failed to prepare the subject statement.";
        }

        // Fetch subject names for the student based on tblsubjectcombination
        $class_id = 1; 
        $subjectNames = array();
        $subjectSql = "SELECT s.SubjectName
                        FROM tblsubjectcombination sc
                        INNER JOIN tblsubjects s ON sc.SubjectId = s.Id
                        WHERE sc.ClassId = ?";
        $stmt = $con->prepare($subjectSql);

        if ($stmt) {
            $stmt->bind_param("i", $class_id); 
            $stmt->execute();
            $stmt->bind_result($subjectName);

            while ($stmt->fetch()) {
                $subjectNames[] = $subjectName;
            }

            $stmt->close();
        } else {
            echo "Failed to prepare the subject statement.";
        }

        if (isset($_POST['update'])) {
            $subjectMarks = $_POST['subject_marks'];

            // Update the marks for each subject in the database
            foreach ($subjectMarks as $subjectId => $newMarks) {
                $updateSql = "UPDATE tblresult SET marks = ? WHERE Id = ? AND SubjectId = ?";
                $updateQuery = $con->prepare($updateSql);
                $updateQuery->bind_param("dii", $newMarks, $result_id, $subjectId);

                if ($updateQuery->execute()) {
                    $message = "Result updated successfully";
                } else {
                    $error = "Error updating result";
                }
            }
        }
    } else {
        // Result with the given ID was not found
        $error = "Result not found";
    }
} else {
    // Result ID not provided in the URL
    $error = "Result ID not specified";
}
?>





<section class="dashboard">
    <?php include('includes/topbar.php');?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="fa fa-file-text"></i>
                <span class="text">Edit Result</span>
            </div>
            <div class="link-menu">
                <div class="link-item">
                    <ul>
                        <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                        <li><a href="#">Results</a></li>/
                        <li><a href="#">Edit Result</a></li>
                    </ul>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">Edit Result</span>
                </div>

                <?php if (isset($error)) { ?>
                    <div id="message" class="error-message" style="font-size: 13px; color: #cc0000; margin-top: 10px;"><?php echo htmlentities($error); ?></div>
                <?php } elseif (isset($message)) { ?>
                    <div id="message" class="success-message" style="font-size: 13px; color: #00cc00; margin-top: 10px;"><?php echo htmlentities($message); ?></div>
                <?php } ?>

                <div class="activity-data">
                    <div class="form-box">
                    <?php if (isset($result_id)) { ?>
                    <form class="data-form" method="post">
                        <label for="class">Class</label><br>
                        <input type="text" name="class" value="<?php echo htmlentities($className); ?>" disabled><br>

                        <label for="student">Student Name</label><br>
                        <input type="text" name="student" value="<?php echo htmlentities($studentName); ?>" disabled><br>

                        <?php foreach ($subjectNames as $subjectName) { ?>
                            <div class="form-group">
                                <label for="<?php echo htmlentities($subjectName); ?>"><?php echo htmlentities($subjectName); ?></label><br>
                                <input type="text" name="subject_marks[<?php echo htmlentities($subjectId); ?>]" 
                                value="<?php echo htmlentities($subjectData[$subjectId]); ?>" required><br>
                            </div>
                        <?php } ?>

                        <button type="submit" name="update" class="btn">Update Result</button>
                    </form>
                    <?php } ?>

                    </div>
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
            }, 5000); 
        }
    }

    
    window.onload = hideMessage;
</script>
</body>
</html>
