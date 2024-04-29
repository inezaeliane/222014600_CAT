<?php
include('database_connection.php');

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['uname'];
$email = $_POST['email'];
$Phone = $_POST['Pnumber'];
$password = $_POST['password'];

$sql = "INSERT INTO user_information (Firstname, Lastname, Username, Email, Phonenumber, Password) VALUES ('$fname','$lname','$username','$email','$Phone','$password')";

if ($conn->query($sql) === TRUE) {
   echo "successfully registered!";
   header("Location: login.html");
   exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
