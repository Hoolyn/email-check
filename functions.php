<?php
  require("connection.php");

  function createTable($table){
    $sql    = "SELECT ID FROM $table";
    $result = $conn->query($sql);

    if(empty($result)) {
      $sql = "CREATE TABLE $table (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(50),
                reg_date TIMESTAMP
              )";

      if ($conn->query($sql) === TRUE) {
        echo "Table $table created successfully";
      } else {
        echo "Error creating table: " . $conn->error;
      }
    }

    $conn->close();
  }

  function insertTable($table, $value){
    $sql = "INSERT INTO $table (email) VALUES ($value)";
    $conn->query($sql);

    $conn->close();
  }

  function getDataFrom($table){
    $sql    = "SELECT id, email FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Email: " . $row["email"] . "<br>";
      }
    } else {
      echo "0 results";
    }

    $conn->close();
  }
?>
