<?php
session_start();
require_once ('dbhandler.php');

$firstName  = $_POST['first-name'];
$lastName   = $_POST['last-name'];
$userName   = $_POST['user-name'];
$email      = $_POST['email'];
$password   = $_POST['password'];

//todo: sanitize the post data
//check if the form is posted and the form values are not empty then run the code
if(($_SERVER['REQUEST_METHOD'] == 'POST') && !EmptyFormValue(array($firstName,$lastName,$userName,$email,$password))) {

    $q = "INSERT INTO users (first_name, last_name, email, username, password) Values ('$firstName', '$lastName', '$email', '$userName', '$password')";

    $result = mysqli_query($dbc, $q);

    if (mysqli_affected_rows($dbc) == 1) {

        //echo "You are created in the system";
        $_SESSION['message'] = "You are created in the system";

    } else {

        //echo mysqli_error($dbc);
          $_SESSION['message'] = mysqli_error($dbc);
    } 
} else {
     $_SESSION['message'] = "<span style='color: red'>All fields are required </span>";
}

header ("Location: index.php");


function EmptyFormValue($vars){
    foreach ($vars as $var) {
        if(empty($var)) {
            return true;
        }
    }
    return false;
}

?>






