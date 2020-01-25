<html>
   <head>
      <title>Order Confirmation</title>
      <meta name="viewport" content="width= device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="assign03.css">
   </head>
</html>
<?php
   echo "<header><h1>Order Confirmation</h1></header>" . "<form action=\"assign03a.php\" method=\"get\">Please confirm that the following information is correct:<br><br>" . $_GET["first"] . " " . $_GET["mi"] . ". " . $_GET["last"] . "<br>" . $_GET["address"] . "<br><br>" . "Phone number: " . $_GET["phone"] . "<br><br> card number: " . $_GET["credit"] . " expires " . $_GET["expire"] . "<br><h1>Total = " . $_GET["total"] . "</h1><br><button type=\"submit\" name=\"order\" value=\"confirm\">Confirm Order</button><button type=\"submit\" name=\"order\" value=\"cancel\">Cancel Order</button></form>";
?>
