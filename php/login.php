<?php
// Start the session
session_start();

// Check if user is already logged in
if (isset($_SESSION['username'])) {
	header("Location: profile.php");
	exit;
}

// Check if login form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {

	// Connect to the MySQL database
	$conn = mysqli_connect('localhost', 'root', '', 'db01');

	// Check if connection was successful
	if (!$conn) {
		die('Error: Could not connect to database');
	}

	// Prepare SQL statement to fetch user from database
	$stmt = mysqli_prepare($conn, "SELECT * FROM table03 WHERE uname = ? AND pwd = ?");

	// Bind parameters to the SQL statement
	mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['password']);

	// Execute the SQL statement
	mysqli_stmt_execute($stmt);

	// Fetch the result
	$result = mysqli_stmt_get_result($stmt);

	// Check if user was found in the database
	if (mysqli_num_rows($result) == 1) {

		// Set session variables
		$_SESSION['username'] = $_POST['username'];

		// Redirect to the profile page
		header("Location: profile.php");
		exit;

	} else {

		// Display error message
		echo "Invalid username or password";

	}

	// Close the database connection
	mysqli_close($conn);
}
?>
