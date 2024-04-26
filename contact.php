<?php
$servername = "localhost";
$username = "222014600";
$password = "222014600";
$dbname = "cms_ineza_eliane_222014600";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_information (Name,Email,Message	) VALUES ('$name','$email','$message')";

if ($conn->query($sql) === TRUE) {
   echo "successfully requested!";
   header("Location: contact.html");
   exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
