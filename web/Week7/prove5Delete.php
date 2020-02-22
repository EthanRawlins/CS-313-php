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

   $item_name;
   if(isset($_POST["item_name"])){
      $item_name = $_POST["item_name"];
   }
 
      $dbUrl = getenv('DATABASE_URL');

   if (empty($dbUrl)) {
      // example localhost configuration URL with postgres username and a database called cs313db
      $dbUrl = "postgres://postgres:password@localhost:5432/cs313db";
   }
   $dbopts = parse_url($dbUrl);

   $dbHost = $dbopts["host"];
   $dbPort = $dbopts["port"];
   $dbUser = $dbopts["user"];
   $dbPassword = $dbopts["pass"];
   $dbName = ltrim($dbopts["path"], '/');

   //print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";

   try {
      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
   }
   catch (PDOException $ex) {
      print "<p>error: $ex->getMessage() </p>\n\n";
      die();
   }

   //Inserts
   $itemDelete;
   $itemDelete = "DELETE FROM item WHERE UPPER(item_name) LIKE UPPER ('$item_name')";

   $stmt = $db->prepare($itemDelete);
   $stmt->execute();

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
      </header>
      <div align="right">
         <p>Welcome <?= $username?>, not you? <a href="signIn.php">Click here</a></p>
      </div>
      <h2>Add A New Product</h2>
      <br>
      <a href="prove5.php">Back to Browse</a>
      <br>
      <br>
      <form action="prove5Deleted.php" method="POST">
         <div align="center">
           <input name="item_name" type="text" placeholder="Item Name">
           <input type="submit" name="delete" value="Delete">
         </div>
      </form>
   </body>
</html>
