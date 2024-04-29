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
      <!-- JavaScript validation and content load for insert data-->
      <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>

</head>
<body>
    <nav>
        <label class="logo" >CMS <br>
            (Clinic Management System)</label>
        <ul>
            <li><a href="index.html">Home</a></li>
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
    <div class="container">
      <h2>Appointment Form</h2>
      <form action="appointment.php" method="POST">
        
        
        <div class="form-group">
          <label for="appointment_date">Appointment Date:</label>
          <input type="date" id="appointment_date" name="appointment_date" required>
        </div>
        <div class="form-group">
          <label for="appointment_time">Appointment Time:</label>
          <input type="time" id="appointment_time" name="appointment_time" required>
        </div>
        <div class="form-group">
        <label for="patient_id">Select Patient:</label>
      <select name="patient_id" id="patient_id">
          <?php
          // Establish database connection
          $servername = "localhost";
          $username = "222014600";
          $password = "222014600";
          $dbname = "cms_ineza_eliane_222014600";
          
          // Create the connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // SQL query to fetch patient names and IDs from the patient table
          $sql = "SELECT id, firstname, lastname FROM patient";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['id'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
              }
          } else {
              echo "<option value=''>No patients available</option>";
          }

          // Close connection
          $conn->close();
          ?>
      </select><br><br>
</div>

        <div class="form-group">
        <label for="doctor_id">Select Doctor:</label>
      <select name="doctor_id" id="doctor_id">
          <?php
          $servername = "localhost";
          $username = "222014600";
          $password = "222014600";
          $dbname = "cms_ineza_eliane_222014600";
          
          // Create the connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Establish database connection (assuming same connection as above)

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
          $servername = "localhost";
          $username = "222014600";
          $password = "222014600";
          $dbname = "cms_ineza_eliane_222014600";
          
          // Create the connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Establish database connection (assuming same connection as above)

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
          <textarea id="reason" name="reason" required></textarea>
        </div>
        <input type="submit" value="Submit">
      </form>
      </div>
    

</section><br><br><br>
    <footer>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About us</a></li>
            <li><a href="contact.html">Contact us</a></li>
            
        </ul>
        <p>&copy; 2024 My Website. All rights reserved.</p>
    </footer>
</body>
</html>