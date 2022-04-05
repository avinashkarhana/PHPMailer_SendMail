<?php
    $servername = "localhost"; // Cahnge with your database host name
    $username = "root"; // Change with your database username
    $password = ""; // Change with your database password
    $databaseName = "mailer_test"; // Change with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $databaseName);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>