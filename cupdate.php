
<?php
// Connection details
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

// Initialize ID variable
$id = null;

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
    $id = $_POST['id']; // Get ID from hidden input
    $cname = $_POST['clinic_name'];
    $address = $_POST['address'];
    $type = $_POST['type'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE clinic SET ClinicName=?, Addresss=?, Type=?, PhoneNumber=?, Email=? WHERE ID=?");
$stmt->bind_param("sssssi", $cname, $address, $type, $phone, $email, $id);


    if ($stmt->execute()) {
        header('Location: clinic.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $sql_select = "SELECT * FROM clinic WHERE ID=$id";
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
        <h2>Update Clinic Record</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <label for="clinic_name">Clinic Name:</label>
            <input type="text" id="clinic_name" name="clinic_name"value="<?php echo $row['ClinicName']; ?>" required>
          </div>
          <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address"value="<?php echo $row['Addresss']; ?>" required></textarea>
          </div>
          <div class="form-group">
            <label for="type">Type:</label>
            <input type="type" id="type" name="type"value="<?php echo $row['Type']; ?>" required>
          </div>
          
          <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone"value="<?php echo $row['PhoneNumber']; ?>" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"value="<?php echo $row['Email']; ?>" required>
          </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="clinic.php" class="btn btn-secondary">Cancel</a>
            </div>
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
