<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit;
}

// Connect to the MySQL database
$conn = mysqli_connect('localhost', 'root', '', 'db01');

// Check if connection was successful
if (!$conn) {
	die('Error: Could not connect to database');
}

// Prepare SQL statement to fetch user from database
$stmt = mysqli_prepare($conn, "SELECT * FROM table03 WHERE uname = ?");

// Bind parameters to the SQL statement
mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);

// Execute the SQL statement
mysqli_stmt_execute($stmt);

// Fetch the result
$result = mysqli_stmt_get_result($stmt);

// Get the user's profile information
$user = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);

// Include the HTML code
include('profile.html');
?>
