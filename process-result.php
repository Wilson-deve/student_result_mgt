<?php

include('includes/config.php');
$message = '';

if (isset($_POST['submit'])) {
    if (isset($_POST['class'], $_POST['studentid'], $_POST['marks'])) {
        $class = $_POST['class'];
        $studentId = $_POST['studentid'];
        $marks = $_POST['marks'];

        // Validate inputs
        if (empty($class) || empty($studentId) || !is_numeric($class) || !is_numeric($studentId)) {
            $message = "Invalid input data. Please check your input.";
        } else {
            // Check if a result already exists for the student in the same class
            if (resultExistsForStudent($con, $studentId, $class)) {
                $message = "A result already exists for this student in the selected class.";
            } else {
                $subjectIds = getSubjectIdsForClass($con, $class);

                if (!empty($subjectIds) && count($subjectIds) === count($marks)) {
                    // Start a transaction
                    mysqli_begin_transaction($con);

                    $inserted = true;

                    for ($i = 0; $i < count($marks); $i++) {
                        $mar = $marks[$i];
                        $sid = $subjectIds[$i];

                        // Insert result
                        if (!insertResult($con, $studentId, $class, $sid, $mar)) {
                            $inserted = false;
                            break;
                        }
                    }

                    if ($inserted) {
                        // Commit the transaction
                        mysqli_commit($con);
                        $message = "Result info added successfully";
                        header("Location: add-result.php?message=$message");
                        exit();
                    } else {
                        // Roll back the transaction on failure
                        mysqli_rollback($con);
                        $message = "Error occurred while adding results. Please try again.";
                    }
                } else {
                    $message = "Invalid input data. Please check your input.";
                }
            }
        }
    } else {
        $message = "Incomplete form data. Please fill in all required fields.";
    }

    // Redirect with error message
    header("Location: add-result.php?message=$message");
    exit();
}

// Retrieve the list of students for the selected class
$classData = getClassData($con); // Assuming this function exists

function getSubjectIdsForClass($con, $class)
{
    $subjectIds = array();
    $status = 'Active'; // Set the status you want to retrieve

    $stmt = $con->prepare("SELECT tblsubjects.id FROM tblsubjectcombination JOIN tblsubjects ON tblsubjects.id = tblsubjectcombination.SubjectId WHERE tblsubjectcombination.ClassId = ? AND tblsubjectcombination.Status = ? ORDER BY tblsubjects.SubjectName");
    $stmt->bind_param('is', $class, $status); // 'i' represents an integer, 's' represents a string, adjust as needed
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $subjectIds[] = $row['id'];
    }

    return $subjectIds;
}


function insertResult($con, $studentId, $class, $subjectId, $mark)
{
    $sql = "INSERT INTO tblresult (StudentId, ClassId, SubjectId, marks) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iiii', $studentId, $class, $subjectId, $mark); // Adjust data types accordingly (e.g., 'iiii' for integers)
    $stmt->execute();

    if ($stmt->errno) {
        die("Error: " . $stmt->error);
    }
}


function getClassData($con)
{
    $classData = array();
    $query = "SELECT DISTINCT Id, ClassName, Section FROM tblclasses";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $classData[$row['Id']] = $row['ClassName'] . ' - ' . $row['Section'];
        }
        mysqli_free_result($result);
    }

    return $classData;
}
function resultExistsForStudent($con, $studentId, $class)
{
    $stmt = $con->prepare("SELECT COUNT(*) FROM tblresult WHERE StudentId = ? AND ClassId = ?");
    $stmt->bind_param('ii', $studentId, $class);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    return $count > 0;
}
?>

