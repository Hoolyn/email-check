<?php
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  //$url = parse_url("mysql://bedcfa9c81bcbc:2de34d08@us-cdbr-iron-east-04.cleardb.net/heroku_85b70443a176fdb?reconnect=true");

  $server   = $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $db = substr($url["path"], 1);

  // Create connection
  global $conn;
  $conn = new mysqli($server, $username, $password, $db);
?>

