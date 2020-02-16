<?php
   session_start();

   $item_id;
   if(isset($_POST["item_id"])){
      $item_id = $_POST["item_id"];
   }
   $item_type;
   if(isset($_POST["item_type"])){
      $item_id = $_POST["item_type"];
   }
 
   $item_price;
   if(isset($_POST["item_price"])){
      $item_id = $_POST["item_price"];
   }
 
   $item_brand;
   if(isset($_POST["item_brand"])){
      $item_id = $_POST["item_brand"];
   }
 
   $item_name;
   if(isset($_POST["item_name"])){
      $item_id = $_POST["item_name"];
   }
 
   $item_desc;
   if(isset($_POST["item_desc"])){
      $item_id = $_POST["item_desc"];
   }
 
   $added_by;
   if(isset($_POST["added_by"])){
      $item_id = $_POST["added_by"];
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
   $itemInsert = "INSERT INTO item (item_id, item_type, item_price, item_brand, item_name, item_desc, added_by) VALUES ('$item_id', '$item_type, '$item_price', '$item_brand', '$item_name', '$item_desc', '$added_by')";

   $stmt = $db->prepare($itemInsert);
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
      <h2>Add A New Product</h2>
      <br>
      <a href="prove5.php">Back to Browse</a>
      <br>
      <br>
      <form action="prove5Added.php" method="POST">
         <div align="center">
            <input name="item_id" type="text" placeholder="Item ID">
            <input name="item_type" type="text" placeholder="Item Type">
            <input name="item_price" type="text" placeholder="Item Price">
            <input name="item_brand" type="text" placeholder="Item Brand">
            <input name="item_name" type="text" placeholder="Item Name">
            <input name="item_desc" type="text" placeholder="Item Description">
            <input name="added_by" type="text" placeholder="Added By...">
            <input type="submit" name="submit" value="Submit">
         </div>
      </form>
   </body>
</html>
