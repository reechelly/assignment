<?php
include 'connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: ../home/user.html");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid password. Please try again.";
            header("Location: ../account/signin.html");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "User not found. Please check your email.";
        header("Location: ../account/signin.html");
        exit();
    }

    mysqli_close($conn);
}
?>