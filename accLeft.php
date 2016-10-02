<?php
  if(isset($_SESSION["UserData"])){
    $seperator = "{||}";
    $info = $_SESSION["UserData"];
    $arr = array();
    $arr = explode($seperator,$info);
    $user = htmlentities($arr[1]);
    echo '<strong class="details">';
    echo "  Welcome $user!";
    echo '</strong>';
  }
  else if(isset($_POST["login"])){    //Check if the login form is submitted.
    /*-------------------------
    Include the dblogin.php file that will allow connection to the oracle database.
    --------------------------*/
    include("php/dblogin.php");
    $sql = "select * from customers";
    $login = oci_parse($connect,$sql);

    if(!$login){
      echo "An error occurred in parsing the sql string.\n";
      exit;
    }
    oci_execute($login);

    $username = $_POST["username"];
    $password = $_POST["password"];
    /*-------------------------
    Salting and then MD5 the password before insertion into the database.
    --------------------------*/
    $salt = "YouCANTGuessTHISSalt!@#$%ZXC";
    $password = md5($salt.$password);

    $found = "false";
    //Loop through results of the sql query and try match username and password to a customer.
    while(oci_fetch_array($login)){
      $checkName = oci_result($login,"USERNAME");
      $checkPass = oci_result($login,"PASSWORD");
      if($checkName == $username && $checkPass == $password){
        $id = oci_result($login,"ID");
        $email = oci_result($login,"EMAIL");
        $phone = oci_result($login,"PHONE");
        $company = oci_result($login,"COMPANY");
        $found = "true";
      }
    }
    oci_close($connect);
    if($found == "true"){

      $seperator = "{||}";
      $_SESSION["UserData"] = htmlentities($id) . $seperator . htmlentities($username) . $seperator . htmlentities($email) . $seperator . htmlentities($phone)) . $seperator . htmlentities($company);
      $info = $_SESSION["UserData"];
      $arr = array();
      $arr = explode($seperator,$info);
      $user = htmlentities($arr[1]);
      echo '<strong class="details">';
      echo "  Welcome $user!";
      echo '</strong>';
    }
    else{
      /*-------------------------
      Show login form with erro if user entered invalid username and/or password.
      --------------------------*/
      echo '<form name="Login" method="post">';
      echo '  <fieldset class="form_box">';
      echo '    <legend class="form_subtitle">Sign In</legend>';
      echo '      <span class="red">Invalid Username and/or Password!</span>';
      echo '      <div class="form_row">';
      echo '        <label class="form_field" for="loginUsername"><strong>Username</strong></label>';
      echo '        <input type="text" class="form_field_input" id="loginUsername" autocomplete="username" required name="username"/>';
      echo '      </div>';
      echo '      <div class="form_row">';
      echo '        <label class="form_field" for="loginPassword"><strong>Password</strong></label>';
      echo '        <input type="password" class="form_field_input" id="loginPassword" autocomplete="current-password" required name="password"/>';
      echo '      </div>';
      echo '      <div class="form_row">';
      echo '        <input type="submit" class="form_submit" name="login" value="Login"/>';
      echo '      </div>';
      echo '  </fieldset>';
      echo '</form>';
    }
  }
  else if(!isset($_POST["login"]) && !isset($_SESSION["UserData"])){
    /*-------------------------
    Show login form if user is not logged in.
    --------------------------*/
    echo '<form name="Login" method="post">';
    echo '  <fieldset class="form_box">';
    echo '    <legend class="form_subtitle">Sign In</legend>';
    echo '      <div class="form_row">';
    echo '        <label class="form_field" for="loginUsername"><strong>Username</strong></label>';
    echo '        <input type="text" class="form_field_input" id="loginUsername" autocomplete="username" required name="username"/>';
    echo '      </div>';
    echo '      <div class="form_row">';
    echo '        <label class="form_field" for="loginPassword"><strong>Password</strong></label>';
    echo '        <input type="password" class="form_field_input" id="loginPassword" autocomplete="current-password" required name="password"/>';
    echo '      </div>';
    echo '      <div class="form_row">';
    echo '        <input type="submit" class="form_submit" name="login" value="Login"/>';
    echo '      </div>';
    echo '  </fieldset>';
    echo '</form>';
  }
?>
