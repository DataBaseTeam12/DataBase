<?php
session_start();

include_once 'connectDB.php';

if(isset($_SESSION['logged_in']))
{
    header("Location: http://www.databaseteam12.x10host.com/");
}

if(isset($_POST['register']))
{

// Escape all variables to protect against SQL injections
    $first_name = mysqli_real_escape_string($con, $_POST['firstName']);
    $middle_initial = mysqli_real_escape_string($con, $_POST['midInitial']);
    $last_name = mysqli_real_escape_string($con, $_POST['lastName']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
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

    if (!preg_match("/^[a-zA-Z]+$/", $first_name)) {
        $error = true;
        $firstName_error = "First name can only contain alphabets";
    }

    if(isset($_POST['midInitial']) && $middle_initial != "")
    {
        if (!preg_match("/^[a-zA-Z]{1}$/", $middle_initial)) {
            $error = true;
            $middle_initial_error = "Middle initial can only contain alphabets";
        }
    }

    if(!isset($_POST["gender"]))
    {
        $error = true;
        $gender_error = "Please select a gender.";
    }

    if (!preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $error = true;
        $lastName_error = "Last name can only contain alphabets";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $eml_error = "Please Enter a Valid Email";
    }

    if ($_POST['password'] != $_POST['passwordAgain']) {
        $error = true;
        $passwordMatch_error = "Password does not match";
    }

    if (preg_match('#[^0-9]#',$phone) && strlen($phone) != 10)
    {
        $error = true;
        $phone_error = "Phone number must be 10 digits long.";
    }
    else
    {
        $formatted_phone = preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $phone);
    }

    if (preg_match('#[^0-9]#',$ssn) && strlen($ssn) != 9)
    {
        $error = true;
        $snn_error = "SSN number must be 9 digits long.";
    }
    else
    {
        $formatted_ssn = preg_replace("/^(\d{3})(\d{2})(\d{4})$/", "$1-$2-$3", $ssn);
    }

    if(strlen($zip) != 5 && preg_match('#[^0-9]#',$zip) )
    {
        $error = true;
        $zip_error = "Zip code must have 5 digits.";
    }

    if (strlen($passAgain) < 6) {
        $error = true;
        $shortPassword = "Password needs to at least have a length of 6";
    }

    $sql = "SELECT * FROM Member WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $error = true;
        $email_error = "Email already in use";
    }

    $sql = "SELECT * FROM Member WHERE username = '$username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $error = true;
        $username_error = "Username already in use";
    }

    if (!($error)) // if there are no errors, then proceed to add the data to the database.
    {
        $sql = "INSERT INTO Member
    (
        first_name,
        middle_initial,
        last_name,
        username,
        street_address,
        city,
        state,
        zip_code,
        phone_num,
        ssn,
        email,
        sex,
        password,
        hash
    )
            VALUES
            (
                '$first_name',
                '$middle_initial',
                '$last_name',
                '$username',
                '$address',
                '$city',
                '$state',
                '$zip',
                '$formatted_phone',
                '$formatted_ssn',
                '$email',
                '$gender',
                '$pass',
                '$hash'
            )";
        if($con->query($sql))
        {
            $user = $result->fetch_assoc();
            $successReg = "Successfully Registered!";
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['userAccount'] = $user['userAccount'];
            $_SESSION['total_fines'] = $user['total_fines'];
            $_SESSION['logged_in'] = true;
            header("Location: http://www.databaseteam12.x10host.com/");

        }
        else
        {
            $errorReg = "Registration failed, try again later!";
        }

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="drop-down-menu.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<?php include "../new_page/common-header.html"; ?>
<nav>
</nav>

<div class="container">
    <div>
        <form method="post" action="" role="form" class="form-horizontal">
            <fieldset>
                <div class="text-success"><?php if (isset($successReg)) { echo $successReg; } ?></div>
                <div class="text-danger"><?php if (isset($errorReg)) { echo $errorReg; } ?></div>
                <div>
                    <h2 class="wrapper"> Create Account</h2>
                </div>

                <div>
                    <label>First name</label>
                    <input name="firstName" type="text" placeholder="Enter First Name" class="form-control input-md" required value="<?php if($error) echo $first_name; ?>">
                    <span class="text-danger"><?php if(isset($firstName_error)) echo $firstName_error; ?> </span>
                </div>

                <div>
                    <label>Middle Initial</label>
                    <input name="midInitial" type="text" placeholder="Enter Middle Initial" class="form-control input-md" maxlength="1">
                    <span class="text-danger"><?php if(isset($middle_initial_error)) echo $middle_initial_error; ?> </span>
                </div>


                <div>
                    <label>Last Name</label>
                    <input name="lastName" type="text" maxlength="25" placeholder="Enter Last Name" class="form-control input-md" required value="<?php if($error) echo $last_name; ?>">
                    <span class="text-danger"><?php if(isset($lastName_error)) echo $lastName_error; ?> </span>
                </div>

                <div>
                    <label>Username</label>
                    <input name="username" type="text" maxlength="25" placeholder="Enter Username" class="form-control input-md" required value="<?php if($error) echo $username; ?>">
                    <span class="text-danger"><?php if(isset($username_error)) echo $username_error; ?> </span>
                </div>

                <div>
                    <label>Password</label>
                    <input name="password" type="password" maxlength="25" placeholder="Enter Password" class="form-control input-md" required>
                    <span class="text-danger"><?php if(isset($shortPassword)) echo $shortPassword; ?> </span>
                </div>

                <div>
                    <label>Repeat Password</label>
                    <input name="passwordAgain" type="password" maxlength="25" placeholder="Enter Password Again" class="form-control input-md" required>
                    <span class="text-danger"><?php if(isset($passwordMatch_error)) echo $passwordMatch_error; ?> </span>
                </div>

                <div>
                    <label>Address</label>
                    <input name="address" type="text" maxlength="30" placeholder="Enter Address" class="form-control input-md" required value="<?php if($error) echo $address; ?>">
                </div>

                <div>
                    <label>City</label>
                    <input name="city" type="text" maxlength="25" placeholder="Enter City" class="form-control input-md" required value="<?php if($error) echo $city; ?>">
                </div>

                <div>
                    <label>State</label>
                    <input name="state" type="text" maxlength="25" placeholder="Enter State" class="form-control input-md" required value="<?php if($error) echo $state; ?>">
                </div>

                <div>
                    <label>Zip Code</label>
                    <input name="zip" type="text" maxlength="5" placeholder="Enter Zip Code" class="form-control input-md" required value="<?php if($error) echo $zip; ?>">
                    <span class="text-danger"><?php if(isset($zip_error)) echo $zip_error; ?> </span>
                </div>

                <div>
                    <label>Phone Number</label>
                    <input name="phone" type="text" maxlength="10" placeholder="Enter Phone Number" class="form-control input-md" required value="<?php if($error) echo $phone; ?>">
                    <span class="text-danger"><?php if(isset($phone_error)) echo $phone_error; ?> </span>
                </div>

                <div>
                    <label>SSN</label>
                    <input name="ssn" type="text" maxlength="9" placeholder="Enter SSN" class="form-control input-md" required value="<?php if($error) echo $ssn; ?>">
                    <span class="text-danger"><?php if(isset($snn_error)) echo $snn_error; ?> </span>
                </div>

                <div>
                    <label>Sex</label>
                    <input type="radio" name="gender" value="Male" tabindex="4" > Male
                    <input type="radio" name="gender" value="Female" tabindex="4" > Female
                    <span class="text-danger"><?php if(isset($gender_error)) echo $gender_error; ?> </span>
                </div>
                <br>
                <div>
                    <label>Email</label>
                    <input name="email" type="email" maxlength="30" placeholder="Enter Email" class="form-control input-md" required value="<?php if($error) echo $email; ?>">
                    <span class="text-danger"><?php if(isset($email_error)) echo $email_error; ?> </span>
                </div>

                <div class="wrapper">
                    <input type="submit" name="register" value="Register" class="btn btn-primary">
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php include "../new_page/common-footer.html"; ?>
</body>
</html>