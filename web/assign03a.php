<html>
   <head>
      <title>Order Processed</title>
      <meta name="viewport" content="width= device-width, intitial-scale=1">
      <link rel="stylesheet" type="text/css" href="assign03.css">
   </head>
</html>
<?php
   if($_GET["order"] == "confirm") {
   echo "<form action=\"assign03-checkout.php\">Yay! Your Order has been confirmed!<br><div style=\"margin: auto\"><img src=\"High-Five.jpeg\" alt=\"Virtual High Five\" style=\"margin: auto; height: 80%; width: 100%; max-width: 700px; max-height: 700px;\"></div><br><button type=\"submit\">Back to Checkout</button></form>";
   }
   else if($_GET["order"] == "cancel") {
   echo "<form action=\"assign03-checkout.php\">Noooooo!!!! Your Order has been cancelled! You'd better go back and buy something!<br><button type=\"submit\">Back to Checkout</button></form>";
   }

?>
