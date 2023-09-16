<?php  
    include('includes/config.php');

    if (isset($_GET['class_id'])) {
        $classIdToDelete = $_GET['class_id'];
    
        // Delete the class record from the database
        $sql = "DELETE FROM tblclasses WHERE Id = ?";
        $stmt = $con->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $classIdToDelete);
            if ($stmt->execute()) {
                // Successful deletion
                // You can redirect or display a success message
                header("Location: manage-classes.php");
                exit();
            } else {
                // Handle database error
                // You can redirect or display an error message
            }
            $stmt->close();
        }
    }

 
?>