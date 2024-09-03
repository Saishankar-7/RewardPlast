<?php
 $host = 'localhost';
 $username = 'root';
 $password = '';
 $database = 'project';

 // Create a database connection
 $conn = new mysqli($host, $username, $password, $database);

 // Check the connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

if (isset($_POST['username'])) {
    $username = $_POST['username'];
   
    // Update the user's type to 'user' based on the username
    $sql = "UPDATE clients SET user_type = 'admin' WHERE username = '$username'";

    if ($conn->query($sql) === TRUE) {
        echo "User promoted successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
