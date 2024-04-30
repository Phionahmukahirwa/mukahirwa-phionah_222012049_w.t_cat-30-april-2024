<?php
// Connection details
include('db-connection.php');

// Check if animals_available Id is set
if(isset($_REQUEST['animal_id'])) {
    $anmlid = $_REQUEST['animal_id'];
    $stmt = $connection->prepare("SELECT * FROM animals_available WHERE animal_id=?");
    $stmt->bind_param("i", $anmlid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['animal_id'];
        $y = $row['animal_name'];
        $z = $row['quantity_available'];
        
    } else {
        echo "animal available not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of animal available</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of animal available form -->
    <h2><u>Update Form of animal available</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        
        <label for="anml_name">animal_name:</label>
        <input type="text" name="anml_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="qty_avai">quantity_available:</label>
        <input type="number" name="qty_avai" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $animal_name = $_POST['anml_name'];
    $quantity_available = $_POST['qty_avai'];
    
    // Update the animals_available in the database
    $stmt = $connection->prepare("UPDATE animals_available SET animal_name=?, quantity_available=? WHERE animal_id=?");
    $stmt->bind_param("ssi",$animal_name, $quantity_available, $anmlid);
    $stmt->execute();
    
    // Redirect to animals_available.php
    header('Location: animals_available.PHP');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
