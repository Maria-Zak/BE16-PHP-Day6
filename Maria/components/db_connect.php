<?php

$localhost = "173.212.235.205"; //"localhost"; 
$username = "zakharovacodefac_admin"; //root
$password = "9I5?^yX.W#39"; //9I5?^yX.W#39
$dbname = "zakharovacodefac_login_with_crud"; //zakharovacodefac_login_with_crud

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
// } else {
//     echo "Successfully Connected";
}