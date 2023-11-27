<?php
$conn = new mysqli("localhost", "root", "", "db_signup");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['F_Name'];
$last_name = $_POST['L_Name'];
$email = $_POST['User_email'];
$password = $_POST['User_pass'];

$check_duplicate_sql = "SELECT User_email FROM user_info WHERE User_email = '$email'";
$result = $conn->query($check_duplicate_sql);

if ($result->num_rows > 0) {

    echo "<script>alert('User already registered. Login Instead.');</script>";
    // header("Location: loginpage.html");
} else {
    $insert_sql = "INSERT INTO user_info (F_Name, L_Name, User_email, User_pass) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($insert_sql) === TRUE) {
        header("Location: loginpage.html");
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
