<?php
session_start();

include_once 'connectDB.php';


if(isset($_POST['register']))
{

// Escape all variables to protect against SQL injections
    $first_name = mysqli_real_escape_string($con, $_POST['firstName']);
    $middle_initial = mysqli_real_escape_string($con, $_POST['midInitial']);
    $last_name = mysqli_real_escape_string($con, $_POST['lastName']);
    $pass = mysqli_real_escape_string($con, password_hash($_POST['password'], PASSWORD_BCRYPT));
    $passAgain = mysqli_real_escape_string($con, $_POST['passwordAgain']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $zip = mysqli_real_escape_string($con, $_POST['zip']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $ssn = mysqli_real_escape_string($con, $_POST['ssn']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $hash = mysqli_real_escape_string($con, md5(rand(0, 1000)));


    $error = false;

    if (!preg_replace("/[^A-Z]+/", "", $first_name)) {
        $error = true;
        $firstName_error = "First name can only contain alphabets";
    }

    if (!preg_replace("/[^A-Z]+/", "", $last_name)) {
        $error = true;
        $lastName_error = "Last name can only contain alphabets";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter a Valid Email";
    }

    if ($_POST['password'] != $_POST['passwordAgain']) {
        $error = true;
        $passwordMatch_error = "Password does not match";
    }


    if (strlen($passAgain) < 6) {
        $error = true;
        $shortPassword = "Password should be at least have a length of 6";
    }

    $sql = "SELECT * FROM Member WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $error = true;
        echo "email already in use";
    }

    if (!($error)) // if there are no errors, then proceed to add the data to the database.
    {
        echo "creating user";
        $sql = "INSERT INTO Member
    (
        first_name,
        middle_initial,
        last_name,
        street_address,
        city,
        state,
        zip_code,
        phone_num,
        ssn,
        email,
        sex,
        password
    )
            VALUES
            (
                '$first_name',
                '$middle_initial',
                '$last_name',
                '$address',
                '$city',
                '$state',
                '$zip',
                '$phone',
                '$ssn',
                '$email',
                '$gender',
                '$pass'
            )";
       if($con->query($sql))
       {
           echo "user created";
           $_SESSION['logged_in'] = true;
       }
       else
       {
           echo "registration failed";
       }

    }
    echo $error;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="drop-down-menu.css">

</head>

<body>

<header>
    <div class="main">
        <h1><a href="http://www.databaseteam12.x10host.com"><font color="white">University of Houston</font></a></h1>
        <h3><a href="http://www.databaseteam12.x10host.com"><font color="white">Libraries</font></a></h3>
    </div>
    <div class="subhead">

    </div>
</header>

<nav>
    <a href="index.php" style="float:left;">Home</a>
    <a href="../../Documents/GitHub/DataBase/LoginSystem/login.php">Login</a>
</nav>


<div class="container">
    <div>
        <form method="post" action="" role="form" class="form-horizontal">
            <fieldset>
                <div>
                    <h2 class="wrapper"> Create Account</h2>
                </div>

                <div>
                    <label>First name</label>
                    <input name="firstName" type="text" placeholder="Enter First Name" class="form-control input-md" required="">
                    <span class="danger"><?php if(isset($firstName_error)) echo $firstName_error; ?> </span>
                </div>

                <div>
                    <label>Middle Initial</label>
                    <input name="midInitial" type="text" placeholder="Enter Middle Initial" maxlength="1">
                </div>


                <div>
                    <label>Last Name</label>
                    <input name="lastName" type="text" maxlength="25" placeholder="Enter Last Name" required="">
                    <span class="danger"><?php if(isset($lastName_error)) echo $lastName_error; ?> </span>

                </div>

                <div>
                    <label>Password</label>
                    <input name="password" type="password" maxlength="25" placeholder="Enter Password" required="">
                    <span class="danger"><?php if(isset($shortPassword)) echo $shortPassword; ?> </span>

                </div>

                <div>
                    <label>Repeat Password</label>
                    <input name="passwordAgain" type="password" maxlength="25" placeholder="Enter Password Again" required="">
                    <span class="danger"><?php if(isset($passwordMatch_error)) echo $passwordMatch_error; ?> </span>

                </div>

                <div>
                    <label>Address</label>
                    <input name="address" type="text" maxlength="30" placeholder="Enter Address" required="">
                </div>

                <div>
                    <label>City</label>
                    <input name="city" type="text" maxlength="25" placeholder="Enter City" required="">
                </div>

                <div>
                    <label>State</label>
                    <input name="state" type="text" maxlength="25" placeholder="Enter State" required="">
                </div>

                <div>
                    <label>Zip Code</label>
                    <input name="zip" type="text" maxlength="5" placeholder="Enter Zip Code" required="">
                </div>

                <div>
                    <label>Phone Number</label>
                    <input name="phone" type="text" maxlength="25" placeholder="Enter Phone Number" required="">
                </div>

                <div>
                    <label>SSN</label>
                    <input name="ssn" type="text" maxlength="25" placeholder="Enter SSN" required="">
                </div>

                <div>
                    <label>Sex</label>
                    <input type="radio" name="gender" id="gender" tabindex="2" > Male
                    <input type="radio" name="gender" id="gender" tabindex="2" > Female
                </div>
                <br>
                <div>
                    <label>Email</label>
                    <input name="email" type="email" maxlength="254" placeholder="Enter Email" required="">
                    <span class="danger"><?php if(isset($email_error)) echo $email_error; ?> </span>
                </div>

                <div class="wrapper">
                    <input type="submit" name="register" value="Register">
                </div>
            </fieldset>
        </form>
    </div>
</div>
<footer>
    &copy; Spring 2017 COSC 3380 Team 12
    <br><br>
    4333 University Drive
    <br>
    Houston, TX 77204-2000
</footer>
</body>
</html>