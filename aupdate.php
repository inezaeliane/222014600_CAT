<?php
// Connection details
include('database_connection.php');
// Initialize ID variable
$id = null;

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
    $id = $_POST['id']; // Get ID from hidden input
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    $patient = $_POST['patient_id'];
    $clinic = $_POST['clinic_id'];
    $doctor = $_POST['doctor_id'];
    $reason = $_POST['reason'];

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE appointment SET AppointimentDate=?, AppointmentTime=?, Patient=?, Clinic=?, Doctor=?, ReasonAppointment=? WHERE ID=?");
    $stmt->bind_param("ssssssi", $date, $time, $patient, $clinic, $doctor, $reason, $id);

    if ($stmt->execute()) {
        header('Location: appointment.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $sql_select = "SELECT * FROM appointment WHERE ID=$id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!$row) {
            echo "Error fetching appointment data.";
            exit(); // Terminate script
        }
    } else {
        echo "No record found for ID: $id";
        exit(); // Terminate script
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
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
        <h2>Update Appointment Record</h2>
        <form method="POST" action="" onsubmit="return confirmUpdate();">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" id="appointment_date" name="appointment_date" value="<?php echo $row['AppointimentDate']; ?>" required>
            </div>
            <div class="form-group">
                <label for="appointment_time">Appointment Time:</label>
                <input type="time" id="appointment_time" name="appointment_time" value="<?php echo $row['AppointmentTime']; ?>" required>
            </div>
            <div class="form-group">
                <label for="patient_id">Select Patient:</label>
                <select name="patient_id" id="patient_id">
                    <?php
                    // Establish database connection
                    include('database_connection.php');

                    // SQL query to fetch patient names and IDs from the patient table
                    $sql = "SELECT id, firstname, lastname FROM patient";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($patientRow = $result->fetch_assoc()) {
                            $selected = ($patientRow['id'] == $row['Patient']) ? 'selected' : '';
                            echo "<option value='" . $patientRow['id'] . "' $selected>" . $patientRow['firstname'] . " " . $patientRow['lastname'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No patients available</option>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </select>
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

          <div class="form-group">
    <label for="reason">Reason for Appointment:</label>
    <textarea id="reason" name="reason" required><?php echo isset($row['ReasonAppointment']) ? $row['ReasonAppointment'] : ''; ?></textarea>
   </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="appointment.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</body>
</html>
