<?php
$database_file = "/var/www/db/users.db";

function open_db(){
  global $database_file;
  $db = new SQLite3($database_file);
  $create_users = <<<SQL
  CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    creation_date DATETIME DEFAULT CURRENT_TIMESTAMP
  );
  SQL;

  $result = $db->exec($create_users);
  if(!$result) {
    die("Error creating users table: " . $db->lastErrorMsg());
  }

  return $db;
}

function validate_pass($email, $password) {
  $db = open_db();
  $query = "SELECT email, password FROM users where email=:email";

  $stmt = $db->prepare($query);
  $stmt->bindValue(':email', $email, SQLITE3_TEXT);

  $result = $stmt->execute();
  if($result){
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if($row) {
      $hash = $row['password'];
      $stmt->close();
      $db->close();

      return password_verify($password, $hash);
    }
  }

  $stmt->close();
  $db->close();
  return false;
}

function add_user($email, $password) {
  $db = open_db();
  $hash = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO users(email, password) VALUES (:email, :password);";
  $stmt = $db->prepare($query);
  $stmt->bindValue(":email", $email, SQLITE3_TEXT);
  $stmt->bindValue(":password", $hash, SQLITE3_TEXT);

  $result = $stmt->execute();
  
  if($result){
    $stmt->close();
    $db->close();
    return true;
  }
  $stmt->close();
  $db->close();
  return false;
}
?>