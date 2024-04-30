<?php
// Connection details
include('database_connection.php');
// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
    $id = $_GET['updateID'];
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

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE patient SET Firstname=?, Lastname=?, Email=?, PhoneNumber=?, DateOfBirth=?, Gender=?, MedicalInsurance=?, Country=?, Province=?, District=? WHERE ID=?");
    $stmt->bind_param("ssssssssssi", $fname, $lname, $email, $phone, $dob, $gender, $insurance, $country, $province, $district, $id);

    if ($stmt->execute()) {
        header('Location: patient.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $sql_select = "SELECT * FROM patient WHERE ID=$id";
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
    <title>Update Patient</title>
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
.selectoption {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

select.selectoption {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  background-color: #fff; /* Ensure select fields have a white background */
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
        if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update Patient Record</h2>
        <form method="POST" action=""onsubmit="return confirmUpdate();">
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" value="<?php echo $row['Firstname']; ?>" required>
            
            </div>
            <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input class="selectoption" type="date" id="dob" name="dob" required>
          </div>
          <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="selectoption" id="gender" name="gender" required>
              <option value="">Select</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
            </div>
            <div class="form-group">
                <label for="insurance">Medical Insurance:</label>
                <select class="selectoption" id="insurance" name="insurance" required>
                  <option value="">Select</option>
                  <option value="rama">RAMA</option>
                  <option value="mutual">MUTUAL</option>
                  <option value="mmi">MMI</option>
                  <OPTion value="britam rwanda">Britam Rwanda</OPTion>
                  <option value="other">Others</option>
                </select>
    
              </div>
          <div class="form-group">
            <label for="country">Country:</label>
            <textarea id="country" name="country" required></textarea>
          </div>
          <div class="form-group">
            <label for="province">Province:</label>
            <input type="text" id="province" name="province" required>
          </div>
          <div class="form-group">
            <label for="district">District:</label>
            <input type="text" id="district" name="district" required>
          </div>
            <!-- Add other form fields for Last Name, Email, Phone, etc. -->
            <!-- Ensure to populate the input fields with existing data -->
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="patient.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
     <!-- Confirmation script -->
     <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</body>
</html>
