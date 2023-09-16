<?php 
    include('includes/session.php');
    include('includes/sidebar.php'); 

    $sql = "SELECT * FROM tblclasses ORDER BY CreationDate DESC";
    $result = mysqli_query($con, $sql);


    // Check if the "Delete" link is clicked
        if (isset($_GET['delete_id'])) {
            $classIdToDelete = $_GET['delete_id'];

            
            echo "<script>
                if (confirm('Are you sure you want to delete this class?')) {
                    window.location.href = 'delete-class.php?class_id=$classIdToDelete';
                } else {
                    window.location.href = 'manage-classes.php'; // Redirect back to the page
                }
                </script>";
            }
?>



    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-bank"></i>
                    <span class="text">Manage Classes</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Classes</a></li>/
                            <li><a href="#">Manage Classes</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">View Classes Info</span>
                </div>

                <div class="activity-data">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Name</th>
                                <th>Level</th>
                                <th>Section</th>
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
                                echo "<td>" . $row['ClassName'] . "</td>";
                                echo "<td>" . $row['Level'] . "</td>";
                                echo "<td>" . $row['Section'] . "</td>";
                                echo "<td>" . $row['CreationDate'] . "</td>";
                                echo "<td>";
                                echo "<a href='edit-class.php?class_id=" . $row['Id'] . "' class='edit'><i class='fa fa-edit'></i></a>";
                                echo "<a href='manage-classes.php?delete_id=" . $row['Id'] . "' class='delete'><i class='fa fa-trash'></i></a>";
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