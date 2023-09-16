<?php
include('includes/session.php');
include('includes/sidebar.php');


$sql = "SELECT * FROM tblnotice"; 
$result = mysqli_query($con, $sql);

$notices = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $notices[] = $row;
    }
}

?>

    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-bell"></i>
                    <span class="text">Manage Notices</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Notice</a></li>/
                            <li><a href="#">Manage Notices</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <span class="text">View Notices Info</span>
                </div>

                <div class="activity-data">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Notice Title</th>
                                <th>Notice Details</th>
                                <th>Creation Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $counter = mysqli_num_rows($result); foreach ($notices as $notice) { ?>
                            <tr>
                                <td><?php echo htmlentities($counter); ?></td>
                                <td><?php echo htmlentities($notice['noticeTitle']); ?></td>
                                <td><?php echo htmlentities($notice['noticeDetails']); ?></td>
                                <td><?php echo htmlentities($notice['postingDetails']); ?></td>
                                <td>
                                    <a href='edit-notice.php?notice_id=<?php echo $notice['Id']; ?>' class='edit'><i class='fa fa-edit'></i></a>
                                    <a href='delete-notice.php?notice_id=<?php echo htmlentities($notice['Id']); ?>' onclick="return confirm('Are you sure you want to delete this result?');" class='delete'><i class='fa fa-trash'></i></a>

                                </td>
                            </tr>
                        <?php $counter--;} ?>
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