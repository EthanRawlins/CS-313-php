<!DOCTYPE html>
<html>
   <head>
      <title>Checkout</title>
      <link rel="stylesheet" type="text/css" href="assign03.css">
      <style>
         table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
         }
      </style>
   </head>
      <body onload="firstNameFocus()">
         <header>
            <h1>Checkout</h1>
         </header>
         <form name="form1" action="assign03.php" method="get" onsubmit="checkphone(document.form1.phone)">
            First Name 
            <input id="firstName" type="text" size="10" maxlength="15" value="" name="first" required>
            <br> <br>
            Middle Initial (optional)
            <input id="middleinitial" type="text" size="1" maxlength="1" value="" name="mi">
            <br> <br>
            Last Name 
            <input id="lastName" type="text" size="10" maxlength="15" value="" name="last" required>
            <br> <br>
            Street Address (Street Address, City, State, Zip)
            <textarea id="address" name="address" rows="5" cols="22" value="" required></textarea>
            <br> <br>
            Phone number (XXX-XXX-XXXX)
            <input id="phone" name="phone" onchange="validatePhone" type="text" size="10" maxlength="12" value="" required>
            <br> <br>
            <table style="background-color: white">
               <caption><b>Our Products</b></caption>
               <tr>
                  <th>Product</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Purchase</th>
               </tr>
               <tr>
                  <td><img src="pen-usb.jpg" alt="pen usb drive" width="100" height="100">
                  <td>Pen Usb</td>
                  <td>$19.99</td>
                  <td><input type="checkbox" id="penbuy" name="item" value="19.99" onclick="calculateTotal()"></td>
                  <td><input type="checkbox" id="penbuy" name="item" value="19.99" onclick="calculateTotal()" checked></td>
</tr>
               <tr>
                  <td><img src="lightsaber-knife.jpg" alt="lightsaber knife" width="100" height="100">
                  <td>Lightsaber Knife</td>
                  <td>$299.99</td>
                  <td><input type="checkbox" id="knifebuy" name="item" value="299.99" onclick="calculateTotal()"></td>
               </tr>
               <tr>
                  <td><img src="banana-caution-signs.jpg" alt="banana caution sign" width="100" height="100">
                  <td>Banana Caution Sign</td>
                  <td>$29.99</td>
                  <td><input type="checkbox" id="signbuy" name="item" value="29.99" onclick="calculateTotal()"></td>
               </tr>
               <tr>
                  <td><img src="running-bike.jpg" alt="running bike" width="100" height="100">
                  <td>Running Bike</td>
                  <td>$199.99</td>
                  <td><input type="checkbox" id="bikebuy" name="item" value="199.99" onclick="calculateTotal()"></td>
               </tr>
               <tr>
                  <td><img src="table-cup-holder.jpg" alt="table cup holder" width="100" height="100">
                  <td>Table Cup Holder</td>
                  <td>$9.99</td>
                  <td><input type="checkbox" id="cupbuy" name="item" value="9.99" onclick="calculateTotal()"></td>
               </tr>
            </table>
            <script>
               document.getElementsByName("item").onchange=function() {calculateTotal()};
               var total;
               function validatePhone() {
                  var phone = document.getElementById("phone").value;
                  if (!phone.value.search(/^\d{3}-\d{3}-\d{4}$/)) {
                  return true;
                  }
                  else {
                     phoneFocus();
                     window.alert("Phone number must be in the form of XXX-XXX-XXXX"); 
                     return false;
                  }
               }
                  
               function calculateTotal() {
                  var x = document.getElementsByName("item");
                  var y;
                  total = 0;
                  for (var i = 0; i < x.length; i++) {
                     if(x[i].checked == true) {
                        y = x[i].value;
                        y *= 1;
                        total += y;
                     }
                  }
                  document.getElementById("total").value=total.toFixed(2);
               }
               function firstNameFocus() {
                  document.getElementById("firstName").focus();
               }
               function phoneFocus() {
                  document.getElementById("phone").focus();
               }
               function cardFocus() {
                  document.getElementById("credit").focus();
               }


            </script>
            <br> <br>
            Credit Card Number
            <input id="credit" type="text" size="15" maxlength="16" value="" name="credit" required>
            <br> <br>
            Credit Card Expiration Date (MM/YYYY)
            <input id="expire" type="text" size="5" maxlength="7" value="" name="expire" required> 
            <br> <br>
            <div>
               <h2 style="width: 60%; float: left">Total: $</h2>
               <br>
               <input type="text" size="5" name="total" style="float: left" maxlength="12" id="total" value="0.00" readonly>
            </div>
            <br> <br>

            <input type="submit" onclick="validate()">
            <button class="button" type="reset" onclick="firstNameFocus()">Clear Form</button>
         </form>

      </body>
</html>
