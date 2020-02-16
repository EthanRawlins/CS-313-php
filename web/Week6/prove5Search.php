<?php
   session_start();

   $query;
   $search;
   
   if(isset($_POST["search"])){
      $search = $_POST["search"];
      $query = "SELECT * FROM item WHERE UPPER(item_name) LIKE UPPER('%$search%')";
      if(isset($_POST["type1"])){
         $query .= " AND item_type IN (" . $_POST["type1"];
         if(isset($_POST["type2"])){
            $query .= ", " . $_POST["type2"];
         }
         if(isset($_POST["type3"])){
            $query .= ", " . $_POST["type3"];
         }
         $query .= ")";
      }

      else if(isset($_POST["type2"])){
         $query .= " AND item_type IN (" . $_POST["type2"];
         if(isset($_POST["type3"])){
            $query .= ", " . $_POST["type3"];
         }
         $query .= ")";
      }
      else{
         if(isset($_POST["type3"])){
            $query .= " AND item_type IN (" . $_POST["type3"] . ")";
         }
      }
   }

   else if(isset($_POST["type1"])){
      $query = "SELECT * FROM item WHERE item_type IN (" . $_POST["type1"];
      if(isset($_POST["type2"])){
         $query .= ", " . $_POST["type2"];
      }
      if(isset($_POST["type3"])){
         $query .= ", " . $_POST["type3"];
      }
      else if(isset($_POST["type2"])){
         $query .= "SELECT * FROM item WHERE item_type IN (" . $_POST["type2"];
         if(isset($_POST["type3"])){
            $query .= ", " . $_POST["type3"];
         }
      }
      else if(isset($_POST["type3"])){
         $query .= "SELECT * FROM item WHERE item_type IN (" . $_POST["type3"];
      }
      $query .= ")";
   }

   else if(isset($_POST["type2"])){
      $query = "SELECT * FROM item WHERE item_type IN (" . $_POST["type2"];
      if(isset($_POST["type3"])){
         $query .= ", " . $_POST["type3"];
      }
      $query .= ")";
   }

   else if(isset($_POST["type3"])){
      $query = "SELECT * FROM item WHERE item_type IN (" . $_POST["type3"] . ")";
   }

   else{
      $query = "SELECT * FROM item";
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
      <a href="prove5Add.php">Add a new product</a>
      <br>
      <a href="prove5Delete.php">Remove a product</a>
      <br>
      <form method="POST">
         <div align="center">
            <input name="search" type="text" placeholder="Enter Product Name">
            <input type="submit" name="searchSubmit" value="Search">
         </div>
         <div align="left">
            <h4>Filters</h4>
            Shoe Type: <br> 
            <input type="checkbox" name="type1" value="1">
            <label for="type1">Basketball</label><br>
            <input type="checkbox" name="type2" value="2">
            <label for="type2">Running</label><br>
            <input type="checkbox" name="type3" value="3">
            <label for="type3">Soccer</label><br>
            <input type="submit" name="filterSubmit" value="Filter">
         </div>
      </form>
      <br>
      <table>
         <tr>
            <th>Price</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Description</th>
         </tr>
      <?php
         foreach ($db->query($query) as $row)
         {
            print "<tr><td>$" . $row[2] . "</td><td>" . $row[4] . "</td><td>" . $row[3] . "</td><td>" . $row[5] . "</td></tr>";
         }
      ?>
      </table>
   </body>
</html>
