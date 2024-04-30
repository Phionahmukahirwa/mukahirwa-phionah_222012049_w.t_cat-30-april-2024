<?php
// Connection details
include('db-connection.php');

// Check if Farmer_Id is set
if(isset($_REQUEST['FarmerID'])) {
    $frmid = $_REQUEST['FarmerID'];
    $stmt = $connection->prepare("SELECT * FROM farmer WHERE FarmerID=?");
    $stmt->bind_param("i", $frmid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['FarmerID'];
        $y = $row['Name'];
        $z = $row['Contact'];
        $g = $row['Address'];
      
    } else {
        echo "farmer id not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of farmers</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of farmers form -->
    <h2><u>Update Form of farmers</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="contact">Contact:</label>
        <input type="text" name="contact" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($g) ? $g : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $name = $_POST['name'];
    $frmcontct = $_POST['contact'];
    $frmaddress = $_POST['address'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE farmer SET Name=?, Contact=?, Address=? WHERE FarmerID=?");
    $stmt->bind_param("sssi",$name, $frmcontct, $frmaddress, $frmid);
    $stmt->execute();
    
    // Redirect to farmer.php
    header('Location: farmer.PHP');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
