
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
$counter = mysqli_num_rows($result); 

while ($row = $result->fetch_assoc()) {
$row['Counter'] = $counter; 
$results[] = $row;
$counter--; 
}
    
    
$sql = "SELECT COUNT(*) AS studentCount FROM tblstudents";
$result = mysqli_query($con, $sql);


$studentCount = 0;

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $studentCount = $row['studentCount'];
}

$sql = "SELECT COUNT(*) AS subjectCount FROM tblsubjects";
$result = mysqli_query($con, $sql);


$subjectCount = 0;

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $subjectCount = $row['subjectCount'];
}

$sql = "SELECT COUNT(*) AS classCount FROM tblclasses";
$result = mysqli_query($con, $sql);


$classCount = 0;

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $classCount = $row['classCount'];
}

$sql = "SELECT COUNT(*) AS resultCount FROM tblresult";
$result = mysqli_query($con, $sql);


$resultCount = 0;

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $resultCount = $row['resultCount'];
}

    ?>



    <section class="dashboard">
        
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-dashboard"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="fa fa-users"></i>
                        <div class="span text">Registered Students</div>
                        <div class="span number"><?php echo $studentCount; ?></div>
                    </div>
                    <div class="box box2">
                        <i class="fa fa-ticket"></i>
                        <div class="span text">Subjects Listed</div>
                        <div class="span number"><?php echo $subjectCount; ?></div>
                    </div>
                    <div class="box box3">
                        <i class="fa fa-bank"></i>
                        <div class="span text">Total classes listed</div>
                        <div class="span number"><?php echo $classCount; ?></div>
                    </div>
                    <div class="box box4">
                        <i class="fa fa-file-text"></i>
                        <div class="span text">Result Declared</div>
                        <div class="span number"><?php echo $resultCount; ?></div>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="fa-regular fa-clock"></i>
                    <span class="text">Recent declared Results</span>
                </div>

                <div class="activity-data">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Reg ID</th>
                                <th>Class</th>
                                <th>Registration Date</th>
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