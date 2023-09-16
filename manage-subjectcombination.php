<?php 
    include('includes/session.php'); 
    include('includes/sidebar.php');

    $subjectCombination = [];

    $sql = "SELECT sc.Id, c.ClassName, c.Section, s.SubjectName, sc.Status
            FROM tblsubjectcombination sc
            INNER JOIN tblclasses c ON sc.ClassId = c.Id
            INNER JOIN tblsubjects s ON sc.SubjectId = s.Id
            ORDER BY sc.CreationDate DESC";
    
    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $subjectCombination[] = $row;
        }
    }

    mysqli_close($con);
?>



    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-book"></i>
                    <span class="text">Manage Subjects Combination</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Subjects</a></li>/
                            <li><a href="#">Manage Subjects Combination</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">View Subjects Combination Info</span>
                </div>

             
                <div class="activity-data">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class and Section</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php 
                                $counter =  mysqli_num_rows($result);;
                                foreach ($subjectCombination as $combination) : 
                           ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><?php echo $combination['ClassName'] . ' - ' . $combination['Section']; ?></td>
                                <td><?php echo $combination['SubjectName']; ?></td>
                                <td><?php echo $combination['Status']; ?></td>
                                <td>
                                    <?php if ($combination['Status'] === 'Active') : ?>
                                        <a href="deactivate-subject-combination.php?id=<?php echo $combination['Id']; ?>"><i class="fa fa-times" title="Deactivate Record"></i></a>
                                    <?php else : ?>
                                        <a href="activate-subject-combination.php?id=<?php echo $combination['Id']; ?>"><i class="fa fa-check" title="Activate Record"></i></a>
                                    <?php endif; ?> 
                                </td>
                            </tr>
                            <?php 
                                $counter--;
                                endforeach;  
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