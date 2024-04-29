
<?php
// Connection details
include('database_connection.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize ID variable
$id = null;

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
    $id = $_POST['id']; // Get ID from hidden input
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
   

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE history SET PatientName=?, DateOfBirth=?, Gender =?, BloodType=?, Allerigies=?, MedicalCondition=?,CurrentMedication=?,	Doctor=?,Nurse=?,	Clinic =? WHERE ID=?");
$stmt->bind_param("ssssssssssi", $name, $dob, $gender, $type, $allerg,$condition,$medication,$doctor,$nurse,$clinic, $id);


    if ($stmt->execute()) {
        header('Location: medical.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $sql_select = "SELECT * FROM history WHERE ID=$id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Head content here -->
</head>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clinic management system</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #ccc;
            color: #000;
        }

        .btn-secondary:hover {
            background-color: #999;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update Medical Record</h2>
        <form action="medical.php" method="POST">
        <div class="form-group">
            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" value="<?php echo $row['PatientName']; ?>" required>
          </div>
          <div class="form-group">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth"value="<?php echo $row['DateOfBirth']; ?>" required>
          </div>
          <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender"value="<?php echo $row['Gender']; ?>" required>
              <option value="">Select</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="blood_type">Blood Type:</label>
         <select type="text" id="blood_type" name="blood_type"value=<?php echo $row['BloodType']; ?>" required>
            <option value="">Select</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="AB">AB</option>
              <option value="O">O</option>
            </select>
          </div>
          <div class="form-group">
            <label for="allergies">Allergies:</label>
            <textarea id="allergies" name="allergies"value="<?php echo $row['Allerigies']; ?>" ></textarea>
          </div>
          <div class="form-group">
            <label for="medical_conditions">Medical Conditions:</label>
            <textarea id="medical_conditions" name="medical_conditions" value="<?php echo $row['MedicalCondition']; ?>"required ></textarea>
          </div>
          <div class="form-group">
            <label for="medications">Current Medications:</label>
            <textarea id="medications" name="medications" value="<?php echo $row['CurrentMedication']; ?>" ></textarea>
          </div>
          
          <div class="form-group">
        <label for="doctor_id">Select Doctor:</label>
      <select name="doctor_id" id="doctor_id">
          <?php
          include('database_connection.php');

          // SQL query to fetch doctor IDs, first names, and last names from the doctor table
          $sql = "SELECT id, firstname, lastname FROM doctor";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
              }
          } else {
              echo "<option value=''>No doctors available</option>";
          }

          // Close connection (assuming same connection as above)
          $conn->close();
          ?>
      </select><br><br>

        </div>
        <div class="form-group">
        <label for="nurse_id">Select Nurse:</label>
      <select name="nurse_id" id="nurse_id">
          <?php
 include('database_connection.php');

          // SQL query to fetch doctor IDs, first names, and last names from the doctor table
          $sql = "SELECT id, firstname, lastname FROM nurse";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['id'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
              }
          } else {
              echo "<option value=''>No Nurse  available</option>";
          }

          // Close connection (assuming same connection as above)
          $conn->close();
          ?>
      </select><br><br>

        </div>
        <div class="form-group">
        <label for="clinic_id">Select Clinic:</label>
      <select name="clinic_id" id="clinic_id">
          <?php
          include('database_connection.php');

          // SQL query to fetch clinic IDs and names from the clinic table
          $sql = "SELECT ID, ClinicName FROM clinic";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['ID'] . "'>" . $row['ClinicName'] . "</option>";
              }
          } else {
              echo "<option value=''>No clinics available</option>";
          }

          // Close connection (assuming same connection as above)
          $conn->close();
          ?>
      </select><br><br>
        </div>
          <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- Rest of the form -->
        </form>
    </div>
</body>
</html>
