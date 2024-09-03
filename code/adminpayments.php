<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>payments overview</title>
    <style>
        body{
            background-color:#ccea7b;
        }
         section {
    width:100%;
    background: linear-gradient(90deg, #1e0b04, #71412a);
    color: #fff;
    text-align: center;
    padding: 20px 0;
}
section h2{
     text-align: center;
     font-size: 3em;
     text-align: center;
     background: linear-gradient(90deg, #1e0b04, #71412a);
    color: #fff;
    padding: 20px 0;
    margin: 0;
     width: 100%;
}
section p{
    text-align: center;
    font-size: 1.5em;
}
  h1{
    display: flex;
    align-items:center;
    justify-content: center;
    flex-direction:column;
  }
  table {
            width: 90%;
            border-collapse: collapse;
            margin: 20px auto; /* Center the table horizontally */
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
            color: #333; /* Text color */
            border-radius: 8px; /* Rounded corners for the table */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a shadow to the table */
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-size:30px;
            background-color: #007bff;
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
  /* Styles for the search container */
  .search-container {
        float: right;
        position: relative;
        top:-50px;
        margin-right:30px;
    }

    /* Styles for the search box */
    .search-box {
        padding: 10px 30px 10px 20px; /* Adjust padding as needed */
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Styles for the search icon */
    .search-icon {
        position: absolute;
        top: 50%; /* Vertically center the icon */
        right: 10px;
        transform: translateY(-50%); /* Vertically center the icon */
        cursor: pointer;
    }
   </style>
    <button class="goback-button"onclick="goBack()"><ion-icon name="arrow-back-outline"></ion-icon></button>
</head>
<body>
   <section>
            <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
            <p class="pa">TURNING THE TRASH INTO TREASURE</p>
        </section>
    <div class="line-container">
        <hr class="line">
    </div>
<h1>PAYMENTS OVERVIEW</h1>
<div class="search-container">
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for usernames..." class="search-box">
    <span class="search-icon"><ion-icon name="search"></ion-icon></span>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Amount IN Rupees</th>
        <th>Payment Time</th>
    </tr>
    </thead>
    <tbody>
    <?php
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
    // SQL query to retrieve data from the database
    $sql = "SELECT  username, plasticAmount,payment_time FROM payments";

    // Execute the query
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Check if there are rows in the result set
    if ($result->num_rows > 0) {
        // Output data of each row
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['plasticAmount'] . "</td>";
            echo "<td>" . $row['payment_time'] . "</td>";
            echo "</tr>";
        }
        
    } else {
        echo "<tr><td colspan='3'>No data found</td></tr>";
    }

    // Close the database connection
    $conn->close();
    ?>
    </tbody>
</table>
<script>
  function goBack() {
      window.location.href = 'page2.php'; // Redirect back to page2.php
  }
</script>
<script>
function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Change index to match the column you want to search (0 is ID, 1 is Username)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>   
</body>
</html>
