<?php
include('includes/config.php');

if (isset($_GET['notice_id'])) {
    $notice_id = $_GET['notice_id'];

  
    $deleteSql = "DELETE FROM tblnotice WHERE Id = ?";
    $stmt = $con->prepare($deleteSql);
    $stmt->bind_param("i", $notice_id);

    if ($stmt->execute()) {
        
        header("Location: manage-notices.php");
        exit;
    } else {
        
        echo "Error deleting result.";
    }
} else {
    
    echo "Invalid request.";
}
