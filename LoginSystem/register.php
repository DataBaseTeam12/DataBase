<?php

session_start();

if(!isset($_SESSION['loggedIn']))
{
    header("Location: index.php");
}

include_once 'db.php';



// Escape all variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstName']);
$middle_initial = $mysqli->escape_string($_POST['midInitial']);
$last_name = $mysqli->escape_string($_POST['lastName']);
$pass = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$passAgain = $mysqli->escape_string($_POST['passwordAgain']);
$address = $mysqli->escape_string($_POST['address']);
$city = $mysqli->escape_string($_POST['city']);
$state = $mysqli->escape_string($_POST['state']);
$zip = $mysqli->escape_string($_POST['zip']);
$phone = $mysqli->escape_string($_POST['phone']);
$ssn = $mysqli->escape_string($_POST['ssn']);
$gender = $mysqli->escape_string($_POST['gender']);
$email = $mysqli->escape_string($_POST['email']);
$hash = $mysqli->escape_string( md5(rand(0, 1000)));

$error = false;

if (preg_match("/^[a-zA-Z ]+$/",$first_name))
{
    $error = true;
    $first_name_error = "First name can only contain alphabets";
}

if (preg_match("/^[a-zA-Z ]+$/",$last_name))
{
    $error = true;
    $first_name_error = "Last name can only contain alphabets";
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $error = true;
    $email_error = "Please Enter a Valid Email";
}

if($_POST['password'] != $_POST['passwordAgain'])
{
    $error = true;
    $password_error = "Password does not match";
}


if(strlen($passwordAgain) < 6)
{
    $error = true;
    $passwordLen_error = "Password should be at least have a length of 6";
}

$result = $mysqli->querry("SELECT * FROM Members WHERE email ='$email'") or die($mysqli->error());

if ($result->num_rows > 0)
{
    $error = true;
    $emailUsed_error = "email already in use";
}

if(!($error)) // if there are no errors, then proceed to add the data to the database.
{

}

?>