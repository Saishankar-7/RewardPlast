<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plastic Leaderboard</title>
    <button class="goback-button" onclick="goBack()"><ion-icon name="arrow-back-outline"></ion-icon></button>
</head>
<body>
<section>
    <h2><ion-icon name="earth"></ion-icon>REWARDPLAST</h2>
    <p class="pa">TURNING THE TRASH INTO TREASURE</p>
</section>
<h2>Leader Board</h2>
<table>
    <thead>
        <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Amount (Rupees)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Database connection details
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "project";

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch leaderboard data
        $sql = "SELECT * FROM clients WHERE user_type = 'user' ORDER BY plasticAmount DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $rank = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='leaderboard-row" . ($rank === 1 ? ' first-row' : '') . "'>";
                echo "<td>" . $rank . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['plasticAmount'] . "</td>";
                echo "</tr>";
                $rank++;
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
        window.location.href = 'page1.php'; // Redirect back to page1.php
    }
</script>
<style>
    body {
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

    h2 {
        text-align: center;
        font-size: 30px;
        color: black;
        padding: 20px;
        margin-bottom: 20px;
    }

    /* Style for the "Go Back" button */
    .goback-button {
        position: fixed; /* Fixed positioning */
        top: 20px; /* Adjust the top position as needed */
        left: 20px; /* Adjust the left position as needed */
        z-index: 9999; /* Ensure it's above other elements */
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

    /* Style for the table */
    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    /* Style for table header */
    th {
        font-size: 30px;
        background-color: #007bff;
        color: white;
        text-align: left;
        padding: 10px;
    }

    /* Style for table rows */
    tr {
        transition: background-color 0.3s ease-in-out;
    }

    /* Style for even rows */
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Style for odd rows */
    tr:nth-child(odd) {
        background-color: #e6e6e6;
    }

    /* Style for rank 1 row */
    tr:nth-child(1) {
        background-color: #ffc107; /* Yellow background for rank 1 */
        color: black; /* Change text color for better visibility */
    }

    /* Hover effect for rows */
    tr:hover {
        transform: translateY(-3px);
        background-color:#A4BE5C;
    }
    td {
    padding: 10px;
}

/* Style the first column (Rank) differently */
td:first-child {
    background-color: transparent;
    color: black;
    font-weight: bold;
}

/* Add some spacing between the cells in the first row (table headers) */
th, td {
    padding: 10px 15px;
}

/* Center align the text in the Rank column */
td:first-child, th:first-child {
    text-align: center;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    table {
        width: 100%;
    }
}
    /* Animation for rank 1 row */
    tr:nth-child(1) {
        animation: highlight 2s ease infinite alternate;
    }

    /* Define the highlight animation */
@keyframes highlight {

    100% {
        background-color: #e91e63; /* Pink */
    }
}

/* RGB lighting effect for the first row */

@keyframes rgb-lighting {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 100% 0;
    }
}

</style>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
