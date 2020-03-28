<?php
   session_start();
   if (isset($_SESSION['username']))
   {
      $username = $_SESSION['username'];
   }
   else
   {
      header("Location: signIn.php");
      die(); // we always include a die after redirects.
   }
?>

<!DOCTYPE HTML>
<html lang="en-us">
   <head>
      <meta charset="utf-8">
      <title>Nameless Video Store</title>
      <link rel="stylesheet" type="text/css" href="project2.css">
      <script>

      </script>
   </head>

   <body>
      <header>
         <h1>Nameless Video Store</h1>
      </header>
      <div align="right">
         <p>Welcome <?= $username?>, not you? <a href="signIn.php">Click here</a></p>
      </div>
      <h2>Add A New Movie</h2>
      <br>
      <a href="project2.php">Back to Browse</a>
      <br>
      <br>
      <form action="project2Added.php" method="POST">
         <div align="center">
            <input name="item_genre" type="text" placeholder="Genre">
            <br>
            <input name="item_rating" type="text" placeholder="Rating">
            <br>
            <input name="item_title" type="text" placeholder="Title">
            <br>
            <input name="item_release_date" type="text" placeholder="Release Date (XX/Mon/XXXX)">
            <br>
            <input type="submit" name="submit" value="Submit">
         </div>
      </form>
   </body>
</html>
