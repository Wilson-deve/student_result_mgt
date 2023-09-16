<?php
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Validate and sanitize user input
    $fullName = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_STRING);
    $rollId = filter_input(INPUT_POST, 'rollid', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_EMAIL);
    $classId = filter_input(INPUT_POST, 'class', FILTER_VALIDATE_INT);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    // Check if the RollId already exists
    $checkQuery = "SELECT Id FROM tblstudents WHERE RollId = ?";
    $stmt = mysqli_prepare($con, $checkQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $rollId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            // RollId already exists, display an error message
            $message = "Student with RollId '$rollId' already exists.";
        } else {
            // RollId is unique, proceed with insertion
            $sql = "INSERT INTO tblstudents (StudentName, RollId, StudentEmail, Gender, DOB, ClassId) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssi", $fullName, $rollId, $email, $gender, $dob, $classId);
                if (mysqli_stmt_execute($stmt)) {
                    // Successful insertion
                    $message = "Student record added successfully";
                } else {
                    // Handle database error
                    $message = "Error: " . mysqli_error($con);
                }

                mysqli_stmt_close($stmt);
            } else {
                // Handle statement preparation error
                $message = "Error preparing statement: " . mysqli_error($con);
            }
        }

        // mysqli_stmt_close($stmt);
    } else {
        // Handle statement preparation error
        $message = "Error preparing statement: " . mysqli_error($con);
    }
}

// Redirect to the student admission page with the message
header("Location: add-students.php?message=$message");
exit();
?>
