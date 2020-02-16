<?php
   session_start();

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
            <input name="item_type" type="text" placeholder="Item Type (1, 2, or 3)">
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
