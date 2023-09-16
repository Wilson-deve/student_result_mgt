<?php 
    include('includes/session.php');
    include('includes/sidebar.php');

    $sql = "SELECT * FROM tblsubjects ORDER BY CreationDate DESC";
    $result = mysqli_query($con, $sql);

    // Check if the "Delete" link is clicked
    if (isset($_GET['delete_id'])) {
        $classIdToDelete = $_GET['delete_id'];

        
        echo "<script>
            if (confirm('Are you sure you want to delete this subject?')) {
                window.location.href = 'delete-subject.php?subject_id=$classIdToDelete';
            } else {
                window.location.href = 'manage-subjects.php'; // Redirect back to the page
            }
            </script>";
        }
?>



    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-book"></i>
                    <span class="text">Manage Subjects</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Subjects</a></li>/
                            <li><a href="#">Manage Subjects</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">View Subjects Info</span>
                </div>

                <div class="activity-data">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th>Creation Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                           $totalRows = mysqli_num_rows($result);
                              $rowNumber = $totalRows;
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $rowNumber . "</td>";
                                echo "<td>" . $row['SubjectName'] . "</td>";
                                echo "<td>" . $row['SubjectCode'] . "</td>";
                                echo "<td>" . $row['CreationDate'] . "</td>";
                                echo "<td>";
                                echo "<a href='edit-subject.php?subject_id=" . $row['Id'] . "' class='edit'><i class='fa fa-edit'></i></a>";
                                echo "<a href='manage-subjects.php?delete_id=" . $row['Id'] . "' class='delete'><i class='fa fa-trash'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                                $rowNumber--;
                              }  
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php');?>
    <script src="./js/jquery-3.7.0.min.js"></script>
</body>
</html>