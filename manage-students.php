<?php 
    include('includes/session.php');
    include('includes/sidebar.php'); 

    // Check if the "Delete" link is clicked
    if (isset($_GET['delete_id'])) {
        $classIdToDelete = $_GET['delete_id'];

        
        echo "<script>
            if (confirm('Are you sure you want to delete this class?')) {
                window.location.href = 'delete-student.php?student_id=$classIdToDelete';
            } else {
                window.location.href = 'manage-students.php'; // Redirect back to the page
            }
            </script>";
        }
?>

    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-users"></i>
                    <span class="text">Manage Students</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Students</a></li>/
                            <li><a href="#">Manage Students</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">View Student Info</span>
                </div>

                <div class="activity-data">
                <?php
                    $sql = "SELECT s.*, c.ClassName, c.Section 
                    FROM tblstudents s
                    LEFT JOIN tblclasses c ON s.ClassId = c.Id ORDER BY c.CreationDate";
                    $result = mysqli_query($con, $sql);
            
                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='data-table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th>Student Name</th>";
                    echo "<th>Reg Id</th>";
                    echo "<th>Class</th>";
                    echo "<th>Reg Date</th>";
                    echo "<th>Action</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    $counter = mysqli_num_rows($result);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . $row['StudentName'] . "</td>";
                        echo "<td>" . $row['RollId'] . "</td>";
                        echo "<td>" . $row['ClassName'] . " - " . $row['Section'] . "</td>";
                        echo "<td>" . $row['RegDate'] . "</td>";
                        echo "<td>";
                        echo "<a href='edit-student.php?student_id=" . $row['Id'] . "' class='edit'><i class='fa fa-edit'></i></a>";
                        echo "<a href='manage-students.php?delete_id=" . $row['Id'] . "' class='delete'><i class='fa fa-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";

                        $counter--;
                    }
                
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    // No student records found
                    echo "<p>No student records found.</p>";
                }
            
            // Close the database connection
            mysqli_close($con);
                ?>
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php');?>
    <script src="./js/jquery-3.7.0.min.js"></script>
</body>
</html>