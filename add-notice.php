
<?php
include('includes/session.php');
include('includes/sidebar.php'); 

$message = '';

?>





    <section class="dashboard">
    <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-bell"></i>
                    <span class="text">Add notice</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Notices</a></li>/
                            <li><a href="#">Add Notice</a></li>
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="fa fa-bank"></i> -->
                    <!-- <span class="text">Add Notice</span> -->
                </div>

                <?php
                    if (isset($_GET['message'])) {
                    $message = $_GET['message'];
    
                    echo "<div id='message' style='font-size: 13px; color: #00cc00; margin-top: 10px;'>$message</div>";
                    }
                ?>

                <div class="activity-data">
                    <div class="form-box">
                        <!-- <h1 class="form-title">Create Student Class</h1> -->
                        <form class="data-form" method="post" action="process-notice.php">
                            <label for="">Notice Title</label><br>
                            <input type="text" id="noticetitle" name="noticetitle"  required><br>

                            <label for="">Notice Details</label><br>
                            <textarea name="noticedetails"   rows="5" required></textarea><br>
            
                            <button type="submit" class="btn" name="submit">Submit</button>
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