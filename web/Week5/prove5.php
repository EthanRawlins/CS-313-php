<?php
   session_start();
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
      <h2>All Products</h2>
      <br>
      <form action="prove5Search.php" method="POST">
         <div align="center">
            <input name="search" type="text" placeholder="Enter Product Name">
            <input type="submit" name="submit" value="Search">
         </div>
      </form>
      <br>
      <form>
         <div align="center">
            <button href="prove5Filter.php">Filter</button>
         </div>
      <br>
      <table>
         <tr>
            <th>Price</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Description</th>
         </tr>
      <?php
         foreach ($db->query('SELECT * FROM item') as $row)
         {
            print "<tr><td>$" . $row[2] . "</td><td>" . $row[4] . "</td><td>" . $row[3] . "</td><td>" . $row[5] . "</td></tr>";
         }
      ?>
      </table>
   </body>
</html>
