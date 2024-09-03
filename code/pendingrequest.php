<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connection.php';

// Check if the Solve button is clicked
if(isset($_POST['solve_id'])) {
    $solve_id = $_POST['solve_id'];
    // Perform database delete operation using $solve_id
    // You need to implement the delete logic here
    // For example: mysqli_query($conn, "DELETE FROM addresses WHERE id = $solve_id");
    // After deletion, you can refresh the page or update the table using JavaScript
    // For simplicity, we'll just reload the page here
    header("Location: $_SERVER[PHP_SELF]");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Data</title>
    <!-- Add jQuery library for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <h1>Pending Requests</h1>
    <table class="custom-table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Postal Code</th>
            <th>Image</th>
            <th>Action</th> <!-- Add a new column for the "Solve" button -->
        </tr>
        <?php
        $i = 1;
        $rows = mysqli_query($conn, "SELECT * FROM addresses ORDER BY id DESC");
        foreach ($rows as $row) :
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["username"]; ?></td>
            <td><?php echo $row["street"]; ?></td>
            <td><?php echo $row["city"]; ?></td>
            <td><?php echo $row["state"]; ?></td>
            <td><?php echo $row["postal_code"]; ?></td>
            <td><img src="img/<?php echo $row["image"]; ?>" width="200" title="<?php echo $row['image']; ?>"></td>
            <td>
                <!-- Add a "Solve" button with an onclick event to trigger the delete function -->
                <button onclick="solveRecord(<?php echo $row['id']; ?>)">Solve</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function solveRecord(id) {
            if (confirm("Are you sure you want to solve this record?")) {
                $.ajax({
                    type: "POST",
                    url: "solve.php", // The PHP script that handles the deletion
                    data: { solve_id: id },
                    success: function(response) {
                        console.log("AJAX success response: " + response);
                        if (response.trim() === "success") {
                            // Reload the page after successful deletion
                            location.reload();
                        } else {
                            alert("Error: " + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error response: " + error);
                        alert("AJAX Error: " + status + "\n" + error);
                    }
                });
            }
        }
    </script>

    <style>
        body{
            background-color:#ccea7b;
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
        .custom-table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .custom-table th {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: left;
        }

        .custom-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .custom-table tr:nth-child(odd) {
            background-color: #fff;
        }

        .custom-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        /* Style the "Solve" button */
        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Style for the "Go Back" button */
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
            transition: all 0.5s ease;
        }
    </style>
    <script>
        function goBack() {
            window.location.href = 'page2.php';
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
  </body>
</html>
