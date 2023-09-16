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
                    <i class="fa fa-file-text"></i>
                    <span class="text">Declare Result</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Result</a></li>/
                            <li><a href="#">Add Student Results</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <!-- <span class="text">Declare Result</span> -->
                </div>

                <?php
                    if (isset($_GET['message'])) {
                    $message = $_GET['message'];
    
                    echo "<div id='message' style='font-size: 13px; color: #00cc00; margin-top: 10px;'>$message</div>";
                    }
                ?>

                <div class="activity-data">
                    <div class="form-box">
                        <form class="data-form" action="process-result.php" method="post">
                            <label for="">Class</label><br>
                            <select name="class" id="classId" required  onchange="getSubjectsByClass()">
                                <option value="">Select Class</option>
                                    <?php 
                                            foreach ($classData as $classId => $classInfo) {
                                                list($className, $section) = explode(' - ', $classInfo);
                                                echo "<option value='$classId'>$className - $section</option>";
                                            }
                                    ?>
                            </select>

                            <label for="">Student Name</label><br>
                            <select name="studentid" id="studentId" required>
                                <option value=""></option>
                            </select>

                            <label for="">Subjects and Marks</label><br>
                            <div id="subjectFields">

                            </div>
            
                            <button type="submit" class="btn" name="submit" id="submit">Declare Result</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php');?>
    <script src="./js/jquery-3.7.0.min.js"></script>
    
    <script>
  
    function getSubjectsByClass() {
        let classId = document.getElementById("classId").value;
        let studentDropdown = document.getElementById("studentId");
        let subjectFields = document.getElementById("subjectFields");

        // Clear the existing student options and subject input fields
        studentDropdown.innerHTML = '<option value="">Select Student</option>';
        subjectFields.innerHTML = '';

        // Check if a class is selected
        if (classId !== "") {
            // Make an AJAX request to fetch students and subjects for the selected class
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "get-students-and-subjects.php", true); 
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let data = JSON.parse(xhr.responseText);

                    // Populate the student dropdown with fetched student data
                    for (let i = 0; i < data.students.length; i++) {
                        let studentId = data.students[i].StudentId;
                        let studentName = data.students[i].StudentName;
                        let option = document.createElement("option");
                        option.value = studentId;
                        option.textContent = studentName;
                        studentDropdown.appendChild(option);
                    }

                    // Create input fields for each subject
                    for (let j = 0; j < data.subjects.length; j++) {
                        let subjectId = data.subjects[j].SubjectId;
                        let subjectName = data.subjects[j].SubjectName;
                        let label = document.createElement("label");
                        label.textContent = subjectName;
                        let input = document.createElement("input");
                        input.type = "text";
                        input.name = "marks[]"; // Use an array for marks to group them by subject
                        input.placeholder = "Enter marks for " + subjectName + " out of 100";
                        // input.setAttribute("data-subject-id", subjectId);

                        // Check if this subject is selected
    if (subjectId !== "") {
        input.setAttribute("data-subject-id", subjectId);
    }

                        // Append the label and input field to the subjectFields div
                        subjectFields.appendChild(label);
                        subjectFields.appendChild(input);
                    }
                }
            };

            // Send the classId as a POST parameter to your PHP script
            let params = "classId=" + classId;
            xhr.send(params);
        }
}

function hideMessage() {
        var messageContainer = document.getElementById("message");
        if (messageContainer) {
            setTimeout(function() {
                messageContainer.style.display = "none";
            }, 5000); 
        }
    }

    // Call the hideMessage function when the page loads
    window.onload = hideMessage;

</script>
</body>
</html>