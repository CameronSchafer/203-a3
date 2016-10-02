<?php
  echo "\n" . '<fieldset class="form_box" id="contact_details">';
  echo "\n" . '  <legend class="form_subtitle">Contact Details</legend>';
  echo "\n" . '      <div class="form_row">';
  if(isset($_SESSION["UserData"])){

    $seperator = "{||}";
    $info = $_SESSION["UserData"];
    $arr = array();
    $arr = explode($seperator,$info);
    $username = htmlentities($arr[1]);
    $email = htmlentities($arr[2]);
    $phone = htmlentities($arr[3]);
    $company = htmlentities($arr[4]);
    $address = htmlentities($arr[5]);
    /*-------------------------
    Display Form with filled auto-filled entries
    --------------------------*/
    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messageName"><strong>Username</strong></label>';
    echo "\n" . '<input type="text" class="form_field_input" value="' . $username . '" id="messageName" autocomplete="name" required/>';
    echo "\n" . '</div>';

    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messageEmail"><strong>Email</strong></label>';
    echo "\n" . '<input type="email" class="form_field_input" value="' . $email . '" id="messageEmail" autocomplete="email" required/>';
    echo "\n" . '</div>';

    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messagePhone"><strong>Phone</strong></label>';
    echo "\n" . '<input type="tel" class="form_field_input" value="' . $phone . '" id="messagePhone" autocomplete="tel" required/>';
    echo "\n" . '</div>';

    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messageOrganization"><strong>Company</strong></label>';
    echo "\n" . '<input type="text" class="form_field_input" value="' . $company . '" id="messageOrganization" autocomplete="organization"/>';
    echo "\n" . '</div>';
    echo "\n" . '</fieldset>';

    echo "\n" . '<fieldset class="form_box" id="postage_details">';
    echo "\n" . '    <legend class="form_subtitle">Postage Details</legend>';
    echo "\n" . '        <div class="form_row">';
    echo "\n" . '            <label class="form_field" for="postage_street_address"><strong>Address</strong></label>';
    echo "\n" . '            <textarea class="form_field_input" value="' . $address . '" id="postage_street_address" required></textarea>';
    echo "\n" . '        </div>';
    echo "\n" . '</fieldset>';
  }
  else{
    /*-------------------------
    Display empty form.
    --------------------------*/
    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messageName"><strong>Name</strong></label>';
    echo "\n" . '<input type="text" class="form_field_input" id="messageName" autocomplete="name" required/>';
    echo "\n" . '</div>';

    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messageEmail"><strong>Email</strong></label>';
    echo "\n" . '<input type="email" class="form_field_input" id="messageEmail" autocomplete="email" required/>';
    echo "\n" . '</div>';

    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messagePhone"><strong>Phone</strong></label>';
    echo "\n" . '<input type="tel" class="form_field_input" id="messagePhone" autocomplete="tel" required/>';
    echo "\n" . '</div>';

    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messageOrganization"><strong>Company</strong></label>';
    echo "\n" . '<input type="text" class="form_field_input" id="messageOrganization" autocomplete="organization"/>';
    echo "\n" . '</div>';
    echo "\n" . '</fieldset>';

    echo "\n" . '<fieldset class="form_box" id="postage_details">';
    echo "\n" . '    <legend class="form_subtitle">Postage Details</legend>';
    echo "\n" . '        <div class="form_row">';
    echo "\n" . '            <label class="form_field" for="postage_street_address"><strong>Address</strong></label>';
    echo "\n" . '            <textarea class="form_field_input" id="postage_street_address" required></textarea>';
    echo "\n" . '        </div>';
    echo "\n" . '</fieldset>';
  }

echo "\n" . '<fieldset class="form_box" id="cart_contents">';
echo "\n" . '    <!--display cart contents-->';
echo "\n" . '    <legend class="form_subtitle">Cart Overview</legend>';
echo "\n" . '    <table class="cart_table">';
/*-------------------------
Get Plants for the order.
--------------------------*/
  if(isset($_SESSION["Plants"]) && $_SESSION["Plants"] != ""){
    include("php/dblogin.php");

    $sql = "select * from plants";

    $parse = oci_parse($connect,$sql);
    if(!$parse){
      echo "Error Parsing SQL statement";
      exit;
    }

    oci_execute($parse);
    $count = 0;
    $arrOrders = array();
    $arrPlant = array();
    $seperator = "!@#$%";
    $plants = $_SESSION["Plants"];
    $numbers = $_SESSION["Number"];

    $arrIDs = array();
    $arrIDs = explode($seperator,$plants);

    $arrNums = array();
    $arrNums = explode($seperator,$numbers);
    $incr = 0;
    $match = "false";
    /*-------------------------
    Display all the plants chosen by the user.
    --------------------------*/
    while(oci_fetch_array($parse)){
      $id[$count] = oci_result($parse,"ID");
      $picture[$count] = oci_result($parse,"PICTURE");
      $common[$count] = oci_result($parse,"COMMON");
      $price[$count] = oci_result($parse,"PRICE");

      if($arrIDs[$incr] == $id[$count]){
        $arrPlant[$incr] = "";
        $picture[$incr] = oci_result($parse,"PICTURE");
        $common[$incr] = oci_result($parse,"COMMON");
        $price[$incr] = oci_result($parse,"PRICE");
        $arrOrders[$incr] = $picture[$incr] . $seperator . $common[$incr] . $seperator . $price[$incr] . $seperator . $arrNums[$incr];
        $incr++;
      }
      $count++;
    }

    /*-------------------------
    $plantResults Layout:
    $plantResults[0] = Picture
    $plantResults[1] = Common Name
    $plantResults[2] = Price
    $plantResults[3] = Quantity
    --------------------------*/
    /*-------------------------
    Output is displayed like this so it is well-formed and easy to read.
    --------------------------*/
    echo "\n <table class='cart_table'>";
    echo "\n     <tr class='cart_title'>";
    echo "\n         <td>Item pic</td>";
    echo "\n         <td>Product name</td>";
    echo "\n         <td>Unit price</td>";
    echo "\n         <td>Qty</td>";
    echo "\n         <td>Total</td>";
    echo "\n     </tr>";
    $show = 0;
    $shipping = 10.95;
    $totalPrice = 0;
    while($show < count($arrOrders)){
      $seperator = "!@#$%";
      $plantResults = explode($seperator,$arrOrders[$show]);
      $plantPrice = sprintf('%0.2f', $plantResults[2]);
      $total[$show] = sprintf('%0.2f', $plantResults[3] * $plantPrice);
      echo "\n    <tr>";
      echo "\n     <td>";
      echo "\n         <a href='category.php'>";
      echo "\n             <img src='images/plants/" . $plantResults[0] . "' style='border:0; width:50px; height:50px' class='cart_thumb' />";
      echo "\n         </a>";
      echo "\n     </td>";
      echo "\n     <td>" . $plantResults[1] . "</td>";
      echo "\n     <td>$" . $plantPrice . "</td>";
      echo "\n     <td>" . $plantResults[3] . "</td>";
      echo "\n     <td>" . $total[$show] . "</td>";
      echo "\n    </tr>";
      $totalPrice = sprintf('%0.2f', $totalPrice + $total[$show]);
      $show++;
    }

    echo "\n  <tr>";
    echo "\n      <td colspan='4' class='cart_total'>";
    echo "\n           <span class='red'>TOTAL SHIPPING:</span>";
    echo "\n       </td>";
    echo "\n      <td>$$shipping</td>";
    echo "\n  </tr>";
    echo "\n   <tr>";
    echo "\n       <td colspan='4' class='cart_total'>";
    echo "\n           <span class='red'>TOTAL:</span>";
    echo "\n       </td>";
    echo "\n       <td>$$totalPrice</td>";
    echo "\n  </tr>";
    echo "\n </table>";

  }
  else{
    echo "<span class='red'>Your Cart Is Empty</span>";
  }
  echo "\n </table>";
  echo "\n </fieldset>";
?>
