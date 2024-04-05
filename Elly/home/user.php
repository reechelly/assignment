
<?php
    require '../database/connection.php';
    session_start();
    if (!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['delete'])) {
                $delete_query = "DELETE FROM users WHERE id = $id";
                if (mysqli_query($conn, $delete_query)) {
                    header("Location: ../database/logout.php");
                    exit();
                } else {
                    echo "Error deleting account: " . mysqli_error($conn);
                }
            } else {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $position_played = $_POST['position_played'];
                $password = $_POST['password'];

                $update_query = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email', position_played = '$position_played', password = '$password'";
                $update_query .= " WHERE id = $id";

                if (mysqli_query($conn, $update_query)) {
                    echo "Profile updated successfully";
                } else {
                    echo "Error updating profile: " . mysqli_error($conn);
                }
            }
        }
    } else {
        header("Location: ../account/signin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 90%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }
        .form-group button {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
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

        .fancy-border {
            border: 2px solid #007bff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: #f0f0f0;
        }
        .fancy-heading {
            font-size: 24px;
            margin-bottom: 10px;
            text-transform: uppercase;
            color: #007bff;
        }
        .fancy-text {
            font-size: 18px;
        }
        .player-images {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .player-images img {
            width: 150px;
            border-radius: 50%;
            border: 4px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .player-images img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="" class="active"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="match.php"><i class="fas fa-futbol"></i> Matches</a></li>
                <li><a href="table.php"><i class="fas fa-users"></i> Players</a></li>
                <li><a href="../database/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="welcome-section">
            <h1>Welcome Back, <?php echo $row['firstname']; ?>!</h1>
            <p>This is your personalized dashboard. Explore and manage your account.</p>
        </section>

        <section class="content-section">
            <h2 class="fancy-heading">Dashboard Overview</h2>
            <p class="fancy-text">Here's what you can do on your football dashboard:</p>
            <ul class="fancy-text">
                <li>View upcoming fixtures and match details.</li>
                <li>Explore team information and player profiles.</li>
                <li>Make arrangements for matches.</li>
                <li>Update your profile.</li>
            </ul>
            <p class="fancy-text">Start exploring the exciting world of football!</p>
        </section>

        <div class="content">
            <div class="fancy-border">
                <h1 class="fancy-heading">User Profile</h1>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="position_played">Position Played</label>
                        <input type="text" id="postion_played" name="position_played" value="<?php echo $row['position_played']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter new password">
                    </div>
                    <div class="form-group">
                        <div><button type="submit" name="update">Update Profile</button></div>
                        <div><button type="submit" name="delete" class="delete-btn" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">Delete Account</button></div>
                    </div>
                </form>
            </div>
            <div class="fancy-border">
                <h2 class="fancy-heading">Top Players</h2>
                <div class="player-images">
                    <img src="../img/ronaldo.jpg" alt="">
                    <img src="../img/messi.jpg" alt="">
                    <img src="../img/neymar.jpg" alt="">
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p class="footer-text">&copy; 2024 Your Company. All rights reserved.</p>
    </footer>
</body>
</html>