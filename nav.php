<?php
/*-------------------------
Dynamic Nav bar.
--------------------------*/
if(isset($_SESSION["UserData"])){
  echo "\n" . '<li><a href="myaccount.php">My Account</a></li>';
  echo "\n" . '<li><a href="php/logout.php">Logout</a></li>';
}
else{
  echo "\n" . '<li><a href="myaccount.php">Sign In</a></li>';
  echo "\n" . '<li><a href="registerForm.php">Sign Up</a></li>';
}
?>
