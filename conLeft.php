<?php
  if(isset($_SESSION["UserData"])){

    $seperator = "{||}";
    $info = $_SESSION["UserData"];
    $arr = array();
    $arr = explode($seperator,$info);
    $username = htmlentities($arr[1]);
    $email = htmlentities($arr[2]);
    $phone = htmlentities($arr[3]);
    $company = htmlentities($arr[4]);

    echo "\n" . '<div class="form_row">';
    echo "\n" . '<label class="form_field" for="messageName"><strong>Name</strong></label>';
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
  }
  else{
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
  }
?>
