<?php
// Connection details
include('database_connection.php');

// Check if ID is set
if(isset($_REQUEST['ID'])) {
    $id = $_REQUEST['ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM nurse WHERE ID=?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('location:nurse.php?msg=Delete data successful');
    
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "click here to confirm";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Nurse Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <button onclick="if(confirmDelete()) { window.location.href = 'nurse.php?ID=<?php echo $_REQUEST['ID']; ?>&confirm=1'; }">Delete Record</button>
</body>
</html>
