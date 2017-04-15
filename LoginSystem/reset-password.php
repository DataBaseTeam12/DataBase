<?php
include_once 'connectDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $hash = mysqli_real_escape_string($con, $_POST['hash']);
    $sql = "UPDATE Member SET password = '$pass', hash='$hash' WHERE email='$email'";

    if ($con->query($sql))
    {
        echo "<script>alert('Password Reset Completed')</script>";
    }
}