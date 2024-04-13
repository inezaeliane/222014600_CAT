<?php
$servername = "localhost";
$username = "222014600";
$password = "222014600";
$dbname = "cms_ineza_eliane_222014600";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone']; 
$dob = $_POST['dob']; 
$gender = $_POST['gender'];
$insurance = $_POST['insurance'];
$country = $_POST['country'];
$province = $_POST['province'];
$district = $_POST['district'];

$sql = "INSERT INTO patient (Firstname, Lastname, Email, PhoneNumber, DateOfBirth, Gender, MedicalInsurance, Country, Province, District) 
        VALUES ('$fname', '$lname', '$email', '$phone', '$dob', '$gender', '$insurance', '$country', '$province', '$district')";

if ($conn->query($sql) === TRUE) {
    echo "New record has been added successfully";
} else {
    echo "Error: " . $conn->error;
}

// Selecting data from the database
$sql_select = "SELECT * FROM patient";
$result = $conn->query($sql_select);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Multimedia</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Patient records</h2>
    
    <table id="dataTable">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Medical Insurance</th>
            <th>Country</th>
            <th>Province</th>
            <th>District</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["Firstname"] . "</td><td>" . $row["Lastname"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["PhoneNumber"] . "</td><td>" . $row["DateOfBirth"] . "</td><td>" . $row["Gender"] . "</td><td>" . $row["MedicalInsurance"] . "</td><td>" . $row["Country"] . "</td><td>" . $row["Province"] . "</td><td>" . $row["District"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No data found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
// Close connection
$conn->close();
?>
