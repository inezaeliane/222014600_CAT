<?php
// Connection
$servername = "localhost";
$username = "222014600";
$password = "222014600";
$dbname = "cms_ineza_eliane_222014600";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO doctor (FirstName, LastName, Email, PhoneNumber, Specialization, Qualification, ExperienceYears) VALUES (?, ?,?,?,?,?,?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssss", $fname, $lname, $email, $phone, $specialisation, $qualification, $experience);

    // Set parameters and execute
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialisation = $_POST['specialization'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Selecting data from the database
$sql_select = "SELECT * FROM doctor";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    // Add search condition to SQL query
    $sql_select .= " WHERE FirstName LIKE '%$search%' OR LastName LIKE '%$search%' OR Email LIKE '%$search%' OR PhoneNumber LIKE '%$search%' OR Specialization LIKE '%$search%' OR Qualification LIKE '%$search%' OR ExperienceYears LIKE '%$search%'";
}

$result = $conn->query($sql_select);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Clinic Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
<nav>
        <label class="logo" >CMS <br>
            (Clinic Management System)</label>
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="contact.html">Contact us</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Add new <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="patient.html">Patient</a></li>
                    <li><a href="doctor.html">Doctor</a></li>
                    <li><a href="nurse.html">Nurse</a></li>
                    <li><a href="clinic.html">Clinic</a></li>
                    <li><a href="appointmentform.php">Appointment</a></li>
                    <li><a href="medical.html">Medical description</a></li>
                </ul>
            </li>
            
            <li class="dropdown"><a href="table.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                View all  <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="patient.php">Patient Records</a></li>
                    <li><a href="doctor.php">Doctor Records</a></li>
                    <li><a href="nurse.php">Nurse Records</a></li>
                    <li><a href="clinic.php">Clinic  Records</a></li>
                    <li><a href="appointment.php">Appointment Records</a></li>
                    <li><a href="medical.php">Medical description Records</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="btn btn-success dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Manage Account <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="registration.html">Register</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
            
        </ul>
    </nav>
    <h2>Doctor Records</h2>
    <div class="container">
        <?php
        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <a href="doctor.html" class="btn btn-success">Add New</a>
    </div>
    <br>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table id="dataTable" class="table table-hover text-center">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Specialization</th>
            <th>Qualification</th>
            <th>Experience (years)</th>
            <th>Actions</th>
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["FirstName"] . "</td>";
                echo "<td>" . $row["LastName"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["PhoneNumber"] . "</td>";
                echo "<td>" . $row["Specialization"] . "</td>";
                echo "<td>" . $row["Qualification"] . "</td>";
                echo "<td>" . $row["ExperienceYears"] . "</td>";

                echo "<td>";
                echo "<a href='dupdate.php?updateID=" . $row['ID'] . "'><i class='fas fa-edit'></i></a>";
                echo "<a href='ddelete.php?ID=" . $row['ID'] . "'><i class='fas fa-trash'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No data found</td></tr>";
        }
        ?>
    </table>

    <!-- Include Bootstrap and Font Awesome JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <footer>
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="contact.html">Contact us</a></li>
            
        </ul>
        <p>&copy; 2024 My Website. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
