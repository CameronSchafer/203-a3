<?php
/*-------------------------
Ajax post Request to this php file.
This php file will process the AJAX request.
Will echo the result, which will be displayed in the users browser.
$keywords
$light
$minPrice
$maxPrice
--------------------------*/

/*-------------------------
Include the dblogin.php file that will allow connection to the oracle database.
--------------------------*/
include("dblogin.php");
//connection to the database is started.

$sqlKeyword = "select * from plants";
$sqlSearch = oci_parse($connect,$sqlKeyword);
if(!$sqlSearch){
  echo "An error occurred in parsing the sql string.\n";
  exit;
}
oci_execute($sqlSearch);
/*-------------------------
loop for finding plant features and then setting features to a string within an array.
common: Common Name.
botan: Botanical Name.
price: Price.
descrip: Description.
lightlevels: Light Levels.
seasons: Seasons.
zone: Zone.
--------------------------*/
$countMatches = 10;
//$plantInfo = array();
$incr = 0;
$pregCheck = "/$keywords/i";
$pregLight = "/$light/i";
$seperator = "!@#$%%$#@!";

while(oci_fetch_array($sqlSearch)){
  $common[$incr] = oci_result($sqlSearch,"COMMON");
  $botan[$incr] = oci_result($sqlSearch,"BOTAN");
  $price[$incr] = oci_result($sqlSearch,"PRICE");
  $picture[$incr] = oci_result($sqlSearch,"PICTURE");
  $descrip[$incr] = oci_result($sqlSearch,"DESCRIP");
  $lightLevels[$incr] = oci_result($sqlSearch,"LIGHTLEVELS");
  $seasons[$incr] = oci_result($sqlSearch,"SEASONS");
  $zone[$incr] = oci_result($sqlSearch,"ZONE");
  $ids[$incr] = oci_result($sqlSearch,"ID");
  $plantInfo[$incr] = $common[$incr] . $seperator . $botan[$incr] . $seperator . $price[$incr]
  . $seperator . $picture[$incr] . $seperator . $descrip[$incr] . $seperator . $lightLevels[$incr]
  . $seperator . $seasons[$incr] . $seperator . $zone[$incr] . $seperator . $ids[$incr];

  $incr++;
}
oci_close($connect);

$count = 0;
$check = 0;
$plantCheck = array();
while($count < count($plantInfo)){
  /*-------------------------
  Check for Keyword, Light, Minimum Price & Maximum Price
  --------------------------*/
  if($light != "" && $minPrice > 0 && $maxPrice > 0){
    if(preg_match($pregCheck,$plantInfo[$count])){    //Keyword Check.
      if(preg_match($pregLight,$lightLevels[$count])){  //LightLevels Check.
        if($minPrice < $price[$count] && $maxPrice > $price[$count]){   //Price Range Check.
          $plantCheck[$check] = $plantInfo[$count];   //If plant passes all tests then it is saved to array.
          $check++;
        }
      }
    }
  }
  /*-------------------------
  Check for Keyword, Light & Minimum Price.
  --------------------------*/
  else if($light != "" && $minPrice > 0 && $maxPrice == 0){
    if(preg_match($pregCheck,$plantInfo[$count])){    //Keyword Check.
      if(preg_match($pregLight,$lightLevels[$count])){  //LightLevels Check.
        if($minPrice < $price[$count]){   //Price Range Check.
          $plantCheck[$check] = $plantInfo[$count];   //If plant passes all tests then it is saved to array.
          $check++;
        }
      }
    }
  }
  /*-------------------------
  Check for Keyword, Light & Maximum Price.
  --------------------------*/
  else if($light != "" && $minPrice == 0 && $maxPrice > 0){
    if(preg_match($pregCheck,$plantInfo[$count])){    //Keyword Check.
      if(preg_match($pregLight,$lightLevels[$count])){  //LightLevels Check.
        if($maxPrice > $price[$count]){   //Price Range Check.
          $plantCheck[$check] = $plantInfo[$count];   //If plant passes all tests then it is saved to array.
          $check++;
        }
      }
    }
  }
  /*-------------------------
  Check for Keyword & Light.
  --------------------------*/
  else if($light != "" && $minPrice == 0 && $maxPrice == 0){
    if(preg_match($pregCheck,$plantInfo[$count])){    //Keyword Check.
      if(preg_match($pregLight,$lightLevels[$count])){  //LightLevels Check.
        $plantCheck[$check] = $plantInfo[$count];   //If plant passes all tests then it is saved to array.
        $check++;
      }
    }
  }
  /*-------------------------
  Check for Keyword, Minimum Price & Maximum Price.
  --------------------------*/
  else if($light == "" && $minPrice > 0 && $maxPrice > 0){
    if(preg_match($pregCheck,$plantInfo[$count])){    //Keyword Check.
      if($minPrice < $price[$count] && $maxPrice > $price[$count]){
        $plantCheck[$check] = $plantInfo[$count];   //If plant passes all tests then it is saved to array.
        $check++;
      }
    }
  }
  /*-------------------------
  Check for Keyword & Minimum Price.
  --------------------------*/
  else if($light == "" && $minPrice > 0 && $maxPrice == 0){
    if(preg_match($pregCheck,$plantInfo[$count])){    //Keyword Check.
      if($minPrice < $price[$count]){
        $plantCheck[$check] = $plantInfo[$count];   //If plant passes all tests then it is saved to array.
        $check++;
      }
    }
  }
  /*-------------------------
  Check for Keyword & Maximum Price.
  --------------------------*/
  else if($light == "" && $minPrice == 0 && $maxPrice > 0){
    if(preg_match($pregCheck,$plantInfo[$count])){    //Keyword Check.
      if($maxPrice > $price[$count]){
        $plantCheck[$check] = $plantInfo[$count];   //If plant passes all tests then it is saved to array.
        $check++;
      }
    }
  }
  /*-------------------------
  Check for Keyword.
  --------------------------*/
  else if($light == "" && $minPrice == 0 && $maxPrice == 0){
    if(preg_match($pregCheck,$plantInfo[$count])){    //Keyword Check.
      $plantCheck[$check] = $plantInfo[$count];   //If plant passes all tests then it is saved to array.
      $check++;
    }
  }
  $count++; //Increments the variable count by 1 at the end of each loop.
}

/*-------------------------
Sets Variables to show the user what they searched for.
--------------------------*/
$w = $keywords;
$l = $light;
$min = $minPrice;
$max = $maxPrice;
if($light == ""){
  $l = "any";
}
if($minPrice == 0){
  $min = "$0.00";
}else{
  $min = sprintf('%0.2f', $min);
  $min = "$$min";
}
if($maxPrice == 0){
  $max = "Any";
}else{
  $max = sprintf('%0.2f', $max);
  $max = "$$max";
}
/*-------------------------
Print out the title Results.
--------------------------*/
echo "\n  <div class='clear'></div>";
echo "\n  <br>";
echo "\n  <br>";
echo "\n  <div class='title' id='results'>";
echo "\n    <span class ='title_icon'>";
echo "\n      <img src='images/bullet1.gif' />";
echo "\n    </span>";
echo "\n    Results";
echo "\n    SEARCH TERMS:";
echo "\n      Keyword: htmlentities($w)";
echo "\n      Light: htmlentities($l)";
echo "\n      Price Range: htmlentities($min) -> htmlentities($max)";
echo "\n  </div>";


$count = 0;   //Set count to 0 for the print loop.
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
Print out the plants that were found in the search.
Output is displayed like this so it is well-formed and easy to read.
--------------------------*/
while($count < count($plantCheck)){
  $plantResults = explode($seperator,$plantCheck[$count]);
  $plantPrice = sprintf('%0.2f', $plantResults[2]);
  echo "\n  <div class='feat_prod_box'>";
  echo "\n    <div class='prod_img'>";
  echo "\n      <img style='border:0' title='" . $plantResults[0] . "' alt='" . $plantResults[1] . "' src='./images/plants/" . $plantResults[3] . "'/>";
  echo "\n      <br><br>";
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
  echo "\n        <a class='more' href='http://www.deakin.edu.au/~cschafer/ass1/cart.php?id=" . $plantResults[8] . "' ><img style='border:0' src='./images/order_now.gif'></a>";
  echo "\n        <div class='clear'></div>";
  echo "\n      </div>";
  echo "\n      <div class='box_bottom'></div>";
  echo "\n    </div>";
  echo "\n    <div class='clear'></div>";
  echo "\n  </div>";
  $count++;
}

/*-------------------------
Print out that no plants were found with those search parameters.
--------------------------*/
if(count($plantCheck) == 0){
  echo "\n<span class='resp'>No plants were found.</span>";
}
?>
