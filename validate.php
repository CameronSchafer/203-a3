<?php
/*-------------------------
Ajax post Request to this php file.
This php file will process the AJAX request.
Will validate the Email/Phone-Number.
$email
$phone
$type
--------------------------*/

/*-------------------------
Email Validation pattern
$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
Reference:
http://stackoverflow.com/questions/13447539/php-preg-match-with-email-validation-issue
--------------------------*/
if($type == "email"){
  $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
  if(!preg_match($pattern,$email)){
    echo "<span id='respEmail' class='red'>Invalid Email Address</span>";
  }
  else{
    echo "good";
  }
}

/*-------------------------
Phone Number Validation pattern
preg_replace("/[^0-9]/", '', $string);
Then just check size 7 > $number < 12
Reference:
http://stackoverflow.com/questions/3090862/how-to-validate-phone-number-using-php
--------------------------*/
if($type == "phone"){
  $string = preg_replace("/[^0-9]/", '', $phone);
  $length = strlen($string);
  if($length <= 7 || $length > 12){
    echo "bad";
  }
  else{
    echo htmlentities($string);
  }
}

?>
