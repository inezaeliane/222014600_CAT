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
<script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
<style>
    /* Add your CSS styles here */
    body {
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 800px;
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
    select,
    textarea {
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
                    <li><a href="clinic.php">Clinic Records</a></li>
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

    <div class="container">
        <h2>Medical History Form</h2>
        <form action="medical.php" method="POST" onsubmit="return confirmInsert();">
          <div class="form-group">
            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" required>
          </div>
          <div class="form-group">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
          </div>
          <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
              <option value="">Select</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="blood_type">Blood Type:</label>
         <select type="text" id="blood_type" name="blood_type" required>
            <option value="">Select</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="AB">AB</option>
              <option value="O">O</option>
            </select>
          </div>
          <div class="form-group">
            <label for="allergies">Allergies:</label>
            <textarea id="allergies" name="allergies"></textarea>
          </div>
          <div class="form-group">
            <label for="medical_conditions">Medical Conditions:</label>
            <textarea id="medical_conditions" name="medical_conditions"></textarea>
          </div>
          <div class="form-group">
            <label for="medications">Current Medications:</label>
            <textarea id="medications" name="medications"></textarea>
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