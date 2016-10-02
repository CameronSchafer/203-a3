<?php
/*-------------------------
Include the dblogin.php file that will allow connection to the oracle database.
--------------------------*/
include("php/dblogin.php");
//connection to the database is started.

$sql = "select * from plants";
$sqlCatalog = oci_parse($connect,$sql);
if(!$sqlCatalog){
  echo "An error occurred in parsing the sql string.\n";
  exit;
}
oci_execute($sqlCatalog);
$seperator = "{||}";
$incr = 0;
/*-------------------------
Display all the plants.
--------------------------*/
while(oci_fetch_array($sqlCatalog)){
  $common[$incr] = oci_result($sqlCatalog,"COMMON");
  $botan[$incr] = oci_result($sqlCatalog,"BOTAN");
  $price[$incr] = oci_result($sqlCatalog,"PRICE");
  $picture[$incr] = oci_result($sqlCatalog,"PICTURE");
  $descrip[$incr] = oci_result($sqlCatalog,"DESCRIP");
  $lightLevels[$incr] = oci_result($sqlCatalog,"LIGHTLEVELS");
  $seasons[$incr] = oci_result($sqlCatalog,"SEASONS");
  $zone[$incr] = oci_result($sqlCatalog,"ZONE");
  $id[$incr] = oci_result($sqlCatalog,"ID");
  $plantInfo[$incr] = $common[$incr] . $seperator . $botan[$incr] . $seperator . $price[$incr]
  . $seperator . $picture[$incr] . $seperator . $descrip[$incr] . $seperator . $lightLevels[$incr]
  . $seperator . $seasons[$incr] . $seperator . $zone[$incr] . $seperator . $id[$incr];

  $incr++;
}
oci_close($connect);
/*-------------------------
$plantResults Layout:
$plantResults[0] = Common Name
$plantResults[1] = Botanical Name
$plantResults[2] = Price
$plantResults[3] = Picture
$plantResults[4] = Description
$plantResults[5] = Light Levels
$plantResults[6] = Seasons
$plantResults[7] = Zones
$plantResults[8] = IDs
--------------------------*/
/*-------------------------
Output is displayed like this so it is well-formed and easy to read.
--------------------------*/
$count = 0;
while($count < count($plantInfo)){
  $plantResults = explode($seperator,$plantInfo[$count]);
  $plantPrice = sprintf('%0.2f', $plantResults[2]);
  echo "\n  <div class='feat_prod_box'>";
  echo "\n    <div class='prod_img'>";
  echo "\n      <img style='border:0' title='" . $plantResults[0] . "' alt='" . $plantResults[1] . "' src='./images/plants/" . $plantResults[3] . "'/>";
  echo "\n      <br><br>";
  echo "\n      <a rel='lightbox' href='images/plants/" . $plantResults[3] . "'>";
  echo "\n        <img style='border:0' src='images/zoom.gif' />";
  echo "\n      </a>";
  echo "\n    </div>";
  echo "\n    <div class='prod_det_box'>";
  echo "\n      <div class='box_top'></div>";
  echo "\n      <div class='box_center'>";
  echo "\n        <div id='" . $plantResults[0] . "' class='prod_title'>$plantResults[0]</div>";
  echo "\n        <div class='prod_subtitle'>$plantResults[1]</div>";
  echo "\n        <p class='details'>$plantResults[4]</p>";
  echo "\n        <br>";
  echo "\n        <div>";
  echo "\n          <strong style='margin-left:15px'>  Light Levels: </strong>";
  echo "\n          <span>  $plantResults[5]</span>";
  echo "\n        </div>";
  echo "\n        <br>";
  echo "\n        <div>";
  echo "\n          <strong style='margin-left:15px'>  Hardiness Zones: </strong>";
  echo "\n          <span>  $plantResults[7]</span>";
  echo "\n        </div>";
  echo "\n        <br>";
  echo "\n        <div>";
  echo "\n          <strong style='margin-left:15px'>  Seasons: </strong>";
  echo "\n          <span>  $plantResults[6]</span>";
  echo "\n        </div>";
  echo "\n        <br>";
  echo "\n        <div>";
  echo "\n          <strong style='margin-left:15px'>  Price: </strong>";
  echo "\n          <span class='red'>$$plantPrice</span>";
  echo "\n        </div>";
  echo "\n        <a class='more' href='http://www.deakin.edu.au/~cschafer/ass1/cart.php?id=" . $plantResults[8] . "'><img style='border:0' src='./images/order_now.gif'></a>";
  echo "\n        <div class='clear'></div>";
  echo "\n      </div>";
  echo "\n      <div class='box_bottom'></div>";
  echo "\n    </div>";
  echo "\n    <div class='clear'></div>";
  echo "\n  </div>";
  $count++;
}
?>
