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

   $item_genre;
   if(isset($_POST["item_genre"])){
      $item_genre = $_POST["item_genre"];
   }
 
   $item_rating;
   if(isset($_POST["item_rating"])){
      $item_rating = $_POST["item_rating"];
   }
 
   $item_title;
   if(isset($_POST["item_title"])){
      $item_title = $_POST["item_title"];
   }
 
   $item_release_date;
   if(isset($_POST["item_release_date"])){
      $item_release_date = $_POST["item_release_date"];
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
   $itemInsert;
   $itemInsert = "INSERT INTO item (item_id, item_genre, item_rating, item_title, item_release_date) VALUES (nextval('item_item_id_seq'), '$item_genre', '$item_rating', '$item_title', '$item_release_date')";
print($itemInsert);
   $stmt = $db->prepare($itemInsert);
   $stmt->execute();

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
      <?php
         $query;
         $query = "SELECT item_name FROM item WHERE item_id = (SELECT last_value FROM item_item_id_seq)";
         foreach ($db->query($query) as $row){
            print "Item \"" . $row[0] . "\" added by " . $username . ".";
         }
      ?>
      <br>
      <a href="project2.php">Back to Browse</a>
      <br>
      <br>
      <form action="project2Added.php" method="POST">
         <div align="center">
            <input name="item_type" type="text" placeholder="Genre">
            <br>
            <input name="item_price" type="text" placeholder="Rating">
            <br>
            <input name="item_brand" type="text" placeholder="Title">
            <br>
            <input name="item_name" type="text" placeholder="Release Date (XX/Mon/XXXX)">
            <br>
            <input type="submit" name="submit" value="Submit">
         </div>
      </form>
   </body>
</html>
