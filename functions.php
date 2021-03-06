<?php
  require("connection.php");

  function createTable($table){
    global $conn;

    $sql = "CREATE TABLE $table (
              id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              email VARCHAR(50),
              reg_date TIMESTAMP
            )";
    $conn->query($sql);
  }

  function insertTable($table, $value){
    global $conn;

    $sql = "INSERT INTO $table (email) VALUES ('$value')";
    $conn->query($sql);
  }

  function getDataFrom($table){
    global $conn;

    $sql    = "SELECT id, email FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo $row["email"] . "<br>";
      }
    } else {
      echo "0 results";
    }
  }

  function clearDataFrom($table){
    global $conn;

    $sql = "DROP TABLE $table";
    $conn->query($sql);
  }

?>
