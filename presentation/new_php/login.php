<?php
include 'php/connect-begin.php';

  session_start();

  // include_once 'connectDB.php';

  if(isset($_SESSION['logged_in']))
  {
    header("Location: http://www.databaseteam12.x10host.com/");
  }

  $error = false;

  if(isset($_POST['log_in']))
  {
    // prevent sql injection.
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $result = $con->query("SELECT * FROM Member WHERE email = '$email'");

    if ($result->num_rows == 0) {
      $error = true;
      $error_message = "Incorrect Email or Password";
    }
    else
    {
      $user = $result->fetch_assoc();

      if(password_verify($_POST['password'], $user['password']))
      {
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        $_SESSION['userAccount'] = $user['userAccount'];
        $_SESSION['logged_in'] = true;

        header("Location: http://www.databaseteam12.x10host.com/");
      }
      else
      {
        $error = true;
        $error_message = "Incorrect Email or Password";
      }
    }
  }

include 'php/connect-end.php';
?>
