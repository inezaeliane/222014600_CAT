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
    $stmt = $conn->prepare("INSERT INTO history (PatientName, DateOfBirth, Gender, BloodType, Allerigies, MedicalCondition, CurrentMedication, Doctor, Nurse, Clinic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssss", $name, $dob, $gender, $type, $allerg, $condition, $medication, $doctor, $nurse, $clinic);
    // Set parameters and execute
    $name = $_POST['patient_name'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $type = $_POST['blood_type'];
    $allerg = $_POST['allergies'];
    $condition = $_POST['medical_conditions'];
    $medication = $_POST['medications'];
    $doctor = $_POST['doctor_id'];
    $nurse = $_POST['nurse_id'];
    $clinic = $_POST['clinic_id'];
   

    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
// Selecting data from the database
$sql_select = "SELECT * FROM appointment";
$result = $conn->query($sql_select);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Management System</title>
    <link rel="stylesheet" href="style.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="
sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css
" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="
sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
    /* Add your CSS styles here */
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
            
            
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Services  <span class="caret"></span></a>
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
                    Settings <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="registration.html">Register</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
            
        </ul>
    </nav>
    
      <h2>Medical Records</h2>
    <div class="container">
        <?php
        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <a href="medicalform.php" class="btn btn-success">Add New</a>
    </div>
    <br>
    <form method="GET" action="">
    <input type="text" name="search" placeholder="Search...">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

    <table id="dataTable" class="table table-hover text-center">
        <tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Blood Type</th>
            <th>Allergies</th>
            <th>Medical Conditions</th>
            <th>Current Medications</th>
            <th>Doctor</th>
            <th>Nurse</th>
            <th>Clinic</th>
             <th>Actions</th>
        </tr>
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

// Selecting data from the database
$sql_select = "SELECT * FROM history";

// Check if search form is submitted
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Add search condition to SQL query
    $sql_select .= " WHERE PatientName LIKE '%$search%' OR DateOfBirth LIKE '%$search%' OR Gender LIKE '%$search%' OR BloodType LIKE '%$search%' OR Allerigies LIKE '%$search%' OR MedicalCondition LIKE '%$search%' OR CurrentMedication LIKE '%$search%' OR Doctor LIKE '%$search%' OR Nurse LIKE '%$search%' OR Clinic LIKE '%$search%'";
}

$result = $conn->query($sql_select);


 
         // Check if there are any products
        
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $id = $row['ID'];
              echo "<tr>";
              echo "<td>" . $row["ID"] . "</td>";
              echo "<td>" . $row["PatientName"] . "</td>";
              echo "<td>" . $row["DateOfBirth"] . "</td>";
              echo "<td>" . $row["Gender"] . "</td>";
              echo "<td>" . $row["BloodType"] . "</td>";
              echo "<td>" . $row["Allerigies"] . "</td>";
              echo "<td>" . $row["MedicalCondition"] . "</td>";
              echo "<td>" . $row["CurrentMedication"] . "</td>";
              echo "<td>" . $row["Doctor"] . "</td>";
              echo "<td>" . $row["Nurse"] . "</td>";
              echo "<td>" . $row["Clinic"] . "</td>";
                
                echo "<td>";
                echo "<a href='mupdate.php?updateID=" . $row['ID'] . "'><i class='fas fa-edit'></i></a>";
                echo "<a href='mdelete.php?ID=" . $row['ID'] . "'><i class='fas fa-trash'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No data found</td></tr>";
        }
        ?>
    </table>

    <!-- Include Bootstrap and Font Awesome JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</section><br><br><br>
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