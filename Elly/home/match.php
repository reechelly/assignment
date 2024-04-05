<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Hub - Match Fixtures</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #000;
            color: #fff;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar .main {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .navbar ul {
            list-style-type: none;
            display: flex;
        }
        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            transition: color 0.3s ease;
        }
        .navbar ul li.active a {
            color: gold;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .match-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }
        
        .match-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .match-item h2 {
            margin-bottom: 10px;
            font-size: 1.5rem;
        }
        
        .match-item p {
            margin-bottom: 5px;
        }
                        
        .container2 {
            max-width: 1150px;
            margin: 20px auto;
            padding: 0 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        input[type="date"],
        input[type="time"],
        input[type="text"] {
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 12px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="text"]:focus {
            border-color: #666;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 30px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #357ae8;
        }

        footer {
            text-align: center;
            background-color: #000;
            color: #fff;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            font-size: 0.9rem;
        }

        .container3 {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="main">
                <ul>
                    <li><a href="user.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li class="active"><a href="#"><i class="fas fa-futbol"></i> Matches</a></li>
                    <li><a href="table.php"><i class="fas fa-users"></i> Players</a></li>
                    <li><a href="../database/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Match Fixtures</h1>
        <ul class="match-list">
            <?php
            // Include database connection
            require '../database/connection.php';

            // Fetch match data from database
            $sql = "SELECT * FROM matches";
            $result = mysqli_query($conn, $sql);

            // Check if there are matches
            if (mysqli_num_rows($result) > 0) {
                // Output each match as a list item
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li class="match-item">';
                    echo '<h2>' . $row["id"] . '</h2>';
                    echo '<p><strong>Date:</strong> ' . $row["date"] . '</p>';
                    echo '<p><strong>Time:</strong> ' . $row["time"] . '</p>';
                    echo '<p><strong>Teams:</strong> ' . $row["team1"] . ' vs. ' . $row["team2"] . '</p>';
                    echo '<p><strong>Venue:</strong> ' . $row["venue"] . '</p>';
                    echo '</li>';
                }
            } else {
                // If no matches found
                echo "<li>No matches found.</li>";
            }

            // Close database connection
            mysqli_close($conn);
            ?>
        </ul>
    </div>

    <section class="container2">
        <h1>Arrange Match</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="date">Match Date:</label>
            <input type="date" id="date" name="date">

            <label for="time">Match Time:</label>
            <input type="time" id="time" name="time">

            <label for="team1">Team 1:</label>
            <input type="text" id="team1" name="team1">

            <label for="team2">Team 2:</label>
            <input type="text" id="team2" name="team2">

            <label for="venue">Venue:</label>
            <input type="text" id="venue" name="venue">

            <input type="submit" value="Arrange Match">
        </form>
    </section>

    <section class="container3">
        <h1>Match Fixtures Graph</h1>
        <canvas id="matchGraph" width="800" height="400"></canvas>
    </section>

    <footer>
        <p>&copy; 2024 Best Teams in the World. All rights reserved.</p>
    </footer>

    <script>
        // Data for the graph
        var matchData = {
            labels: ["Match 1", "Match 2", "Match 3", "Match 4"],
            datasets: [{
                label: 'Match Schedule',
                data: [3, 2, 4, 5], // Number of matches
                fill: false,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointRadius: 5
            }]
        };

        // Configuration for the graph
        var matchConfig = {
            type: 'line',
            data: matchData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        // Create the graph
        var matchGraph = new Chart(
            document.getElementById('matchGraph'),
            matchConfig
        );
    </script>
</body>
</html>
