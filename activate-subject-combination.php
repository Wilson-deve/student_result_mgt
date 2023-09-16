<?php 
    
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $subjectCombinationId = $_GET['id'];

    // Update the Status column in the subjectcombination table to activate the record
    $sql = "UPDATE tblsubjectcombination SET Status = 'Active', UpdationDate = CURRENT_TIMESTAMP WHERE Id = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $subjectCombinationId);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the Manage Subjects Combination page with a success message
            header("Location: manage-subjectcombination.php?success=1");
            exit();
        }
    }

   
}

// Redirect back to the Manage Subjects Combination page with an error message if the activation fails
header("Location: manage-subjectcombination.php?error=1");
exit();

?>