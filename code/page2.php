<?php
session_start(); // Start the session if not already started

// Function to get the user's name from the database
function getUserName() {
    // Replace these lines with your database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_SESSION['username']; // Assuming you store the logged-in user's username in a session variable

    // Modify the SQL query to select the name based on the username
    $sql = "SELECT name FROM clients WHERE username = '$username'";

    $result = $conn->query($sql);

    if ($result === false) {
        die("Error in SQL query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["name"];
    } else {
        return "Guest"; // Default name if user not found
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="page2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Add this CSS code to change the font of the sidebar */
        .sidebar {
            font-family: "Roboto", sans-serif;
            /* You can replace "Your-Font-Family" with the actual font family you want to use */
            font-size: 16px; /* Adjust the font size as needed */
        }
    </style>
</head>
<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>Welcome <?php echo getUserName(); ?>!</header>
        <ul>
            <li><a href="pendingrequest.php"><i class="fas fa-home"></i>PENDING REQUESTS</a></li>
            <li><a href="map.html"><i class="fas fa-stream"></i>RECYCLING CENTERS</a></li>
            <li><a href="adminpayments.php"><i class="fas fa-link"></i>PAYMENTS OVERVIEW</a></li>
            <li><a href="input.html"><i class="fas fa-qrcode"></i>LEADERBOARD MANAGEMENT</a></li>
            <li><a href="userlist.php"><i class="fas fa-envelope"></i>USER MANAGEMENT</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>LOG OUT</a></li>
        </ul>
    </div>
    <section class="background-container">
        <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
        <p class="pa">TURNING THE TRASH INTO TRESURE</p>
    </section>
    <script>
    document.body.style.overflow='hidden';
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
