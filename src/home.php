<?php
session_start();
if(!isset($_SESSION['authorized'])){
  header("Location: index.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Back!</title>
</head>
<body>
  <h1>Welcome back <?php echo $_SESSION['email']; ?></h1>
  <form action="home.php" method="post">
    <input type="submit" name="logout" value="Logout">
  </form>
</body>
</html>