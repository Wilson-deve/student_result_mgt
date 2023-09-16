<?php 
    
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $subjectCombinationId = $_GET['id'];

    // Update the Status column in the subjectcombination table to deactivate the record
    $sql = "UPDATE tblsubjectcombination SET Status = 'Inactive', UpdationDate = CURRENT_TIMESTAMP WHERE Id = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $subjectCombinationId);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the Manage Subjects Combination page with a success message
            header("Location: manage-subjectcombination.php?success=2");
            exit();
        }
    }

    // Handle errors if necessary
}

// Redirect back to the Manage Subjects Combination page with an error message if the deactivation fails
header("Location: manage-subjectcombination.php?error=2");
exit();

?>