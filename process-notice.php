<?php
include('includes/config.php');

$message = '';

if(isset($_POST['submit'])){
    $noticeTitle = $_POST['noticetitle'];
    $noticeDetails = $_POST['noticedetails'];


    $sql = "INSERT INTO tblnotice (noticeTitle, noticeDetails) VALUES (?, ?)";
    $query = $con->prepare($sql);
    $query->bind_param('ss', $noticeTitle, $noticeDetails);
    
    if($query->execute()){
        $message = "Notice recorded successfull.";
        // header("Location: add-notice.php"); 
        // exit();
    } else {
        
        $message = "Error inserting data into the database: " . $query->error;
    }

    
    $query->close();
}
?>