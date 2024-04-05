<?php
    include 'connection.php';

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
            mysqli_stmt_bind_param($insertStmt, "ssss", $firstname, $lastname, $email, $position_played, $password);

            if (mysqli_stmt_execute($insertStmt)) {
                echo "<script>alert('Registration Successful!')</script>";
            } else {
                echo "<script>alert('Registration Failed!')</script>";
            }
        }
        mysqli_stmt_close($stmt);
    }
?>