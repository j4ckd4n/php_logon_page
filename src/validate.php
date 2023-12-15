<?php
session_start();
include("database.php");
$email_err = "";
$password_err = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['login'])){
    $email = $password = "";
    if(empty($_POST['email'])) {
      $email_err = "No email specified";
    } else {
      $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);
      if(!$email){
        $email_err = "Invalid email specified";
      }
    }

    if(empty($_POST['password'])){
      $password_err = "No password specified";
    } else {
      $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(validate_pass($email, $password)){
      $_SESSION['authorized'] = true;
      $_SESSION['email'] = $email;
      header("Location: home.php");
      exit();
    } else {
      $password_err = $email_err = "Invalid username or password.";
    }

    if(!empty($password_err) || !empty($email_err)){
      $errs_q = "Location: index.php?";
      if(!empty($password_err))
        $errs_q = $errs_q . "password_err={$password_err}";
      
      if(!empty($email_err)){
        $errs_q = $errs_q . "&email_err={$email_err}";
      }

      header($errs_q);
    }
  } elseif (isset($_POST['register'])){
    $email = $password = "";

    if(empty($_POST['email'])) {
      $email_err = "No email specified";
    } else {
      $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);
      if(!$email){
        $email_err = "Invalid email specified";
      }
    }

    if(empty($_POST['password']) || empty($_POST['confirm_password'])){
      $password_err = "Please fillout both fields.";
    } else {
      $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $confirm_password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      if($password == $confirm_password){
        if(add_user($email, $password)){
          $_SESSION['authorized'] = true;
          $_SESSION['email'] = $email;
          header("Location: home.php");
          exit();
        } else {
          $password_err = $email_err = "Failed to create account, name possibly exists";
        }
      } else {
        $password_err = "Passwords do not match";
      }
    }

    if(!empty($password_err) || !empty($email_err)){
      $errs_q = "Location: register.php?";
      if(!empty($password_err))
        $errs_q = $errs_q . "password_err={$password_err}";
      
      if(!empty($email_err)){
        $errs_q = $errs_q . "&email_err={$email_err}";
      }

      header($errs_q);
    }
  }
}
?>