<?php
/*-------------------------
Ajax post Request to this php file.
This php file will process the AJAX request.
Will create a new user in the customer table.
user
pass
em
pn
company
address
--------------------------*/
//Start Session.
session_start();
/*-------------------------
Include the dblogin.php file that will allow connection to the oracle databse.
--------------------------*/
include("dblogin.php");

//Sets the sql statement to a variable.
$sqlID = "select * from customers";
//Parses the sql statement.
$idCheck = oci_parse($connect,$sqlID);
if(!$idCheck){
	echo "An error occurred in parsing the sql string.\n";
	exit;
}
//Executes the sql statement.
oci_execute($idCheck);

$id = 0;
while(oci_fetch_array($idCheck)){
  if(oci_result($idCheck,"ID") > $id){
    $id = oci_result($idCheck,"ID");
  }
}
$id++;
//Closes the connection to the database.
oci_close($connect);

/*-------------------------
Include the dblogin.php file that will allow connection to the oracle databse.
--------------------------*/
include("dblogin.php");
//Sets the sql statement to a variable.
$sqlCustomer = "insert into customers(ID,USERNAME,PASSWORD,EMAIL,PHONE,COMPANY,ADDRESS)
                values(:id,:username,:password,:email,:phone,:company,:address)";
//Parses the sql statement.
$insert = oci_parse($connect,$sqlCustomer);
if(!$insert){
	echo "An error occurred in parsing the sql string.\n";
	exit;
}

//Non-Required field checks.
$company = htmlentities($_POST["company"]);
if(strlen($company) == 0){
	$company = "";
}
$address = htmlentities($_POST["address"]);
if(strlen($address) == 0){
	$address = "";
}

$user = $_POST["user"];
$pass = $_POST["pass"];
/*-------------------------
Salting and then MD5 the password before insertion into the database.
--------------------------*/
$salt = "YouCANTGuessTHISSalt!@#$%ZXC";
$pass = md5($salt.$pass);

$em = $_POST["em"];
$pn = $_POST["pn"];
/*-------------------------
Parameterized queries used to prevent sql injection.
--------------------------*/
oci_bind_by_name($insert,":id",$id);
oci_bind_by_name($insert,":username",$user);
oci_bind_by_name($insert,":password",$pass);
oci_bind_by_name($insert,":email",$em);
oci_bind_by_name($insert,":phone",$pn);
oci_bind_by_name($insert,":company",$company);
oci_bind_by_name($insert,":address",$address);

//Executes the sql statement.
oci_execute($insert);
//Closes the connection to the database.
oci_close($connect);

//
$seperator = "{||}";
$_SESSION["UserData"] = htmlentities($id) . $seperator . htmlentities($user) . $seperator . htmlentities($em) . $seperator . htmlentities($pn) . $seperator . htmlentities($company);

header("location:http://www.deakin.edu.au/~cschafer/ass2/myaccount.php");  // Redirect to the login page.
?>
