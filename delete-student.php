<?php  
    include('includes/config.php');

    if (isset($_GET['student_id'])) {
        $classIdToDelete = $_GET['student_id'];
    
        // Delete the class record from the database
        $sql = "DELETE FROM tblstudents WHERE Id = ?";
        $stmt = $con->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $classIdToDelete);
            if ($stmt->execute()) {
                // Successful deletion
                // You can redirect or display a success message
                header("Location: manage-students.php");
                exit();
            } else {
                // Handle database error
                // You can redirect or display an error message
            }
            $stmt->close();
        }
    }

 
?>