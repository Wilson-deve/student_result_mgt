<?php
include('includes/session.php');
include('includes/sidebar.php');


if (isset($_GET['notice_id'])) {
    $noticeId = $_GET['notice_id'];

    
    $sql = "SELECT * FROM tblnotice WHERE Id = $noticeId"; 
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $notice = mysqli_fetch_assoc($result);
    } else {
        
        echo "Notice not found.";
        exit;
    }
} else {
    
    echo "Notice ID is missing.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    
    $newTitle = mysqli_real_escape_string($con, $_POST['noticetitle']);
    $newDetails = mysqli_real_escape_string($con, $_POST['noticedetails']);

    if ($newTitle === false || $newDetails === false) {
        
        $errorMessage = "Invalid input data. Please check your input.";
    } else {
        
        $sql = "UPDATE tblnotice SET noticeTitle = ?, noticeDetails = ? WHERE Id = ?";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            // Assuming $noticeId is the ID you want to update
            $stmt->bind_param("ssi", $newTitle, $newDetails, $noticeId);
            if ($stmt->execute()) {
               
                $successMessage = "Data has been updated successfully";
            } else {
                
                $errorMessage = "Something went wrong. Try again!";
            }
            $stmt->close();
        }
    }
}

?>

<section class="dashboard">
    <?php include('includes/topbar.php'); ?>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="fa fa-bell"></i>
                <span class="text">Edit Notice</span>
            </div>
            <div class="link-menu">
                <div class="link-item">
                    <ul>
                        <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                        <li><a href="#">Notices</a></li>/
                        <li><a href="#">Edit Notice</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="activity">
            <div class="title">
                <!-- <i class="uil uil-clock-three"></i> -->
                <span class="text">Edit Notice</span>
            </div>

           
            <div class="activity-data">
                <div class="form-box">
                    <form class="data-form" method="post" action="">
                    <?php if (isset($errorMessage)) : ?>
                                    <div id="message" class="error-message" style="font-size: 13px; color: #cc0000; margin-top: 10px;"><?php echo $errorMessage; ?></div>
                                <?php endif; ?>

                                <?php if (isset($successMessage)) : ?>
                                    <div id="message" class="success-message" style="font-size: 13px; color: #00cc00; margin-top: 10px;"><?php echo $successMessage; ?></div>
                                <?php endif; ?>
                        <label for="noticetitle">Notice Title</label><br>
                        <input type="text" id="noticetitle" name="noticetitle" value="<?php echo htmlentities($notice['noticeTitle']); ?>" required><br>

                        <label for="noticedetails">Notice Details</label><br>
                        <textarea name="noticedetails" rows="5" required><?php echo htmlentities($notice['noticeDetails']); ?></textarea><br>

                        <button type="submit" name="submit" class="btn">Update</button>
                    </form>
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
