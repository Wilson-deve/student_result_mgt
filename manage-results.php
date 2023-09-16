<?php 
    include('includes/session.php');
    include('includes/sidebar.php');
    
    
    $sql = "SELECT
            tblresult.Id,
            tblstudents.StudentName,
            tblstudents.RollId,
            CONCAT(tblclasses.ClassName, ' - ', tblclasses.Section) AS Class,
            tblstudents.RegDate
        FROM
            tblresult
        INNER JOIN tblstudents ON tblresult.StudentId = tblstudents.Id
        INNER JOIN tblclasses ON tblresult.ClassId = tblclasses.id
        ORDER BY tblstudents.StudentName ASC, tblresult.PostingDate DESC";

 

$result = $con->query($sql);
$results = [];
$counter = mysqli_num_rows($result); // Initialize the counter

while ($row = $result->fetch_assoc()) {
    $row['Counter'] = $counter; // Add a counter value to the row
    $results[] = $row;
    $counter--; // Increment the counter
}


?>



    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-file-text"></i>
                    <span class="text">Manage Results</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Results</a></li>/
                            <li><a href="#">Manage Results</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">View Student Results Info</span>
                </div>

                <div class="activity-data">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Reg Id</th>
                                <th>Class</th>
                                <th>Reg Date</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row) {?>
                                <tr>
                                    <td><?php echo htmlentities($row['Counter']); ?></td>
                                    <td><?php echo htmlentities($row['StudentName']); ?></td>
                                    <td><?php echo htmlentities($row['RollId']); ?></td>
                                    <td><?php echo htmlentities($row['Class']); ?></td>
                                    <td><?php echo htmlentities($row['RegDate']); ?></td>
                                    <td>
                                        <a href='edit-result.php?result_id=<?php echo htmlentities($row['Id']); ?>' class='edit'><i class='fa fa-edit'></i></a>
                                        <a href='delete-result.php?result_id=<?php echo htmlentities($row['Id']); ?>' class='delete' onclick="return confirm('Are you sure you want to delete this result?');"><i class='fa fa-trash'></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
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