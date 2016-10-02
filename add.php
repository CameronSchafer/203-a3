<?php
session_start();
$seperator = "{||}";
/*-------------------------
Methods to Add products to the order.
--------------------------*/
if(isset($_SESSION["Plants"]) && $_SESSION["Plants"] != ""){
  $plants = $_SESSION["Plants"];
  $numbers = $_SESSION["Number"];
  $cartPrice = $_SESSION["CartPrice"];
  $cartNum = (int)$_SESSION["CartNum"];

  $arrPlants = array();
  $arrPlants = explode($seperator,$plants);

  $arrNums = array();
  $arrNums = explode($seperator,$numbers);

  $count = 0;
  $match = "false";
  /*-------------------------
  Loops for a plant match.
  If it matches it increments the plants count by 1.
  --------------------------*/
  while($count < count($arrPlants)){
    if((int)$arrPlants[$count] == (int)$id){
      $arrNums[$count] = (int)$arrNums[$count];
      $arrNums[$count]++;
      $match = "true";
    }
  }
  /*-------------------------
  If no match then append new plant on end of both arrays.
  --------------------------*/
  if($match == "false"){
    $num = count($arrPlants) + 1;
    $arrPlants[$num] .= $seperator . $id;
    $arrNums[$num] .= $seperator . "1";
  }

  include("php/dblogin.php");
  $sql = "select * from plants";
  $parse = oci_parse($connect,$sql);
  if(!$parse){
    echo "Error Parsing SQL statement";
    exit;
  }
  oci_execute($parse);

  $plantID = $_POST["id"];
  while(oci_fetch_array($parse)){
    $id = oci_result($parse,"ID");
    $plantPrice = oci_result($parse,"PRICE");

    if($plantID == $id){
      $cartPrice += $plantPrice;
      $cartNum += 1;
      break;
    }
  }
  oci_close($connect);

  /*-------------------------
  Turn arrays back into strings then set the SESSION variables.
  --------------------------*/
  $plants = implode($seperator,$arrPlants);
  $numbers = implode($seperator,$arrNums);
  $_SESSION["Plants"] = $plants;
  $_SESSION["Number"] = $numbers;
  $_SESSION["CartPrice"] = $cartPrice;
  $_SESSION["CartNum"] = $cartNum;
}
else{
  /*-------------------------
  If Plants SESSION variable is not set.
  --------------------------*/
  include("php/dblogin.php");
  $sql = "select * from plants";
  $parse = oci_parse($connect,$sql);
  if(!$parse){
    echo "Error Parsing SQL statement";
    exit;
  }
  oci_execute($parse);

  $plantID = $_POST["id"];
  while(oci_fetch_array($parse)){
    $id = oci_result($parse,"ID");
    $plantPrice = oci_result($parse,"PRICE");

    if($plantID == $id){
      $price = $plantPrice;
      break;
    }
  }

  oci_close($connect);

  $_SESSION["Plants"] = "";
  $_SESSION["Number"] = "";
  $_SESSION["CartPrice"] = 0;
  $_SESSION["CartNum"] = 0;

  $_SESSION["Plants"] = "$plantID";
  $_SESSION["Number"] = "1";
  $_SESSION["CartPrice"] = $price;
  $_SESSION["CartNum"] = 1;
}

/*-------------------------
Comment layout
--------------------------*/
?>
