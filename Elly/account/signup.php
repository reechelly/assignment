
<?php
    include '../database/connection.php';

    if (isset($_POST["submit"])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $position_played = $_POST['position_played'];
        $password = $_POST['password'];

        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email=?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "<script>alert('Email Already Taken!')</script>";
        } else {
            $insertStmt = mysqli_prepare($conn, "INSERT INTO users (firstname, lastname, email, position_played, password) VALUES (?,?,?,?,?)");
            mysqli_stmt_bind_param($insertStmt, "sssss", $firstname, $lastname, $email, $position_played, $password);

            if (mysqli_stmt_execute($insertStmt)) {
                echo "<script>alert('Registration Successful!')</script>";
            } else {
                echo "<script>alert('Registration Failed!')</script>";
            }
        }
        mysqli_stmt_close($stmt);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UEFA</title>
    <link rel="stylesheet" href="/css/signup.css">
    <style>
        body {
            background-image: url("../img/uefa.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .navbar {
            background: transparent;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        .form {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            width: 50%;
            max-width: 400px;
            box-shadow: 0px 0px 10px rgba(110, 112, 251, 0.2);
        }
        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input,
        .input-group select {
            width: 100%;
            padding: 8px;
            color: white;
            border-radius: 5px;
            border: 0.5px dashed #ccc;
            box-sizing: border-box;
            background: transparent;
        }
        .input-group .error {
            color: red;
            margin-top: 5px;
        }
        .btn-group {
            text-align: center;
        }
        .btn-group input {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
        }
        .btn-group input[type="reset"] {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="#">Contact</a>
    </div>

    <div class="form" id="form">
        <img src="../img/logo.jpeg" class="logo">
        <h3>Sign Up</h3>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="input-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter First Name" required>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter Last Name" required>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="position_played">Position Played</label>
                <select id="position_played" name="position_played" required>
                    <option value="" disabled selected>-- Select Position --</option>
                    <option value="Midfielder">Midfielder</option>
                    <option value="Defender">Defender</option>
                    <option value="Winger">Winger</option>
                    <option value="Goalkeeper">Goalkeeper</option>
                </select>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <div class="error"></div>
            </div>
            <div class="btn-group">
                <button type="submit" name="submit">Register</button>
            </div>
            <div>
                <a href="signin.php">Have an account?</a>
            </div>
        </form>
    </div>
    <!-- <script src="signup.js"></script> -->
</body>
</html>