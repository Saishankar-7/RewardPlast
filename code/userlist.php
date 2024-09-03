<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
          
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', 'sans-serif';
}
         body {
            font-family: Arial, sans-serif;
            background-color:#ccea7b;
            margin: 0;
            padding: 0;
        }
        section {
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
        h1 {
            text-align: center;
            background-color: #ccea7b;
            padding: 20px;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            font-size:30px;
        }
        /* Style for buttons */
        button.demote {
            background-color: blue;
            color: white;
        }

        button.promote {
            background-color: green;
            color: white;
        }

        button.remove {
            background-color: red;
            color: white;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .goback-button {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 9999;
            cursor: pointer;
            background: linear-gradient(90deg, #1e0b04, #71412a);
            border-radius: 1px;
            left: 40px;
            top: 25px;
            font-size: 35px;
            color: white;
            padding: 6px 12px;
            transition: all .5s ease;
        }
    </style>
     <button class="goback-button" onclick="goBack()"><ion-icon name="arrow-back-outline"></ion-icon></button>
</head>
<body>
<section>
    <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
    <p class="pa">TURNING THE TRASH INTO TREASURE</p>
</section>
<div class="line-container">
    <hr class="line">
</div>
<h1>User Management</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>USERNAME</th>
            <th>USER_TYPE</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
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
         // SQL query to retrieve data from the database
         $sql = "SELECT  name,email,username,user_type FROM clients";
     
         // Execute the query
         $result = $conn->query($sql);
     
         if (!$result) {
             die("Query failed: " . mysqli_error($conn));
         }
         
    // Check if there are rows in the result set
    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['user_type'] . "</td>";
            echo "<td class='action-buttons'>";
            
            // Conditionally display the "Demote" button if user_type is "admin"
            if ($row['user_type'] == 'admin') {
                echo "<button class='demote' onclick='demoteUser(this)' data-username='" . $row['username'] . "'>Demote</button>";
            } else {
                echo "<button class='promote' onclick='promoteUser(this)' data-username='" . $row['username'] . "'>Promote</button>";
            }
            
            echo "<button class='remove' onclick='removeUser(this)' data-username='" . $row['username'] . "'>Remove</button>";
            echo "</td>"; 
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No users found</td></tr>";
    }
    // Close the database connection
    $conn->close();
    ?>
    </tbody>
</table>
<script>
    function demoteUser(button) {
        // Access the data-username attribute from the button element
        var username = button.getAttribute('data-username');
        
        console.log("Demote button clicked for username: " + username);        
            // Send an AJAX request to the new PHP script
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'demote.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Check if the response indicates success
                    if (xhr.responseText === "User demoted successfully") {
                        alert("User demoted successfully");
                        location.reload();
                    } else {
                        // Handle error messages here if needed
                        console.log("Error: " + xhr.responseText);
                    }
                }
            };
            
            // Send the request with the username
            xhr.send('username=' + username);
    }
    function promoteUser(button) {
        // Access the data-username attribute from the button element
        var username = button.getAttribute('data-username');
        
        console.log("Demote button clicked for username: " + username);        
            // Send an AJAX request to the new PHP script
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'promote.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Check if the response indicates success
                    if (xhr.responseText === "User promoted successfully") {
                        alert("User promoted successfully");
                        location.reload();
                    } else {
                        // Handle error messages here if needed
                        console.log("Error: " + xhr.responseText);
                    }
                }
            };
            
            // Send the request with the username
            xhr.send('username=' + username);
    }
    function removeUser(button) {
        // Access the data-username attribute from the button element
        var username = button.getAttribute('data-username');
        
        // Ask for confirmation before deleting the user
        if (confirm("Are you sure you want to remove this user?")) {
            // Send an AJAX request to the PHP script to delete the user
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'remove.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Check if the response indicates success
                    if (xhr.responseText === "User removed successfully") {
                        alert("User removed successfully");
                        location.reload();
                    } else {
                        // Handle error messages here if needed
                        console.log("Error: " + xhr.responseText);
                    }
                }
            };
            
            // Send the request with the username
            xhr.send('username=' + username);
        }
    }
</script>
<script>
    function goBack() {
        window.location.href = 'page2.php'; // Redirect back to page2.php
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
