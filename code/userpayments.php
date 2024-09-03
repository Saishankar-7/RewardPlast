<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-color:#ccea7b;
        }
        section {
        width: 100%;
        background: linear-gradient(90deg, #1e0b04, #71412a);
        color: #fff;
        text-align: center;
        padding: 20px 0;
    }

    section h2 {
        text-align: center;
        font-size: 3em;
        text-align: center;
        background: linear-gradient(90deg, #1e0b04, #71412a);
        color: #fff;
        padding: 20px 0;
        margin: 0;
        width: 100%;
    }

    section p {
        text-align: center;
        font-size: 1.5em;
    }
    h1 {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            background-color:#ccea7b;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin-left:70px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            font-size:30px;
        }
        .goback-button {
      position: fixed; /* Fixed positioning */
      top: 20px; /* Adjust the top position as needed */
      left: 20px; /* Adjust the left position as needed */
      z-index: 9999; /* Ensure it's above other elements */
  cursor: pointer;
  background: linear-gradient(90deg,#1e0b04,#71412a);
  border-radius: 1px;
  left:40px;
  top:25px;
  font-size: 35px;
  color:white;
  padding: 6px 12px;
  transition: all .5s ease;
  }
    </style>
       <button class="goback-button"onclick="goBack()"><ion-icon name="arrow-back-outline"></ion-icon></button>
</head>
<body>
<section>
            <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
            <p class="pa">TURNING THE TRASH INTO TREASURE</p>
        </section>
        <h1>My Payments</h1>
<?php
// Start the session
session_start();

// Replace with your actual database credentials
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

// Retrieve the username from the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // SQL query to retrieve data for the specific username
    $sql = "SELECT * FROM payments WHERE username = ?";

    // Use a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are rows in the result set
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>Amount in Rupees</th><th>Payment Time</th></tr>";
            // Output data of the user
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $i++ . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["plasticAmount"] . "</td>";
                echo "<td>" . $row["payment_time"] . "</td>";
                // Add other data fields as needed
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No data found for the username: $username";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Username not found in session.";
}

// Close the database connection
$conn->close();
?>
<script>
  function goBack() {
      window.location.href = 'page1.php'; // Redirect back to page2.php
  }
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>   
</body>
</html>
