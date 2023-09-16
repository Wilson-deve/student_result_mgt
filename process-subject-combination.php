<?php
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Retrieve form data
    $classId = $_POST['class'];
    $subjectId = $_POST['subject'];
    $status = 'Active'; // Set the default status to 'Active'

    // Check if the combination already exists
    $checkSql = "SELECT Id FROM tblsubjectcombination WHERE ClassId = ? AND SubjectId = ?";
    $checkStmt = $con->prepare($checkSql);

    if ($checkStmt) {
        $checkStmt->bind_param("ii", $classId, $subjectId);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // Combination already exists, handle accordingly
            header("Location: add-subjectcombination.php?error=2"); // Redirect with error code 2 (combination exists)
            exit();
        }
        $checkStmt->close();
    }

    // Insert the new subject combination with the default status
    $insertSql = "INSERT INTO tblsubjectcombination (ClassId, SubjectId, Status) VALUES (?, ?, ?)";
    $insertStmt = $con->prepare($insertSql);

    if ($insertStmt) {
        $insertStmt->bind_param("iis", $classId, $subjectId, $status);
        if ($insertStmt->execute()) {
            // Successful insertion
            header("Location: add-subjectcombination.php?success=1");
            exit();
        } else {
            // Handle database error
            header("Location: add-subjectcombination.php?error=1");
            exit();
        }
        $insertStmt->close();
    }
}

// Redirect back to the appropriate page if accessed directly
header("Location: add-subject-combination.php");
exit();
?>
