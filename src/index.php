<?php
session_start();
if(isset($_SESSION['authorized'])){
  header("Location: home.php");
}

$password_err = $email_err = "";

if($_SERVER["REQUEST_METHOD"] == "GET"){
  if(isset($_GET["password_err"])){
    $password_err = filter_input(INPUT_GET, "password_err", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if(isset($_GET["email_err"])) {
    $email_err = filter_input(INPUT_GET, "email_err", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  
  <title>Logon Page</title>
</head>
<body data-bs-theme="dark">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card" id="card">
          <div class="card-header d-flex align-items-center" id="card-header">
            <img src="img/logo.png" alt="Logo" class="img-fluid" style="max-width: 64px;">
            <h2 class="ms-3 mb-0"><b>Login</b></h2>
          </div>
          <div class="card-body" id="card-body">
            <form action="validate.php" method="post" id="login-form">
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <?php if(!empty($email_err)): ?>
                  <input type="email" class="form-control is-invalid" id="email" name="email" placeholder="name@example.com">
                  <div class="invalid-feedback">
                    <?php echo $email_err; ?>
                  </div>
                <?php else: ?>
                  <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <?php if(!empty($password_err)): ?>
                  <input type="password" class="form-control is-invalid" id="password" name="password">
                  <div class="invalid-feedback">
                    <?php echo $password_err; ?>
                  </div>
                <?php else: ?>
                  <input type="password" class="form-control" id="password" name="password">
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <input type="submit" class="btn btn-primary" name="login" value="Login">
              </div>
            </form>
            <hr>
            <div class="text-center">
              <a href="register.php">Register</a> | <a href="#">Forgot Password</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>