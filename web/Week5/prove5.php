<?php
   session_start();
   print "<h1>Nameless Shoe Store</h1>";
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

foreach ($db->query('SELECT * FROM item') as $row)
{
   echo 'item id: ' . $row['item_id'];
   echo 'item type: ' . $row['item_type'];
   echo 'item price: ' . $row['item_price'];
   echo 'item brand: ' . $row['item_brand'];
   echo 'item name: ' . $row['item_name'];
   echo 'added by: ' . $row['added_by'];
}
?>

<!DOCTYPE HTML>
<html lang="en-us">
<head>
<meta charset="utf-8">
<title>Nameless Shoe Store</title>
<script>

</script>
</head>

<body> <header>
Search 
</header>
</body>
</html>
