<?php
session_start();
require_once('dbhandler.php');
$userName   = $_POST['user-name'];
$password   = $_POST['password'];

//This code is vulnerable to SQL injection.
//todo: make it secure

$q = "SELECT * FROM users WHERE username = '$userName'; // AND password = '$password'";
$result = mysqli_query($dbc, $q);

while($row = $result->fetch_array()) { $the_rows[] = $row; }

if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if($row['password' == $password])
    $_SESSION['message'] = "Welcome";
} else {
    $_SESSION['message'] = "Welcome ". $row['first_name'].". You are logged in";
}

header("Location: index.php");


  
 






