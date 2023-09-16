<?php
include('includes/config.php');

if (isset($_GET['result_id'])) {
    $result_id = $_GET['result_id'];

  
    $deleteSql = "DELETE FROM tblresult WHERE Id = ?";
    $stmt = $con->prepare($deleteSql);
    $stmt->bind_param("i", $result_id);

    if ($stmt->execute()) {
        
        header("Location: manage-results.php");
        exit;
    } else {
        
        echo "Error deleting result.";
    }
} else {
    
    echo "Invalid request.";
}
