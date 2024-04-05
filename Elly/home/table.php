<?php
    require_once "../database/connection.php";
    session_start();
    if (!empty($_SESSION["id"])) {
        // Fetch user details using session ID
        $id = $_SESSION["id"];
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
    } else {
        // Redirect to sign-in page if session ID is empty
        header("Location: ../account/signin.php");
        exit();
    }

    // Fetch player positions data
    $sql = "SELECT `position_played`, COUNT(*) AS `total_players` FROM `users` GROUP BY `position_played`";
    $result = $conn->query($sql);

    // Initialize arrays to store position labels and player counts
    $positions = [];
    $playerCounts = [];

    // Loop through query results to populate arrays
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $positions[] = $row["position_played"];
            $playerCounts[] = $row["total_players"];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Dashboard</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        header {
            background-color: #000;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        nav ul li a.active {
            color: gold;
            font-weight: bold;
        }
        nav ul li a:hover {
            color: #ffc107;
        }

        main {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .content-section {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            max-width: 800px;
            width: 100%;
        }

        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
        .footer-text {
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="user.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="match.php"><i class="fas fa-futbol"></i> Matches</a></li>
                <li><a href="table.php" class="active"><i class="fas fa-users"></i> Players</a></li>
                <li><a href="../database/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="welcome-section">
            <p>The provided webpage displays registered players' information.</p>
        </section>

        <section class="content-section">
            <h2>Registered Players</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Position Played</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT `id`, `firstname`, `lastname`, `email`, `position_played` FROM `users`";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["firstname"] . "</td>";
                            echo "<td>" . $row["lastname"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["position_played"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="content-section">
            <h2>Player Position Distribution</h2>
            <canvas id="positionChart" width="150" height="200"></canvas>
        </section>
    </main>

    <footer>
        <p class="footer-text">&copy; 2024 Your Company. All rights reserved.</p>
    </footer>

    <script>
        // Data for the chart
        var positionData = {
            labels: <?php echo json_encode($positions); ?>,
            datasets: [{
                label: 'Number of Players',
                data: <?php echo json_encode($playerCounts); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        };

        // Configuration for the chart
        var positionConfig = {
            type: 'bar',
            data: positionData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        // Create the chart
        var positionChart = new Chart(
            document.getElementById('positionChart'),
            positionConfig
        );
    </script>
</body>
</html>
