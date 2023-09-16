<?php
include('includes/config.php');

if (isset($_POST['classId'])) {
    $classId = $_POST['classId'];

    // Prepare the SQL query to retrieve students and subjects for the selected class
    $studentSql = "SELECT Id AS StudentId, StudentName FROM tblstudents WHERE ClassId = ?";
    $studentStmt = $con->prepare($studentSql);

    $subjectSql = "SELECT sc.SubjectId, s.SubjectName
    FROM tblsubjectcombination sc
    INNER JOIN tblsubjects s ON sc.SubjectId = s.Id
    WHERE sc.ClassId = ? AND sc.Status = 'Active'";
    $subjectStmt = $con->prepare($subjectSql);

    if ($studentStmt && $subjectStmt) {
        // Bind the class ID parameter for both statements
        $studentStmt->bind_param("i", $classId);
        $subjectStmt->bind_param("i", $classId);

        // Execute both queries
        $students = array();
        $subjects = array();

        if ($studentStmt->execute()) {
            $studentResult = $studentStmt->get_result();

            while ($row = $studentResult->fetch_assoc()) {
                $students[] = $row;
            }
        }

        if ($subjectStmt->execute()) {
            $subjectResult = $subjectStmt->get_result();

            while ($row = $subjectResult->fetch_assoc()) {
                $subjects[] = $row;
            }
        }

        // Close the statements
        $studentStmt->close();
        $subjectStmt->close();

        // Return both student and subject data as JSON
        echo json_encode(array("students" => $students, "subjects" => $subjects));
    } else {
        // Handle statement preparation error
        echo json_encode(array("error" => "Error preparing statements"));
    }

    // Close the database connection
    $con->close();
} else {
    // Invalid request
    echo json_encode(array("error" => "Invalid request"));
}
?>
