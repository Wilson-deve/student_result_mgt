<?php  
    include('includes/config.php');

    if (isset($_GET['subject_id'])) {
        $classIdToDelete = $_GET['subject_id'];
    
        // Delete the class record from the database
        $sql = "DELETE FROM tblsubjects WHERE Id = ?";
        $stmt = $con->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $classIdToDelete);
            if ($stmt->execute()) {
                // Successful deletion
                // You can redirect or display a success message
                header("Location: manage-subjects.php");
                exit();
            } else {
                // Handle database error
                // You can redirect or display an error message
            }
            $stmt->close();
        }
    }

 
?>