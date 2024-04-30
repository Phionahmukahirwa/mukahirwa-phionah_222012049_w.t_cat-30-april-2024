<?php
// Connection details
include('db-connection.php');

if(isset($_REQUEST['CattleID'])) {
    $cattleid = $_REQUEST['CattleID'];
    
    $stmt = $connection->prepare("SELECT * FROM Cattle WHERE CattleID=?");
    $stmt->bind_param("i", $cattleid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['CattleID'];
        $y = $row['FarmerID'];
        $z = $row['Breed'];
        $w = $row['Age'];
    } else {
        echo "cattle id not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of cattle</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of cattle form -->
    <h2><u>Update Form of cattle</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        
        <label for="farmid">FarmerID:</label>
        <input type="number" name="farmid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="brd">Breed:</label>
        <input type="text" name="brd" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="age">Age:</label>
        <input type="number" name="age" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $cattleFarmid = $_POST['farmid'];
    $cattleBreed = $_POST['brd'];
    $cattleAge = $_POST['age'];
    
    // Update the cattle in the database
    $stmt = $connection->prepare("UPDATE Cattle SET FarmerID=?, Breed=?, Age=? WHERE CattleID=?");
    $stmt->bind_param("sssi",$cattleFarmid, $cattleBreed, $cattleAge, $cattleid);
    $stmt->execute();
    
    // Redirect to cattle.php
    header('Location: cattle.PHP');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

