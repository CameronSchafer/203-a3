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
$incrFeatured = 0;
$incrNew = 0;
while(oci_fetch_array($sqlCatalog)){
  if(oci_result($sqlCatalog,"FEATURED") == "true"){
    /*-------------------------
    Checks if plant is featured.
    --------------------------*/
    $common[$incrFeatured] = oci_result($sqlCatalog,"COMMON");
    $botan[$incrFeatured] = oci_result($sqlCatalog,"BOTAN");
    $price[$incrFeatured] = oci_result($sqlCatalog,"PRICE");
    $picture[$incrFeatured] = oci_result($sqlCatalog,"PICTURE");
    $descrip[$incrFeatured] = oci_result($sqlCatalog,"DESCRIP");
    $lightLevels[$incrFeatured] = oci_result($sqlCatalog,"LIGHTLEVELS");
    $seasons[$incrFeatured] = oci_result($sqlCatalog,"SEASONS");
    $zone[$incrFeatured] = oci_result($sqlCatalog,"ZONE");
    $plantFeatured[$incrFeatured] = $common[$incrFeatured] . $seperator . $botan[$incrFeatured] . $seperator . $price[$incrFeatured]
    . $seperator . $picture[$incrFeatured] . $seperator . $descrip[$incrFeatured] . $seperator . $lightLevels[$incrFeatured]
    . $seperator . $seasons[$incrFeatured] . $seperator . $zone[$incrFeatured];
    $incrFeatured++;
  }
  else if(oci_result($sqlCatalog,"NEW") == "true"){
    /*-------------------------
    Checks if plant is new.
    --------------------------*/
    $common[$incrNew] = oci_result($sqlCatalog,"COMMON");
    $botan[$incrNew] = oci_result($sqlCatalog,"BOTAN");
    $price[$incrNew] = oci_result($sqlCatalog,"PRICE");
    $picture[$incrNew] = oci_result($sqlCatalog,"PICTURE");
    $descrip[$incrNew] = oci_result($sqlCatalog,"DESCRIP");
    $lightLevels[$incrNew] = oci_result($sqlCatalog,"LIGHTLEVELS");
    $seasons[$incrNew] = oci_result($sqlCatalog,"SEASONS");
    $zone[$incrNew] = oci_result($sqlCatalog,"ZONE");
    $plantNew[$incrNew] = $common[$incrNew] . $seperator . $botan[$incrNew] . $seperator . $price[$incrNew]
    . $seperator . $picture[$incrNew] . $seperator . $descrip[$incrNew] . $seperator . $lightLevels[$incrNew]
    . $seperator . $seasons[$incrNew] . $seperator . $zone[$incrNew];
    $incrNew++;
  }
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
--------------------------*/
/*-------------------------
Print out the Featured plants.
Output is displayed like this so it is well-formed and easy to read.
--------------------------*/
$count = 0;
while($count < count($plantFeatured)){
  $plantResults = explode($seperator,$plantFeatured[$count]);
  $plantPrice = sprintf('%0.2f', $plantResults[2]);

  echo "\n    <div class='feat_prod_box'>";
  echo "\n       <div class='prod_img'>";
  echo "\n            <a href='category.php#" . $plantResults[0] . "-" . $plantResults[1] . "'>";
  echo "\n               <img src='./images/plants/" . $plantResults[3] . "' alt='" . $plantResults[0] . "' title='" . $plantResults[1] . "' style='border:0' class='thumb'/>";
  echo "\n           </a>";
  echo "\n       </div>";
  echo "\n       <div class='prod_det_box'>";
  echo "\n           <div class='box_top'></div>";
  echo "\n            <div class='box_center'>";
  echo "\n                <div class='prod_title'>$plantResults[0]</div>";
  echo "\n                <p class='details'>";
  echo "\n                  $plantResults[4]";
  echo "\n               </p>";
  echo "\n               <a href='category.php#" . $plantResults[0] . "-" . $plantResults[1] . "' class='more'>details</a>";
  echo "\n                <div class='clear'></div>";
  echo "\n           </div>";
  echo "\n            <div class='box_bottom'></div>";
  echo "\n       </div>";
  echo "\n       <div class='clear'></div>";
  echo "\n    </div>";
  $count++;
}

echo "\n    <div class='clear'></div>";
echo "\n    <div class='title'>";
echo "\n       <span class='title_icon'>";
echo "\n              <img src='images/bullet2.gif'/>";
echo "\n       </span>New products";
echo "\n    </div>";

/*-------------------------
Print out the New plants.
Output is displayed like this so it is well-formed and easy to read.
--------------------------*/
$count = 0;
while($count < 3){
  $plantResults = explode($seperator,$plantNew[$count]);
  $plantPrice = sprintf('%0.2f', $plantResults[2]);
  echo "\n    <div class='new_prod_box'>";
  echo "\n             <a href='category.php#" . $plantResults[0] . "-" . $plantResults[1] . "'>$plantResults[0]</a>";
  echo "\n         <div class='new_prod_bg'>";
  echo "\n            <span class='new_icon'>";
  echo "\n               <img src='./images/new_icon.gif'/>";
  echo "\n            </span>";
  echo "\n             <a href='category.php#" . $plantResults[0] . "-" . $plantResults[1] . "'>";
  echo "\n                <img src='./images/plants/" . $plantResults[3] . "' alt='" . $plantResults[0] . "' title='" . $plantResults[1] . "' style='border:0' class='thumb'/>";
  echo "\n             </a>";
  echo "\n         </div>";
  echo "\n    </div>";
  $count++;
}
?>
