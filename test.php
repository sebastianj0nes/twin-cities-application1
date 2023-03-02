<?php

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Perform a query
$sql = "SELECT * FROM city";
$result = mysqli_query($conn, $sql);

// Display the results
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "ID: " . $row["id"] . " Name: " . $row["name"] . "<br>";
  }
} else {
  echo "0 results";
}

// Close the connection
mysqli_close($conn);
?>