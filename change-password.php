<?php 
    include('includes/session.php');
    include('includes/sidebar.php');

    

 $updationDate = "N/A"; // Default value


 // Fetch the updationDate before rendering the form
 $userId = $_SESSION['login_user'];
 $sql = "SELECT updationDate FROM tblusers WHERE UserName = ?";
 $stmt = mysqli_prepare($con, $sql);
 mysqli_stmt_bind_param($stmt, "s", $userId);

 if (mysqli_stmt_execute($stmt)) {
     mysqli_stmt_bind_result($stmt, $updationDate);
     mysqli_stmt_fetch($stmt);
 }

 mysqli_stmt_close($stmt);
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $currentPasswordInput = $_POST['password'];
     $newPassword = $_POST['newpassword'];
     $confirmPassword = $_POST['confirmpassword'];
 
     $userId = $_SESSION['login_user'];
 
     // Fetch the updationDate
     $sql = "SELECT updationDate FROM tblusers WHERE UserName = ?";
     $stmt = mysqli_prepare($con, $sql);
     mysqli_stmt_bind_param($stmt, "s", $userId);
 
     if (mysqli_stmt_execute($stmt)) {
         mysqli_stmt_bind_result($stmt, $updationDate);
 
         if (mysqli_stmt_fetch($stmt)) {
             // UpdationDate retrieved
         } else {
             $updationDate = "N/A"; // If no date found, set to "N/A" or another default value
         }
         mysqli_stmt_free_result($stmt); // Free the result set
     } else {
         $updationDate = "N/A"; // Handle error, set to "N/A" or another default value
     }
 
     mysqli_stmt_close($stmt);
 
     // Password validation and update
     $sql = "SELECT Password FROM tblusers WHERE UserName = ?";
     $stmt = mysqli_prepare($con, $sql);
     mysqli_stmt_bind_param($stmt, "s", $userId);
 
     if (mysqli_stmt_execute($stmt)) {
         mysqli_stmt_bind_result($stmt, $currentPasswordFromDB);
 
         if (mysqli_stmt_fetch($stmt)) {
             if (password_verify($currentPasswordInput, $currentPasswordFromDB)) {
                 // Current password is correct
                 if ($newPassword == $confirmPassword) {
                     // Passwords match, proceed with the update
                     $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
                     $currentDateTime = date("Y-m-d H:i:s");
                     mysqli_stmt_free_result($stmt); // Free the result set
 
                     $sqlUpdate = "UPDATE tblusers SET Password = ?, updationDate = ? WHERE UserName = ?";
                     $stmtUpdate = mysqli_prepare($con, $sqlUpdate);
                     mysqli_stmt_bind_param($stmtUpdate, "sss", $newPasswordHash, $currentDateTime, $userId);
 
                     if (mysqli_stmt_execute($stmtUpdate)) {
                         $successMessage = "Password changed successfully.";
                     } else {
                         $errorMessage = "Error updating password in the database.";
                     }
 
                     mysqli_stmt_close($stmtUpdate);
                 } else {
                     $errorMessage = "New password and confirm password do not match.";
                 }
             } else {
                 $errorMessage = "Current password is incorrect.";
             }
         } else {
             $errorMessage = "User not found in the database.";
         }
         mysqli_stmt_free_result($stmt); // Free the result set
     } else {
         $errorMessage = "Error executing the database query: " . mysqli_error($con);
     }
 
     mysqli_stmt_close($stmt);
 }
?>





    <section class="dashboard">
      <?php include('includes/topbar.php');?>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-key"></i>
                    <span class="text">Admin Change Password</span>
                </div>
                <div class="link-menu">
                    <div class="link-item">
                        <ul>
                            <li><i class="uil uil-estate"></i><a href="dashboard.php">Home</a></li>/
                            <li><a href="#">Admin Change Password</a></li>/
                        </ul>
                    </div>
                </div>


            <div class="activity">
                <div class="title">
                    <!-- <i class="uil uil-clock-three"></i> -->
                    <!-- <span class="text">Create Subject</span> -->
                </div>

                <div class="activity-data">
                    <div class="form-box">
                        <form class="data-form" action="" method="post">
                            <?php if (isset($errorMessage)) : ?>
                                <div id="message-container" class="error-message" style="font-size: 13px; color: #cc0000; margin-top: 10px;"><?php echo $errorMessage; ?></div>
                            <?php endif; ?>

                            <?php if (isset($successMessage)) : ?>
                                <div id="message-container" class="success-message" style="font-size: 13px; color: #00cc00; margin-top: 10px;"><?php echo $successMessage; ?></div>
                            <?php endif; ?>
                            <div class="password-input-container">
                                <label for="">
                                    Current Password (Last Updated: <?php echo $updationDate; ?>)
                                </label><br>
                                <input type="password" id="current-password" name="password" required>
                                <i class="fa fa-eye-slash"></i>
                            </div>

                            <div class="password-input-container">
                                <label for="">New Password:</label><br>
                                <input type="password" id="new-password" name="newpassword" required>
                                <i class="fa fa-eye-slash"></i>
                            </div>

                            <div class="password-input-container">
                                <label for="">Confirm Password:</label><br>
                                <input type="password" id="confirm-password" name="confirmpassword" required>
                                <i class="fa fa-eye-slash"></i>
                            </div>
            
                            <button type="submit" class="btn" name="submit">Change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('includes/footer.php');?>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script>
        function hideMessage() {
        var messageContainer = document.getElementById("message-container");
        if (messageContainer) {
            setTimeout(function() {
                messageContainer.style.display = "none";
            }, 5000); // 5000 milliseconds (5 seconds)
        }
    }

    // Call the hideMessage function when the page loads
    window.onload = hideMessage;
    </script>
</body>
</html>