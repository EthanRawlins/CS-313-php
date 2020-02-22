<?php
/**********************************************************
* File: singup.php
* Author: Br. Burton
* 
* Description: Allows a user to enter a new username
*   and password to add to the DB.
*
* It posts to a file called "createAccount.php"
*   which does the actual creation.
*
***********************************************************/
?>


<!DOCTYPE HTML>
<html lang="en-us">
   <head>
      <meta charset="utf-8">
      <title>Nameless Shoe Store</title>
      <link rel="stylesheet" type="text/css" href="prove5.css">
      <script>

      </script>
   </head>

   <body>
      <header>
         <h1>Nameless Shoe Store</h1>
         <h2>Sign Up</h2>
      </header>

<body>
<div>

<h3>Sign up for new account</h3>

   <div align="center">
      <form id="mainForm" action="createAccount.php" method="POST">

	<input type="text" id="txtUser" name="txtUser" placeholder="Username">
	<label for="txtUser">Username</label>
	<br /><br />

	<input type="password" id="txtPassword" name="txtPassword" placeholder="Password"></input>
	<label for="txtPassword">Password</label>
	<br /><br />

	<input type="submit" value="Create Account" />

      </form>
   </div>


</div>

</body>
</html>