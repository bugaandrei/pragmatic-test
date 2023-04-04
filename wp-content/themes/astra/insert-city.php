<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pragmatic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$city = $_POST['City'];

$sql = "INSERT INTO city (city)
VALUES ('$city')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
