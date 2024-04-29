<?php
// Connection details
include('database_connection.php');

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialisation = $_POST['specialization'];
    $qualification = $_POST['qualification'];
    $experience = $_POST['experience'];

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE doctor SET FirstName=?, LastName=?, Email=?, PhoneNumber=?, Specialization=?, Qualification=?, ExperienceYears=? WHERE ID=?");
    $stmt->bind_param("sssssssi", $fname, $lname, $email, $phone, $specialisation, $qualification, $experience, $id);

    if ($stmt->execute()) {
        header('Location: doctor.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $sql_select = "SELECT * FROM doctor WHERE ID=$id";
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
        <h2>Update Doctor Record</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" value="<?php echo $row['FirstName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" value="<?php echo $row['LastName']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $row['PhoneNumber']; ?>" required>
            </div>
            <div class="form-group">
                <label for="specialization">Specialization:</label>
                <select id="specialization" name="specialization" required>
                    <option value="">Select</option>
                    <option value="general" <?php if ($row['Specialization'] == 'general') echo 'selected'; ?>>General Physician</option>
                    <option value="dermatologist" <?php if ($row['Specialization'] == 'dermatologist') echo 'selected'; ?>>Dermatologist</option>
                    <option value="pediatrician" <?php if ($row['Specialization'] == 'pediatrician') echo 'selected'; ?>>Pediatrician</option>
                    <option value="neurosurgery" <?php if ($row['Specialization'] == 'neurosurgery') echo 'selected'; ?>>NeuroSurgery</option>
                    <option value="gynecology" <?php if ($row['Specialization'] == 'gynecology') echo 'selected'; ?>>Gynecology and Obstetrics</option>
                    <option value="emergency" <?php if ($row['Specialization'] == 'emergency') echo 'selected'; ?>>Emergency</option>
                    <option value="ophthamology" <?php if ($row['Specialization'] == 'ophthamology') echo 'selected'; ?>>Ophthamology</option>
                    <option value="internal medicine" <?php if ($row['Specialization'] == 'internal medicine') echo 'selected'; ?>>Internal Medicine</option>
                    <option value="orthopedic surgery" <?php if ($row['Specialization'] == 'orthopedic surgery') echo 'selected'; ?>>Orthopedic Surgery</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="qualification" value="<?php echo $row['Qualification']; ?>" required>
            </div>
            <div class="form-group">
                <label for="experience">Experience (years):</label>
                <input type="number" id="experience" name="experience" value="<?php echo $row['ExperienceYears']; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="doctor.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
