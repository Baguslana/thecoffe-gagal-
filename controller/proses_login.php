<?php
include "connect.php";

session_start();

if (!empty(isset($_POST['username']))) {
  $username = mysqli_real_escape_string($con, $_POST['username']); // Sanitize username
  $password = mysqli_real_escape_string($con, $_POST['password']); // Sanitize password (assuming password field)

  // Construct a prepared statement to prevent SQL injection
  $sql = "SELECT username, role FROM user WHERE username = ? AND password = ?";

  $stmt = mysqli_prepare($con, $sql); // Prepare statement

  if ($stmt) {
    // Bind parameters securely
    mysqli_stmt_bind_param($stmt, "ss", $username, md5($password));

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Get the result (if any)
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
      if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
          $_SESSION['username_thecoffe'] = $row['username'];
          $_SESSION['role_thecoffee'] = $row['role'];
          header('location:../dashboard');
        } else {
          // Handle failed login attempt (e.g., invalid credentials)
          echo '<div class="alert alert-danger">Invalid username or password.</div>';
        }
      } else {
        // Handle unexpected multiple rows (shouldn't happen)
        echo '<div class="alert alert-warning">Unexpected login issue. Please contact the administrator.</div>';
      }

      mysqli_free_result($result);
    } else {
      // Handle query execution error
      echo '<div class="alert alert-danger">Error processing login request. Please try again later.</div>';
      error_log(mysqli_error($con)); // Log the error for debugging
    }

    mysqli_stmt_close($stmt);
  } else {
    // Handle prepared statement preparation error
    echo '<div class="alert alert-danger">Error preparing login query. Please contact the administrator.</div>';
    error_log(mysqli_error($con)); // Log the error for debugging
  }
}
?>
