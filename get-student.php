<?php
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $regId = $_POST["reg_id"];
    $selectedClass = $_POST["class"];
    $accessGranted = checkAccessInDatabase($regId, $selectedClass);

    // Return the message as JSON
    header("Content-Type: application/json");
    echo json_encode(["message" =>  $accessGranted ? "Access granted. Welcome, student!" : "Access denied. Please check your Reg ID and Class."]);
    exit();
}

// Fetch class options from the database
function getClassOptionsFromDatabase() {
    global $con;
    $query = "SELECT CONCAT(ClassName, ' - ', Section) AS ClassOption FROM tblclasses";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Use mysqli_fetch_all() to fetch all rows as an associative array
        $classOptions = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // Extract the ClassOption values into a separate array
        $classOptionsArray = array_column($classOptions, 'ClassOption');
        return $classOptionsArray;
    } else {
        // Handle the query error if needed
        echo "Error: " . mysqli_error($con);
        return array(); // Return an empty array in case of an error
    }
}


// Function to check student access in the database
function checkAccessInDatabase($regId, $selectedClass) {
    global $con;
    
    // First, retrieve the ClassId based on the selected Class (classname - section)
    $selectedClass = mysqli_real_escape_string($con, $selectedClass); // Sanitize input
    $classQuery = "SELECT Id FROM tblclasses WHERE CONCAT(ClassName, ' - ', Section) = '$selectedClass'";
    $classResult = mysqli_query($con, $classQuery);

    if (!$classResult) {
        die("Class query failed: " . mysqli_error($con)); // Add error handling
    }

    if (mysqli_num_rows($classResult) === 0) {
        // Class not found
        return false;
    }

    $classRow = mysqli_fetch_assoc($classResult);
    $classId = $classRow['Id'];

    // Next, check if a student with the given RegId and ClassId exists
    $regId = mysqli_real_escape_string($con, $regId); // Sanitize input
    $studentQuery = "SELECT COUNT(*) AS count FROM tblstudents WHERE RollId = '$regId' AND ClassId = $classId";
    echo "Student Query: $studentQuery<br>";
    $studentResult = mysqli_query($con, $studentQuery);


    if (!$studentResult) {
        die("Student query failed: " . mysqli_error($con)); // Add error handling
    }
    $row = mysqli_fetch_assoc($studentResult);
    $count = $row['count'];

    echo "Query: $query<br>";
    echo "Count: $count<br>";

    // Check if a matching student record is found
    return $count > 0;
    // If a matching student record is found, access is granted; otherwise, access is denied
    // return mysqli_num_rows($studentResult) > 0;
}




// Include the HTML form with dynamic class options
$classOptions = getClassOptionsFromDatabase();
include 'index.php';
?>
