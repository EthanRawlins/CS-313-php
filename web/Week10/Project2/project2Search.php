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

print($search);
print($query);

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
      <h2>All Products</h2>
      <br>
      <a href="project2Add.php">Add a new product</a>
      <br>
      <a href="project2Delete.php">Remove a product</a>
      <br>
      <form method="POST">
         <div align="center">
            <input name="search" type="text" placeholder="Enter Product Name">
            <input type="submit" name="searchSubmit" value="Search">
         </div>
         <div align="left">
            <h4>Filters</h4>
            Shoe Type: <br> 
            <input type="checkbox" name="type1" value="Comedy">
            <label for="type1">Comedy</label><br>
            <input type="checkbox" name="type2" value="Family">
            <label for="type2">Family</label><br>
            <input type="checkbox" name="type3" value="Horror">
            <label for="type3">Horror</label><br>
            <input type="checkbox" name="type4" value="Action">
            <label for="type4">Action</label><br>
            <input type="checkbox" name="type5" value="Drama">
            <label for="type5">Drama</label><br>
            <input type="submit" name="filterSubmit" value="Filter">
         </div>
      </form>
      <br>
      <table>
         <tr>
               <th>Title</th>
               <th>Genre</th>
               <th>Rating</th>
               <th>Price</th>
         </tr>
      <?php
         foreach ($db->query($query) as $row)
         {
             print "<tr><td>" . $row[4] . "</td><td>" . $row[1] . "</td><td>" . $row[3] . "</td><td>$2.99</td></tr>";
         }
      ?>
      </table>
   </body>
</html>
