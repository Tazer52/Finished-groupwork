<?php
session_start(); 


$conn = new mysqli("localhost", "root", "", "db_signup");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$login_email = $_POST['User_email'];
$login_password = $_POST['User_pass'];

$sql = "SELECT * FROM user_info WHERE User_email = '$login_email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($login_password === $row['User_pass']) {
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['user_email'] = $row['User_email'];

        header("Location: after-reg.html");
        exit();
    } else {
        echo "Invalid password";
    }
} else {
    echo "User not found";
}

$conn->close();
?>
