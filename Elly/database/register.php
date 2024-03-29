<?php
    include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $position_played = mysqli_real_escape_string($conn, $_POST['position_played']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "INSERT INTO users (firstname, lastname, email, position_played, password)
            VALUES ('$firstname', '$lastname', '$email', '$position_played', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "Records added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
