<?php
   session_start();
   $dbUrl = getenv('DATABASE_URL');

   $results;
   if(isset($_POST["filter"])){
      $results = $_POST["filter"];
   }

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
      <h2>Filter Results</h2>
      <br>
      <div align="center">
         <a href="prove5Search.php">Back to Browse</a>
      </div>
      <form action="prove5Search.php" method="POST">
         <div align="left">
            Shoe Type: 
            <input type="checkbox" name="type1" value="Basketball">
            <label for="type1">Basketball</label><br>
            <input type="checkbox" name="type2" value="Running">
            <label for="type2">Running</label><br>
            <input type="checkbox" name="type1" value="Soccer">
            <label for="type3">Soccer</label><br>
         </div>
         <button type="submit" name="filter" value="Submit">Submit</button>
      </form>
      <br>
         <div align="center">
            <a href="prove5Search.php">Back to Browse</a>
         </div>
      <br>
   </body>
</html>
