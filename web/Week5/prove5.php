<?php
try
{
   $user = 'postgres';
   $password = 'password';
   $db = new PDO('pgsql:host=localhost;dbname=myTestDB', $user, $password);

   // this line makes PDO give us an exception when there are problems,
   // and can be very helpful in debugging! (But you would likely want
   // to disable it for production environments.)
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
   echo 'Error!: ' . $ex->getMessage();
   die();
}

try
{
   $dbUrl = getenv('DATABASE_URL');

   $dbOpts = parse_url($dbUrl);

   $dbHost = $dbOpts["host"];
   $dbPort = $dbOpts["port"];
   $dbUser = $dbOpts["user"];
   $dbPassword = $dbOpts["pass"];
   $dbName = ltrim($dbOpts["path"],'/');

   $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
   echo 'Error!: ' . $ex->getMessage();
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
