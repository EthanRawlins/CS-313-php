<?php
// get the data from the POST
$username = $_POST['txtUser'];
$password = $_POST['txtPassword'];

if (!isset($username) || $username == ""
	|| !isset($password) || $password == "")
{
	header("Location: signUp.php");
	die(); // we always include a die after redirects.
}

// Let's not allow HTML in our usernames. It would be best to also detect this before
// submitting the form and preven the submission.
$username = htmlspecialchars($username);

// Get the hashed password.
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Connect to the database
require("dbConnect.php");
$db = get_db();

$query = 'INSERT INTO login(username, password) VALUES(:username, :password)';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);

// **********************************************
// NOTICE: We are submitting the hashed password!
// **********************************************
$statement->bindValue(':password', $hashedPassword);

$statement->execute();


// finally, redirect them to the sign in page
header("Location: signIn.php");
die(); // we always include a die after redirects.
?>