
<?php
    require '../database/connection.php';
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            if ($password == $row["password"]) {
                $_SESSION["login"] = true;
                session_start();
                $_SESSION["id"] = $row["id"];
                header("Location: ../home/user.php");
            } else {
                echo "<script>alert('Wrong Password!')</script>";
            }
        } else {
            echo "<script>alert('User Not Registered!')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UEFA</title>
    <link rel="stylesheet" href="/css/login.css">
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
            max-width: 300px;
            box-shadow: 0px 0px 10px rgba(110, 112, 251, 0.2);
            text-align: center;
            align-items: center;
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
        .btn-group {
            text-align: center;
        }
        .btn-group input {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
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
        <h3>Login</h3>
        <form method="POST" action="">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
                <div class="error"></div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <div class="error"></div>
            </div>
            <div class="btn-group">
                <button type="submit" name="submit">Sign In</button>
            </div>
            <div>
                <a href="signup.php">Don't have an account?</a>
            </div>
        </form>        
    </div>

    <!-- <script src="signin.js"></script> -->
</body>
</html>