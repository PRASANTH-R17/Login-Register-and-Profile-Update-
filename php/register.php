<?php
// Check if registration form is submitted
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

	// Connect to the MySQL database
	$conn = mysqli_connect('localhost', 'root', '', 'db01');

	// Check if connection was successful
	if (!$conn) {
		die('Error: Could not connect to database');
	}

	// Prepare SQL statement to insert user into database
	$stmt = mysqli_prepare($conn, "INSERT INTO table03 (uname, email, pwd) VALUES (?, ?, ?)");

	// Bind parameters to the SQL statement
	mysqli_stmt_bind_param($stmt, "sss", $_POST['username'], $_POST['email'], $_POST['password']);

	// Execute the SQL statement
	if (mysqli_stmt_execute($stmt)) {

		// Redirect to the login page
		header("Location: login.html");
		exit;

	} else {

		// Display error message
		echo "Error: Could not register user";

	}

	// Close the database connection
	mysqli_close($conn);
}
?>
