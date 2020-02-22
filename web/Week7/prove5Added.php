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

   $item_type;
   if(isset($_POST["item_type"])){
      $item_type = $_POST["item_type"];
   }
 
   $item_price;
   if(isset($_POST["item_price"])){
      $item_price = $_POST["item_price"];
   }
 
   $item_brand;
   if(isset($_POST["item_brand"])){
      $item_brand = $_POST["item_brand"];
   }
 
   $item_name;
   if(isset($_POST["item_name"])){
      $item_name = $_POST["item_name"];
   }
 
   $item_desc;
   if(isset($_POST["item_desc"])){
      $item_desc = $_POST["item_desc"];
   }
 
   $added_by;
   $added_by = 1;

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
   $itemInsert;
   $itemInsert = "INSERT INTO item (item_id, item_type, item_price, item_brand, item_name, item_desc, added_by) VALUES (nextval('item_item_id_seq'), '$item_type', '$item_price', '$item_brand', '$item_name', '$item_desc', '$added_by')";

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
      <div align="right">
         <p>Welcome <?= $username?>, not you? <a href="signIn.php">Click here</a></p>
      </div>
      <h2>Add A New Product</h2>
      <br>
      <?php
         $query;
         $query = "SELECT item_name FROM item WHERE item_id = (SELECT last_value FROM item_item_id_seq)";
         foreach ($db->query($query) as $row){
            print "Item \"" . $row[0] . "\" added by " . $username . ".";
         }
      ?>
      <br>
      <a href="prove5.php">Back to Browse</a>
      <br>
      <br>
      <form action="prove5Added.php" method="POST">
         <div align="center">
            <input name="item_type" type="text" placeholder="Item Type">
            <br>
            <input name="item_price" type="text" placeholder="Item Price">
            <br>
            <input name="item_brand" type="text" placeholder="Item Brand">
            <br>
            <input name="item_name" type="text" placeholder="Item Name">
            <br>
            <input name="item_desc" type="text" placeholder="Item Description">
            <br>
            <input type="submit" name="submit" value="Submit">
         </div>
      </form>
   </body>
</html>
