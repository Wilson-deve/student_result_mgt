<?php
include('includes/config.php');
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $myusername = mysqli_real_escape_string($con, $_POST['username']);
    $mypassword = mysqli_real_escape_string($con, $_POST['password']);

    // Create a prepared statement to query the database
    $sql = "SELECT Id, Password FROM tblusers WHERE UserName = ?";
    $stmt = mysqli_prepare($con, $sql); // Prepare the SQL statement
    mysqli_stmt_bind_param($stmt, "s", $myusername); // Bind the parameters to the statement
    mysqli_stmt_execute($stmt); // Execute the prepared statement
    mysqli_stmt_store_result($stmt); // Store the result of the query in the statement

    $count = mysqli_stmt_num_rows($stmt); // Get the number of rows returned by the query

    if ($count == 1) {
        // Bind the result to variables
        mysqli_stmt_bind_result($stmt, $userId, $storedPassword);
        mysqli_stmt_fetch($stmt);

        // Determine if the stored password is hashed or plain text
        $isHashed = password_verify($mypassword, $storedPassword);

        if ($isHashed || $mypassword === $storedPassword) {
            // Password matches (either hashed or plain text)
            // Start or resume the session
            $_SESSION['login_user'] = $myusername;
            
            // Return a JSON success response
            $response = array('success' => true);
            echo json_encode($response);

        } else {
            $response = array('success' => false, 'message' => '* Your Login Email or Password is invalid');
            echo json_encode($response);
            error_log("Login failed for user: " . $myusername);
        }
    } else {
        $response = array('success' => false, 'message' => '* Your Login Email or Password is invalid');
        echo json_encode($response);
        error_log("Login failed for user: " . $myusername);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}
?>
