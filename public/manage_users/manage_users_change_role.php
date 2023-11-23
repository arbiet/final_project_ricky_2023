<?php
// Include the connection file
require_once('../../database/connection.php');

// Get user ID and selected role from URL parameters
$userID = $_GET['id'];
$selectedRole = $_GET['role'];

// Update the user's role in the database (replace 'Role' with the actual name of your role table)
$updateQuery = "UPDATE Users SET RoleID = (SELECT RoleID FROM Role WHERE RoleName = '$selectedRole') WHERE UserID = $userID";
$conn->query($updateQuery);

// Redirect back to the manage_users_list.php page
header("Location: manage_users_list.php");
exit();
